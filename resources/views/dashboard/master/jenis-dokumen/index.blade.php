<x-app-layout :title=$pageTitle :sub-title=$subTitle :icon=$icon :crumbs=$crumbs>

    <div class=" card  shadow-sm radius-10 border-0 mb-3">
        <div class="card-header ">
            <button class="btn btn-primary btn-md " id="addBtnModal" data-bs-toggle="modal" data-bs-target="#addModal"><i
                    class="bx bx-plus-circle pb-1 me-0"></i> Tambah</button>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-hover table-striped table-bordered" id="data-table" width="100%">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Form Modal --}}
    <x-ui.modal id="addModal" title="Tambah {{ $pageTitle }}" :action="route($route . '.store')" :fallback="true">
        <x-ui.input label="Nama " id="nama" name="nama" required placeholder="Nama"
            value="{{ old('nama') }}" />
    </x-ui.modal>


    {{-- add style & script --}}
    @push('styles')
        <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    @endpush

    @push('scripts')
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/js/table-datatable.js') }}"></script>
        <script>
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route($route . '.get-data') }}",
                searchDelay: 1000,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ]
            });

            $('#roles').select2({
                width: '100%',
                height: '50px',
                dropdownParent: $("#addModal"),
                allowClear: true,
                placeholder: 'Pilih',
                theme: 'bootstrap-5'
            });

            $('#addBtnModal').on('click', function(e) {
                console.log("oke");
                $('#nama').val('');
                $('#nama').removeClass('is-invalid');
            })

            //edit modal trigger
            $(document).on('click', '.remote-modal', function(e) {
                e.preventDefault();
                // $('#modal-loading').show();
                let action =$(this).attr('action');
                let load_url =$(this).attr('href');
                $('#addModal').modal('show').find('form').attr('action', action);
                $('#addModal').modal('show').find('.modal-body').load(load_url, function() {});
                $('#addModal').find('#action_url').val(action);
                $('#addModal').find('#load_url').val(load_url);

            });
        </script>
    @endpush
</x-app-layout>