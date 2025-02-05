<x-auth-layout :title=$pageTitle>
    <div class="wrapper">
        <!--start content-->
        <main class="authentication-content">
            <div class="container-fluid">
                <div class="authentication-card">
                    <div class="overflow-hidden shadow card rounded-0">
                        <div class="row g-0">
                            <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/images/error/login-img.jpg') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-4 card-body p-sm-5">
                                    <h5 class="text-center card-title">
                                        <div class="logo-wrapper d-flex justify-content-center align-items-center mb-3">
                                            <img class="main-logo me-2" style="width: 80px; height: auto;" src="{{ asset('images/kukar-logo.png') }}" alt="logo-kukarkab" />
                                            <img class="main-logo" style="width: 230px; height: auto;" src="{{ asset('images/ukpbj-only.png') }}" alt="logo-ukpbj" />
                                        </div>
                                        <a href="https://sipetir.kukarkab.go.id/"><b>SIPETIR</b> BPBJ</a>
                                    </h5>

                                    <p class="text-center card-text">
                                        <strong>© 2024 <a href="https://ukpbj.kukarkab.go.id">BPBJ</a> Dikembangkan
                                            bersama <a href="https://diskominfo.kukarkab.go.id">Diskominfo</a> Didukung
                                            oleh Balai Sertifikasi Elektronik (<a
                                                href="https://bsre.bssn.go.id">BSrE</a>), BSSN</strong>
                                    </p>

                                    <div class="mb-4 text-center login-separater"> <span>Silahkan Masukkan Username &
                                            Password Anda</span>
                                        <hr>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mt-0 mb-0 text-sm text-red-600 list-inside list-unstyled">
                                                @foreach ($errors->all() as $error)
                                                    <li><i class="fa fa-info-circle fa-fw"></i>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="" class="form-label">Enter Username</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="px-3 position-absolute top-50 translate-middle-y search-icon">
                                                        <i class="bi bi-person-circle"></i>
                                                    </div>
                                                    <input name="username" type="text" placeholder="Username here..."
                                                        class="form-control radius-30 ps-5" required autocomplete="off"
                                                        autofocus />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                                <div class="ms-auto position-relative">
                                                    <div class="px-3 position-absolute top-50 translate-middle-y search-icon">
                                                        <i class="bi bi-lock-fill" id="passwordShow"></i>
                                                    </div>
                                                    <input name="password" type="password" id="password" placeholder="Password.." class="form-control rounded-pill ps-5" required />
                                                    <button type="button" id="togglePassword" class="no-border rounded-pill btn btn-outline-secondary btn-sm position-absolute end-0 top-50 translate-middle-y me-3">
                                                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check form-switch">
                                                    <input name="remember" class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked" checked="true">
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckChecked">Remember Me</label>
                                                </div>
                                            </div>
                                            <div class="col-6 text-end">
                                                <a href="{{ route('password.request') }}">Lupa Password ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit"
                                                        class="btn btn-lg btn-primary radius-30 submit" name="submit">
                                                        Login
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- <div class="col-12">
                                <p class="mb-0">Don't have an account yet? <a href="authentication-signup.html">Sign up here</a></p>
                            </div> -->
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!--end page main-->

    </div>

    @push('scripts')
    <script>
        $('#passwordShow').click(function(){
            // lock-open
            if ($(this).hasClass('bi bi-lock-fill')) {
                $("#passwordShow").attr('class', 'bi bi-unlock-fill');
                $("#password").attr('type', 'text');
            }else{
                $("#passwordShow").attr('class', 'bi bi-lock-fill');
                $("#password").attr('type', 'password');
            }
        });

        document.getElementById('togglePassword').addEventListener('click', function (e) {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('togglePasswordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bi-eye');
                passwordIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bi-eye-slash');
                passwordIcon.classList.add('bi-eye');
            }
        });
    </script>

    <style>
        .no-border {
            border: none;
        }
    </style>
    @endpush
</x-auth-layout>
