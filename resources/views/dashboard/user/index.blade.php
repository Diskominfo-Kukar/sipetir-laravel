<x-app-layout
    :title=$pageTitle
    :sub-title=$subTitle
    :icon=$icon
    :crumbs=$crumbs
>
   
    <div class=" card  shadow-sm radius-10 border-0 mb-3">
        <div class="card-header ">
            <button class="btn btn-primary btn-md " data-bs-toggle="modal" data-bs-target="#addModal"><i class="bx bx-plus-circle pb-1 me-0"></i> Tambah</button>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-hover table-striped table-bordered"  id="data-table" width="100%">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>level</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>                
            </div>
        </div>
    </div>

    {{-- create user --}}
    <x-ui.modal
        id="addModal"
        title="Tambah User"
        :action="route('user.store')"
        :fallback="true"
    >
        <div class="form-group mb-3">
            <label for="roles" class="form-label">Role User</label>
            <select required name="role" class="form-control" id="roles">
                <option></option>
                @foreach ($dataRole as $item)
                    <option {{ old('role') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ ucwords($item->name) }}</option>
                @endforeach
            </select>
        </div>   

        <x-ui.input
            label="Nama Legkap"
            id="name"
            name="name"
            required
            placeholder="Nama"
            value="{{ old('name') }}"
        />

        <x-ui.input
            label="Email"
            id="email"
            name="email"
            required
            placeholder="email"
            type="email"
            value="{{ old('email') }}"
        />

        <x-ui.input
            label="Username"
            id="username"
            name="username"
            required
            placeholder="username"
            value="{{ old('username') }}"
        />

        <x-ui.input
            label="Password"
            id="password"
            name="password"
            required
            placeholder="password"
            value="{{ old('password') }}"
        />


    </x-ui.modal>

    {{-- create user --}}
    <x-ui.modal
        id="editModal"
        title="Edit User"
    >

        <x-slot:button>
            <button type="submit" class="btn btn-dark submit"><i class="bx bx-refresh"></i> Update</button>
        </x-slot:button>
    </x-ui.modal>

    
    {{-- add style & script --}}
    @push('styles')
        <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
        <style>
        
        </style>
    @endpush

    @push('scripts')
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/js/table-datatable.js') }}"></script>
        <script>
                $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('user.get-data') }}",
                    searchDelay: 1000,
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'username', name: 'username'},
                        {data: 'role', name: "role"},
                        {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
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
                $(document).on('click','.remote-modal', function(e){
                    e.preventDefault();
                    // $('#modal-loading').show();
                    $('#editModal').modal('show').find('form').attr('action',$(this).attr('action'));
                    $('#editModal').modal('show').find('.modal-body').load($(this).attr('href'), function(){
                        $('#roles-edit').select2({
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



