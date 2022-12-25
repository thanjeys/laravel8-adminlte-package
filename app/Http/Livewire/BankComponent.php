<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use Livewire\Component;

class BankComponent extends Component
{
    public $bank_name;
    public $monthly_cycle;
    public $bank_edit_id;
    public $bank_delete_id;


    protected $listeners = ['edit', 'deleteConfirm'];


    protected function rules() {
        return  [
            'bank_name' => 'required',
            'monthly_cycle' => 'required|numeric',
        ];
    }

    function store()
    {
        $validatedData = $this->validate();

        Bank::create($validatedData);

        session()->flash('successMsg', 'Bank has been Created Successfully');
        $this->emitTo('bank-table', '$refresh');
        $this->reset();
        $this->emit('closeModal');

    }

    function edit($bankId)
    {
        $id = $bankId['id'];
        $bank = Bank::find($id);
        $this->bank_edit_id = $bank->id;
        $this->bank_name = $bank->bank_name;
        $this->monthly_cycle = $bank->monthly_cycle;
        $this->emit('showUpdateModal');
    }

    function update()
    {
        $validatedData = $this->validate();
        if ($this->bank_edit_id)
        {
            $bank = Bank::find($this->bank_edit_id);

            // dd($validatedData);
            $bank->update($validatedData);

            session()->flash('successMsg', 'Bank has been updated sucessfully');
            $this->emitTo('bank-table', '$refresh');
            $this->reset();
            $this->emit('closeModal');
        }
    }

    function deleteConfirm($bank)
    {
        $bankId = $bank['id'];
        $this->bank_delete_id = $bankId;
        $this->emit('showDeleteModal');
    }

    function delete()
    {
        if ($this->bank_delete_id)  // Remove all Images
        {
            $bank = Bank::find($this->bank_delete_id);
            $bank->delete();
            session()->flash('successMsg', 'Bank has been deleted sucessfully');
            $this->emitTo('bank-table', '$refresh');
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
        return view('livewire.bank-component')->extends('layouts.app');
    }
}
