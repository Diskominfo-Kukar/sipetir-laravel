<x-app-layout :title=$pageTitle :sub-title=$subTitle :icon=$icon :crumbs=$crumbs>

    <div class="mb-3 border-0 shadow-sm card radius-10">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-hover table-striped table-bordered" id="data-table" width="100%">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th width="5%">Tahun</th>
                            <th>Nama</th>
                            <th width="110px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- create user --}}
    <x-ui.modal id="addModal" title="Tambah {{ $pageTitle }}" :action="route($route . '.store')" :fallback="true">
        <x-ui.input label="Nama " id="nama" name="nama" required placeholder="Nama"
            value="{{ old('nama') }}" />
    </x-ui.modal>

    {{-- create user --}}
    <x-ui.modal id="editModal" title="Edit {{ $pageTitle }}">
        <x-slot:button>
            <button type="submit" class="btn btn-dark submit"><i class="bx bx-refresh"></i> Update</button>
        </x-slot:button>
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
                serverSide: false,
                ajax: "{{ route($route . '.get-data') }}",
                searchDelay: 1000,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'tgl_buat',
                        name: 'tgl_buat',

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

            //edit modal trigger
            $(document).on('click', '.remote-modal', function(e) {
                e.preventDefault();
                // $('#modal-loading').show();
                $('#editModal').modal('show').find('form').attr('action', $(this).attr('action'));
                $('#editModal').modal('show').find('.modal-body').load($(this).attr('href'), function() {});
            });
        </script>
    @endpush
</x-app-layout>