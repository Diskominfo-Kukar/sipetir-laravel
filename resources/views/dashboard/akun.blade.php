<x-app-layout
    :title=$pageTitle
    :sub-title=$subTitle
    :icon=$icon
    :crumbs=$crumbs
>
    <div class="row">
        <div class="col-md-6 col-xl-8 offset-md-3 offset-xl-2">
            <div class="card">
                <div class="card-body">
                    <x-ui.form-wrapper
                        method="post"
                        action="{{ route('akun.store') }}"
                        class="row"
                    >
                        <div class="col-md-6">
                            <div class="mb-2">
                                <x-ui.input-group
                                label="Nama"
                                id="nama"
                                name="name"
                                placeholder="Nama..."
                                required
                                value="{{ old('name', $user->name) }}"
                                >
                                    <x-slot:icon>
                                        <i class="bx bx-user"></i>
                                    </x-slot:icon>
                                </x-ui.input-group>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <x-ui.input-group
                                    label="Username"
                                    id="username"
                                    name="username"
                                    placeholder="Username..."
                                    required
                                    value="{{ old('username', $user->username) }}"
                                >
                                    <x-slot:icon>
                                        @
                                    </x-slot:icon>
                                </x-ui.input-group>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <x-ui.input-group
                                    typeGroup="prepend"
                                    type="email"
                                    label="Email"
                                    id="email"
                                    name="email"
                                    placeholder="email..."
                                    required
                                    value="{{ old('email', $user->email) }}"
                                >
                                    <x-slot:icon>
                                        <i class="bx bx-envelope"></i>
                                    </x-slot:icon>
                                </x-ui.input-group>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="divider mt-2"></div>
                            <a href="{{ route('akun.password.edit') }}" class="btn btn-outline-danger">
                                <i class="bx bx-key"></i> Ganti Password
                            </a>
                            <x-ui.button
                                class="float-end btn btn-primary"
                                title="Update"
                                icon="bx bx-save pb-1"
                            />
                        </div>
                    </x-ui.form-wrapper>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
