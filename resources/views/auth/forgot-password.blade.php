<x-auth-layout :title=$pageTitle>
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
                  <h5 class="card-title">Lupa Password ?</h5>
                  <p class="card-text mb-5">Silahkan Masukkan Email Anda Untuk Reset Password</p>

                  @if(Session::has('status'))
                  <div class="alert alert-success">
                    {{Session::get('status')}}
                  </div>
                  @endif

                  @if ($errors->any())
                  <div class="alert alert-danger text-center">
                    <ul class=" mb-0 mt-0 list-unstyled list-inside text-sm text-red-600">
                      @foreach ($errors->all() as $error)
                      <li><i class="fa fa-info-circle fa-fw"></i>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif

                  <form method="POST" action="{{ route('password.email') }}" class="form-body">
                    @csrf
                    <div class="row g-3">
                      <div class="col-12">
                        <label for="inputEmailid" class="form-label">Email id</label>
                        <input 
                          type="email" 
                          class="form-control form-control-lg radius-30" 
                          id="inputEmailid"
                          placeholder="Email id"
                          value="{{ old('email') }}"
                          name="email"
                          required
                        >
                      </div>
                      <div class="col-12">
                        <div class="d-grid gap-3">
                          <button type="submit" class="btn btn-lg btn-primary radius-30 submit">Kirim</button>
                          <a href="{{ route('login') }}" class="btn btn-lg btn-light radius-30">Login</a>
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
</x-auth-layout>