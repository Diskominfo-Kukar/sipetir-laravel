<x-app-layout :title=$pageTitle :sub-title=$subTitle :icon=$icon :crumbs=$crumbs>

    <div class="mb-3 border-0 shadow-sm card radius-10">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
                        Showing {{ $pakets->firstItem() }} to {{ $pakets->lastItem() }} of {{ $pakets->total() }} entries
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group float-right">
                        <input type="text" class="form-control form-control-sm" placeholder="Pencarian" id="searchInput">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" type="button" id="searchButton">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Nama</th>
                        <th scope="col" width="120px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pakets as $index => $paket)
                        <tr>
                            <td scope="col">{{ ($pakets->currentPage() - 1) * $pakets->perPage() + $index + 1 }}</td>
                            <td scope="col">{{ \Carbon\Carbon::parse($paket->tgl_buat)->format('Y') }}</td>
                            <td scope="col">{{ $paket->nama }}</td>
                            <td scope="col">
                                <div class="btn-group btn-sm">
                                    <a title="{{ $paket->buttonText }}" href="{{ route('paket.show', $paket->id) }}"
                                       class="btn {{ $paket->buttonClass }} btn-sm" style="width: 90px; text-align: center; display: inline-block;">
                                        <i class="bx bx-{{ $paket->buttonText == 'Proses' ? 'edit' : 'info-circle' }}"></i>
                                        {{ $paket->buttonText }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $pakets->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}
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

            //search
            document.getElementById('searchButton').addEventListener('click', function () {
                let query = document.getElementById('searchInput').value;
                let url = new URL(window.location.href);
                url.searchParams.set('search', query);
                window.location.href = url.toString();
            });
            document.getElementById('searchInput').addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    document.getElementById('searchButton').click();
                }
            });
        </script>
    @endpush
</x-app-layout>
