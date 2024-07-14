<x-app-layout :title=$pageTitle :sub-title=$subTitle :icon=$icon :crumbs=$crumbs>

    <div class="mb-3 border-0 shadow-sm card radius-10">
        <div class="card-header ">
            <button class="btn btn-primary btn-md " data-bs-toggle="modal" data-bs-target="#addModal"><i
                    class="pb-1 bx bx-plus-circle me-0"></i> Tambah</button>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-hover table-striped table-bordered" id="data-table" width="100%">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>No Hp</th>
                            {{-- <th width="100px">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- create user --}}
    <x-ui.modal id="addModal" title="Tambah {{ $pageTitle }}" :action="route($route . '.store')" :fallback="true">

        <x-ui.input label="NIK " id="nik" name="nik" required placeholder="nik"
            value="{{ old('nik') }}" />
        <x-ui.input label="NIP " id="nip" name="nip" required placeholder="nip"
            value="{{ old('nip') }}" />
        <x-ui.input label="Nama " id="nama" name="nama" required placeholder="Nama"
            value="{{ old('nama') }}" />
        <div class="mb-3 form-group">
            <label for="jabatan_id" class="form-label">Pilih Jabatan</label>
            <select required name="jabatan_id" class="form-control" id="jabatan_id">
                <option></option>
                @foreach ($dataJabatan as $jabatan)
                    <option {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }} value="{{ $jabatan->id }}">
                        {{ ucwords($jabatan->nama) }}</option>
                @endforeach
            </select>
        </div>
        <x-ui.input label="NO HP" id="no_hp" name="no_hp" required placeholder="No HP"
            value="{{ old('no_hp') }}" />
        <x-ui.input label="Email" id="email" name="email" required placeholder="email" type="email"
            value="{{ old('email') }}" />

        <x-ui.input label="Username" id="username" name="username" required placeholder="username"
            value="{{ old('username') }}" />

        <x-ui.input label="Password" id="password" name="password" type="password" required placeholder="password"
            value="{{ old('password') }}" />
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
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'no_hp_tampil',
                        name: 'no_hp_tampil'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false,
                    //     className: 'text-center'
                    // },
                ]
            });

            $('#jabatan_id').select2({
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
                $('#editModal').modal('show').find('.modal-body').load($(this).attr('href'), function() {
                    $('#panitia-edit').select2({
                        width: '100%',
                        dropdownParent: $("#editModal"),
                        allowClear: true,
                        placeholder: 'Pilih',
                        theme: 'bootstrap-5'
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
