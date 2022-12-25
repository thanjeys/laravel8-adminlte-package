<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Leads <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#createModal">New Lead</button></h1>
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
                        <div class="card-body leadstable">
                            <livewire:leads-table/>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     @include('livewire.leads.create')
    @include('livewire.leads.update')
    @include('livewire.leads.delete')

    @push('scripts')
    <script>
        window.livewire.on('closeModal', () => {
        $('#createModal').modal('hide');
        $('#updateModal').modal('hide');
        $('#deleteModal').modal('hide');
    })
    window.livewire.on('showUpdateModal', () => {
        $('#updateModal').modal('show');
    })
    window.livewire.on('showCreateModal', () => {
        $('#createModal').modal('show');
    })
    window.livewire.on('showDeleteModal', () => {
        $('#deleteModal').modal('show');
    })

    </script>
    @endpush

@push('css')
<style>
.leadstable .table td, .table th {
    padding: 5px;
    font-size: 13px;
    text-align: center;
}
.leadstable .table-bordered thead th {
    font-size: 11px !important;
}
</style>

@endpush

</div>
