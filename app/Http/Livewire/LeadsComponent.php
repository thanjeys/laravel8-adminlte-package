<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Lead;
use Livewire\Component;
use App\Models\Freelancer;

class LeadsComponent extends Component
{
    public $sm;
    public $app_num;
    public $flr_name;
    public $customer_num;
    public $customer_name;
    public $salary;
    public $company_name;
    public $loan_amount;
    public $disbused_amount;
    public $bank;
    public $status;
    public $product;
    public $remarks;

    public $lead_edit_id;
    public $lead_delete_id;
    public $successMsg;

    protected $listeners = ['edit', 'deleteConfirm', 'copy'];

    protected function rules()
    {
        return [
        'sm' => 'nullable',
        'app_num' => 'nullable',
        'flr_name' => 'nullable',
        'customer_num' => 'required|numeric', //|digits:10
        'customer_name' => 'required',
        'salary' => 'nullable|numeric',
        'company_name' => 'nullable',
        'loan_amount' => 'required|numeric',
        'disbused_amount' => 'nullable|numeric',
        'bank' => 'nullable',
        'status' => 'nullable',
        'remarks' => 'nullable',
        'product' => 'nullable',
        ];
    }

    protected $messages = [
            'customer_num.required' => 'Customer Number is required',
    ];

    function store()
    {
        $validatedData = $this->validate();
        $validatedData['user_id'] = auth()->user()->id;
        Lead::create($validatedData);
        session()->flash('successMsg', 'Lead has been Created Successfully');
        $this->emitTo('leads-table', '$refresh');
        $this->reset();
        $this->emit('closeModal');
    }

    function edit($leadId)
    {
        $id = $leadId['id'];
        $lead = Lead::find($id);
        $this->lead_edit_id = $lead->id;
        $this->sm = $lead->sm;
        $this->app_num = $lead->app_num;
        $this->flr_name = $lead->flr_name;
        $this->customer_name = $lead->customer_name;
        $this->customer_num = $lead->customer_num;
        $this->salary = $lead->salary;
        $this->company_name = $lead->company_name;
        $this->loan_amount = $lead->loan_amount;
        $this->disbused_amount = $lead->disbused_amount;
        $this->bank = $lead->bank;
        $this->status = $lead->status;
        $this->remarks = $lead->remarks;
        $this->product = $lead->product;
        $this->emit('showUpdateModal');
    }

    function copy($leadId)
    {
        $id = $leadId['id'];
        $lead = Lead::find($id);
        $this->lead_edit_id = $lead->id;
        $this->sm = $lead->sm;
        $this->app_num = $lead->app_num;
        $this->flr_name = $lead->flr_name;
        $this->customer_name = $lead->customer_name;
        $this->customer_num = $lead->customer_num;
        $this->salary = $lead->salary;
        $this->company_name = $lead->company_name;
        $this->loan_amount = $lead->loan_amount;
        $this->disbused_amount = $lead->disbused_amount;
        $this->bank = $lead->bank;
        $this->status = $lead->status;
        $this->remarks = $lead->remarks;
        $this->product = $lead->product;
        $this->emit('showCreateModal');
    }

    function update() {

        $validatedData = $this->validate();

        if ($this->lead_edit_id)
        {
            $lead = Lead::find($this->lead_edit_id);
            $lead->update($validatedData);

            session()->flash('successMsg', 'Lead has been updated sucessfully');
            $this->emitTo('leads-table', '$refresh');
            $this->reset();
            $this->emit('closeModal');
        }
    }

    function deleteConfirm($lead)
    {
        $leadId = $lead['id'];
        $this->lead_delete_id = $leadId;
        $this->emit('showDeleteModal');
    }

    function delete()
    {
        if ($this->lead_delete_id)  // Remove all Images
        {
            $lead = Lead::find($this->lead_delete_id);
            $lead->delete();
            session()->flash('successMsg', 'Leads has been deleted sucessfully');
            $this->emitTo('leads-table', '$refresh');
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
        $leads = Lead::all();

        $banks = Bank::orderBy('bank_name')->get();
        $freelancers = Freelancer::orderBy('name')->get();

        return view('livewire.leads-component', compact('leads', 'banks', 'freelancers'))->extends('layouts.app');
    }
}
