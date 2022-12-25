<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#createModal">New User</button></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('successMsg'))
                    <div class="alert alert-success text-center">{{ session('successMsg') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <livewire:user-table/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('livewire.users.update')
    @include('livewire.users.create')
    @include('livewire.users.delete')

    @push('scripts')
    <script>
        window.livewire.on('closeModal', () => {

        $('#updateModal').modal('hide');
        $('#deleteModal').modal('hide');
        $('#createModal').modal('hide');
    })
    window.livewire.on('showUpdateModal', () => {
        $('#updateModal').modal('show');
    })
    window.livewire.on('showDeleteModal', () => {
        $('#deleteModal').modal('show');
    })

    </script>
    @endpush

</div>
