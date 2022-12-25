<!-- Create Modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Lead</h5>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form wire:submit.prevent="store">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="">Customer Name<small>*</small></label>
                          <input wire:model.defer="customer_name" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="">Customer Number <small>*</small></label>
                          <input wire:model.defer="customer_num" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="">Salary<small>*</small></label>
                          <input wire:model.defer="salary" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="">Company Name<small></small></label>
                          <input wire:model.defer="company_name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="">Loan Amount<small>*</small></label>
                          <input wire:model.defer="loan_amount" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">FLR Name</label>
                            <select wire:model.defer="flr_name" class="form-control" name="" id="">
                                <option value="0">Select</option>
                                @foreach($freelancers as $freelancer)
                                    <option value="{{ $freelancer->id }}">{{ $freelancer->name }}</option>
                                @endforeach
                            </select>
                          </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Product</label>
                            <select wire:model.defer="product" class="form-control" name="" id="">
                                <option value="" >Select Product</option>
                                <option value="PL">PL</option>
                                <option value="HL">HL</option>
                                <option value="LAP">LAP</option>
                                <option value="BL">BL</option>
                                <option value="CAR LOAN">CAR LOAN</option>
                                <option value="CC">CC</option>
                                <option value="OD">OD</option>
                                <option value="CREDIT CARD">CREDIT CARD</option>
                                <option value="LAP TOP UP">LAP TOP UP</option>
                                <option value="HL BT TOP UP">HL BT TOP UP</option>
                            </select>
                        </div>
                    </div>
                    @cannot('isTelecaller')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Disbused Amount</label>
                                <input wire:model.defer="disbused_amount" type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">App Num</label>
                                <input wire:model.defer="app_num" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">SM</label>
                                <input wire:model.defer="sm" type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Bank</label>
                                <select wire:model.defer="bank" class="form-control" name="" id="">
                                    <option value="0" selected>Select</option>
                                    @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Status</label>
                                <select wire:model.defer="status" class="form-control" name="" id="">
                                <option >Select Status</option>
                                <option value="Logged">Logged</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Disbused">Disbused</option>
                                <option value="Sent File">Sent File</option>
                                </select>
                            </div>
                        </div>
                     @endcannot

                    <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="">Remarks</label>
                          <textarea wire:model.defer="remarks" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-3">
                            <button type="submit" class="btn btn-sm btn-primary">Save Lead</button>
                            <button type="button" wire:click.prevent="cancel()" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
