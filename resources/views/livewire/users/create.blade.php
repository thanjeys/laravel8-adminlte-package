<!-- Create Modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
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

                    <div class="form-group row">
                        <label for="name" class="col-4">Name <span class="text-danger">*</span></label>
                        <div class="col-8">
                            <input type="text" id="name" class="form-control" wire:model="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-4">Email <span class="text-danger">*</span></label>
                        <div class="col-8">
                            <input type="text" id="email" class="form-control" wire:model="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-4">Password <span class="text-danger">*</span></label>
                        <div class="col-8">
                            <input type="text" id="password" class="form-control" wire:model="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="c_password" class="col-4">Confirm Password <span class="text-danger">*</span></label>
                        <div class="col-8">
                            <input type="text" id="c_password" class="form-control" wire:model="c_password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-4">Role <span class="text-danger">*</span></label>
                        <div class="col-8">
                            <select wire:change="newroleselection()"  id="role" class="form-control" wire:model="is_admin">
                                <option value="">Select Role</option>
                                <option value="0">TeleCaller</option>
                                <option value="2">Backend</option>
                                <option value="1">Administrator</option>
                            </select>
                        </div>
                    </div>

                    @if ($showBanks)
                        <div class="form-group row">
                            <label for="role" class="col-4">Assign Banks</label>
                            <div class="col-8">
                                <div class="row">
                                    @foreach ($banksList as $bank)
                                    <div class="col">
                                        <input type="checkbox" id="{{ $bank->id }}" wire:model="banks" value="{{ $bank->id}}">
                                        <label for="{{ $bank->id }}">{{ $bank->bank_name }}</label>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>

                    @endif



                    {{-- <div class="form-group row">
                        <label for="status" class="col-4">Status</label>
                        <div class="col-8">
                            <select class="form-control" wire:model="status">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div> --}}


                    <div class="form-group row justify-content-center">
                        <div class="col-4"></div>
                        <div class="col-8">
                            <button type="submit" class="btn btn-sm btn-primary">Save User</button>
                            <button type="button" wire:click.prevent="cancel()" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
