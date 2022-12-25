<!-- Update Modal -->
<!-- Create Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Lead</h5>
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

                <form wire:submit.prevent="update">

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
                                    <option {{ ($freelancer->id == $flr_name) ? 'selected' : null }} value="{{ $freelancer->id }}">{{ $freelancer->name }}</option>
                                @endforeach
                            </select>
                          </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Product</label>
                            <select wire:model.defer="product" class="form-control" name="" id="">
                                <option value="" >Select Product</option>
                                <option {{ ($product == 'PL') ? "selected" : null }} value="PL">PL</option>
                                <option {{ ($product == 'HL') ? "selected" : null }} value="HL">HL</option>
                                <option {{ ($product == 'LAP') ? "selected" : null }} value="LAP">LAP</option>
                                <option {{ ($product == 'BL') ? "selected" : null }} value="BL">BL</option>
                                <option {{ ($product == 'CAR LOAN') ? "selected" : null }} value="CAR LOAN">CAR LOAN</option>
                                <option {{ ($product == 'CC') ? "selected" : null }} value="CC">CC</option>
                                <option {{ ($product == 'OD') ? "selected" : null }} value="OD">OD</option>
                                <option {{ ($product == 'CREDIT CARD') ? "selected" : null }} value="CREDIT CARD">CREDIT CARD</option>
                                <option {{ ($product == 'LAP TOP UP') ? "selected" : null }} value="LAP TOP UP">LAP TOP UP</option>
                                <option {{ ($product == 'HT BT TOP UP') ? "selected" : null }} value="HL BT TOP UP">HL BT TOP UP</option>
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
                                    @foreach($banks as $bk)
                                        <option {{ ($bk->id == $bank) ? 'selected' : null }} value="{{ $bk->id }}">{{ $bk->bank_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">

                                <div class="form-group col-md-12">
                                <label for="">Status</label>
                                <select wire:model.defer="status" class="form-control" name="" id="">
                                    <option >Select Status</option>
                                    <option {{ ($status == 'Logged') ? "selected" : null }} value="Logged">Logged</option>
                                    <option {{ ($status == 'Approved') ? "selected" : null }} value="Approved">Approved</option>
                                    <option {{ ($status == 'Rejected') ? "selected" : null }} value="Rejected">Rejected</option>
                                    <option {{ ($status == 'Disbused') ? "selected" : null }} value="Disbused">Disbused</option>
                                    <option {{ ($status == 'Sent File') ? "selected" : null }} value="Sent File">Sent File</option>
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
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            <button type="button" wire:click.prevent="cancel()" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
