<x-app-layout
    :title=$pageTitle
    :sub-title=$subTitle
    :icon=$icon
    :crumbs=$crumbs
>
    <div class="row">
        <div class="col-md-6 col-xl-6 offset-md-3 offset-xl-3">
                
            <div class="card">
                <div class="card-body">
                    <x-ui.form-wrapper
                        method="post"
                        action="{{ route('akun.password.update') }}"
                        class="row"
                    >
                        <div class="col-md-12 mb-2">
                            <x-ui.input-group
                                label="Password Lama"
                                id="old_password"
                                name="old_password"
                                placeholder="Password Lama Anda..."
                                required
                                value="{{ old('old_password') }}"
                                type="password"
                            >
                                <x-slot:icon>
                                    <i class="bx bx-lock-alt"></i>
                                </x-slot:icon>
                            </x-ui.input-group>
                        </div>

                        <div class="col-md-12 mb-2">
                            <x-ui.input-group
                                label="Password Baru"
                                id="password"
                                name="password"
                                placeholder="Password Baru Anda..."
                                required
                                value="{{ old('password') }}"
                                type="password"
                            >
                                <x-slot:icon>
                                    <i class="bx bx-lock"></i>
                                </x-slot:icon>
                            </x-ui.input-group>
                        </div>

                        <div class="col-md-12 mb-2">
                            <x-ui.input-group
                                label="Konfirmasi Password Baru"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Konfirmasi Password Baru Anda..."
                                required
                                value="{{ old('password_confirmation') }}"
                                type="password"
                            >
                                <x-slot:icon>
                                    <i class="bx bx-lock"></i>
                                </x-slot:icon>
                            </x-ui.input-group>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="divider"></div>
                            
                            <x-ui.button
                                class="float-end btn-danger"
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
