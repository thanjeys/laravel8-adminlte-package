<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Freelancer;

class FreelancerComponent extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $location;
    public $freelancer_edit_id;
    public $freelancer_delete_id;


    protected $listeners = ['edit', 'deleteConfirm'];


    protected function rules() {
        return  [
            'name' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'nullable|email',
            'location' => 'required',
        ];
    }

    function store()
    {
        $validatedData = $this->validate();

        Freelancer::create($validatedData);

        session()->flash('successMsg', 'Freelancer has been Created Successfully');
        $this->emitTo('freelancer-table', '$refresh');
        $this->reset();
        $this->emit('closeModal');

    }

    function edit($freelancerId)
    {
        $id = $freelancerId['id'];
        $freelancer = Freelancer::find($id);
        $this->freelancer_edit_id = $freelancer->id;
        $this->name = $freelancer->name;
        $this->email = $freelancer->email;
        $this->mobile = $freelancer->mobile;
        $this->location = $freelancer->location;

        $this->emit('showUpdateModal');
    }

    function update()
    {
        $validatedData = $this->validate();
        if ($this->freelancer_edit_id)
        {
            $freelancer = Freelancer::find($this->freelancer_edit_id);

            // dd($validatedData);
            $freelancer->update($validatedData);

            session()->flash('successMsg', 'Freelancer has been updated sucessfully');
            $this->emitTo('freelancer-table', '$refresh');
            $this->reset();
            $this->emit('closeModal');
        }
    }

    function deleteConfirm($freelancer)
    {
        $freelancerId = $freelancer['id'];
        $this->freelancer_delete_id = $freelancerId;
        $this->emit('showDeleteModal');
    }

    function delete()
    {
        if ($this->freelancer_delete_id)  // Remove all Images
        {
            $freelancer = Freelancer::find($this->freelancer_delete_id);
            $freelancer->delete();
            session()->flash('successMsg', 'Freelancers has been deleted sucessfully');
            $this->emitTo('freelancer-table', '$refresh');
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
        return view('livewire.freelancer-component')->extends('layouts.app');
    }
}
