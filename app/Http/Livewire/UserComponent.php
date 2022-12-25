<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class UserComponent extends Component
{
    public $name;
    public $email;
    public $password;
    public $c_password;
    public $is_admin;
    public $user_edit_id;
    public $user_delete_id;
    public $showBanks = false;
    public $banksList;
    public $banks = [];
    public $editBanks = [];


    protected $listeners = ['edit', 'deleteConfirm'];

    protected $userAddRules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'c_password' => 'required|same:password',
        'is_admin' => 'required',
    ];

    protected function rules() {
        return  [ 'name' => 'required',
        // 'email' => 'required|email|unique:users,email,'.$user->id,',
        'email' => 'required|email|unique:users,email,'.$this->user_edit_id,
        'is_admin' => 'required',
        ];
    }



    protected $messages = [
        'c_password.same' => 'Confirm Password should match with Password.',
        'is_admin.required' => 'Role field is required.',
    ];


    function newroleselection()
    {
        if ($this->is_admin == 2)
        {
            $this->showBanks = true;
            $this->banksList = Bank::orderBy('bank_name')->get();
        } else
            $this->showBanks = false;
    }


    function store()
    {
        $validatedData = $this->validate($this->userAddRules);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);

        if ($this->is_admin == 2) // Backend Team
        {
            // Store Banks
            $banks = Bank::find($this->banks);
            if ($user->banks()->attach($banks))
            {
                // dd('bank attached');
            }
        }
        session()->flash('successMsg', 'User has been Created Successfully');
        $this->emitTo('user-table', '$refresh');
        $this->reset();
        $this->emit('closeModal');

    }



    function edit($userId)
    {
        $id = $userId['id'];
        $user = User::find($id);
        $this->user_edit_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = "";
        $this->is_admin = $user->is_admin;

        $this->newroleselection(); // get Banks list

        if ($this->is_admin == 2)
        {
            $userbanks = $user->banks->pluck('id')->toArray();
            foreach($this->banksList as $blist)
            {
                if(in_array($blist->id, $userbanks))
                {
                    array_push($this->banks, $blist->id);
                } else {
                    array_push($this->banks, null);
                }
            }
        }


        $this->emit('showUpdateModal');
    }

    function update()
    {
        $validatedData = $this->validate();
        if ($this->user_edit_id)
        {
            $user = User::find($this->user_edit_id);

            if(!empty($this->password)){
                $validatedData['password'] = Hash::make($this->password);
            }

            $user->update($validatedData);
            if ($this->is_admin == 2)
            {   $finalBank = [];
                foreach($this->banks as $selectedBank)
                {
                    if($selectedBank)
                    {
                        $finalBank[] = $selectedBank;
                    }
                }
                $user->banks()->sync($finalBank);
            }

            session()->flash('successMsg', 'User has been updated sucessfully');
            $this->emitTo('user-table', '$refresh');
            $this->reset();
            $this->emit('closeModal');
        }
    }

    function deleteConfirm($user)
    {
        $userId = $user['id'];
        $this->user_delete_id = $userId;
        $this->emit('showDeleteModal');
    }

    function delete()
    {
        if ($this->user_delete_id)  // Remove all Images
        {
            $user = User::find($this->user_delete_id);
            $user->delete();
            session()->flash('successMsg', 'Users has been deleted sucessfully');
            $this->emitTo('user-table', '$refresh');
            $this->reset();
            $this->emit('closeModal');
        }
    }

    function cancel()
    {
        $this->emit('closeModal');
        $this->reset();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.user-component')->extends('layouts.app');
    }
}
