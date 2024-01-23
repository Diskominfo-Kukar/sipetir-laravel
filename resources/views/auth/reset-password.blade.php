<x-auth-layout title="Reset Password">
  {{-- <div class="app-container app-theme-white body-tabs-shadow">
    <div class="app-container">
      <div class="h-100 bg-malibu-beach bg-animation">
        <div class="d-flex h-100 justify-content-center align-items-center">
          <div class="mx-auto app-login-box col-md-8">
            <div class="app-logo mx-auto mb-3" style="height:50px !important; width:300px !important;"></div>
            <div class="modal-dialog w-auto mx-auto">
              <div class="modal-content">
                <form method="POST" action="{{ route('password.update') }}">
                  <div class="modal-body">
                    <div class="h5 modal-title text-center">
                      <h4 class="mt-2">
                        <div>Reset Password</div>
                        <span>Silahkan Masukkan Password Baru</span>
                      </h4>
                    </div>
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul class=" mb-0 mt-0 list-unstyled list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                        <li><i class="fa fa-info-circle fa-fw"></i>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                    @endif
                    <div class="row-fluid">
                      <div class="col-md-12">
                        <div class="input-group mb-3">
                          <div class="input-group-text">
                            <span class="">@</span>
                          </div>
                          <input placeholder="email" name="email" required value="{{ old('email', $request->email) }}"
                            type="email" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="input-group mb-3">
                          <div class="input-group-text">
                            <span class=""><i class="fa fa-lock"></i></span>
                          </div>
                          <input placeholder="Password Baru" autocomplete="current-password" name="password"
                            type="password" required class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="input-group mb-3">
                          <div class="input-group-text">
                            <span class=""><i class="fa fa-lock"></i></span>
                          </div>
                          <input placeholder="Konfirmasi Password Baru" autocomplete="current-password"
                            name="password_confirmation" type="password" required class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer clearfix">
                    <div class="float-end">
                      <button type="submit" class="btn btn-info btn-lg"><i class="fa fa-unlock fa-fw"></i> Buat Password
                        Baru</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="text-center text-white opacity-8 mt-3">Copyright © 2022</div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}

  <div class="wrapper">

    <!--start content-->
    <main class="authentication-content">
      <div class="container-fluid">
        <div class="authentication-card">
          <div class="card shadow rounded-0 overflow-hidden">
            <div class="row g-0">
              <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                <img src="{{ asset('assets/images/error/forgot-password-frent-img.jpg') }}" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6">
                <div class="card-body p-4 p-sm-5">
                  <h5 class="card-title">Buat Password Baru</h5>
                  <p class="card-text mb-5">Silahkan Masukkan Password Baru Anda.</p>
                  
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul class=" mb-0 mt-0 list-unstyled list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                        <li><i class="fa fa-info-circle fa-fw"></i>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif

                  <h5 class="text-center">{{ $request->email }}</h5>

                  <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <input type="hidden"  name="email" required value="{{ $request->email }}" readonly>
                    
                    <div class="row g-3">
                      <div class="col-12">
                        <label for="inputNewPassword" class="form-label">Password Baru</label>
                        <div class="ms-auto position-relative">
                          <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                            <i class="bi bi-lock-fill"></i>
                          </div>
                          <input 
                            type="password" 
                            class="form-control radius-30 ps-5" 
                            id="inputNewPassword"
                            placeholder="Password Baru..."
                            name="password"
                            required
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="inputConfirmPassword" class="form-label">Konfirm Password</label>
                        <div class="ms-auto position-relative">
                          <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                            <i class="bi bi-lock-fill"></i></div>
                          <input 
                            type="password" 
                            class="form-control radius-30 ps-5" 
                            id="inputConfirmPassword"
                            placeholder="Konfirm Password"
                            name="password_confirmation"
                            required
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="d-grid gap-3">
                          <button type="submit" class="btn btn-primary radius-30">Ubah Password</button>
                          <a href="{{ route('login') }}" class="btn btn-light radius-30">Kembali Ke Login</a>
                        </div>
                      </div>
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
  <!--end wrapper-->
</x-auth-layout>