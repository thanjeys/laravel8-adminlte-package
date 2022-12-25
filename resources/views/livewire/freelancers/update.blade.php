<!-- Create Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update New Freelancer</h5>
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
                        <label for="mobile" class="col-4">Mobile</label>
                        <div class="col-8">
                            <input type="text" id="mobile" class="form-control" wire:model="mobile">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-4">Location</label>
                        <div class="col-8">
                            <input type="text" id="" class="form-control" wire:model="location">
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-4"></div>
                        <div class="col-8">
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            <button type="button" wire:click.prevent="cancel()" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
