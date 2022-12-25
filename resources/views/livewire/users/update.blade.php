<!-- Create Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update User</h5>
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


                    <div class="form-group row">
                        <label for="name" class="col-4">Name</label>
                        <div class="col-8">
                            <input type="text" id="name" class="form-control" wire:model="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-4">Email</label>
                        <div class="col-8">
                            <input type="text" id="email" class="form-control" wire:model="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-4">Password</label>
                        <div class="col-8">
                            <input type="text" id="password" class="form-control" wire:model="password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-4">Role</label>
                        <div class="col-8">
                            <select wire:change="newroleselection()" id="role" class="form-control" wire:model="is_admin">
                                <option  value="">Select Role</option>
                                <option {{ ($is_admin == 0) ? 'selected' : ''}} value="0">Telecaller</option>
                                <option {{ ($is_admin == 2) ? 'selected' : ''}}  value="2">Backend</option>
                                <option {{ ($is_admin == 1) ? 'selected' : ''}} value="1">Administrator</option>
                            </select>
                        </div>
                    </div>

                    @if ($showBanks && $user_edit_id)
                        <div class="form-group row">
                            <label for="role" class="col-4">Assign Banks</label>
                            <div class="col-8">
                                <div class="row">
                                    @foreach ($banksList as $bank)
                                    <div class="col">
                                    <input wire:model="banks.{{ $loop->index }}" type="checkbox" id="bank-{{ $bank->id }}" value="{{ $bank->id }}"><label style="font-weight:normal" for="bank-{{ $bank->id }}">{{ $bank->bank_name }}</label>
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
                                <option {{ ($status) ? 'selected' : ''}} value="1">Active</option>
                                <option {{ ($status) ? 'selected' : ''}} value="0">Inactive</option>
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
