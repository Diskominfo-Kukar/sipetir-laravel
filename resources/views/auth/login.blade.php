<x-auth-layout :title=$pageTitle>
  <div class="wrapper">
    <!--start content-->
    <main class="authentication-content">
      <div class="container-fluid">
        <div class="authentication-card">
          <div class="card shadow rounded-0 overflow-hidden">
            <div class="row g-0">
              <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/images/error/login-img.jpg')}}" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6">
                <div class="card-body p-4 p-sm-5">
                  <h5 class="card-title">TSG</h5>
                  <p class="card-text mb-5">Base With Laravel 9 </p>

                  <div class="login-separater text-center mb-4"> <span>Silahkan Masukkan Username &
                      Password Anda</span>
                    <hr>
                  </div>

                  @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul class=" mb-0 mt-0 list-unstyled list-inside text-sm text-red-600">
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
                          <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                            <i class="bi bi-person-circle"></i>
                          </div>
                          <input 
                            name="username"  
                            type="text" 
                            placeholder="Username here..."
                            class="form-control radius-30 ps-5"  
                            required 
                            autocomplete="off" 
                            autofocus
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="inputChoosePassword" class="form-label">Enter Password</label>
                        <div class="ms-auto position-relative">
                          <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                            <i class="bi bi-lock-fill"></i>
                          </div>
                          <input 
                            name="password" 
                            type="password" 
                            placeholder="Password.."
                            class="form-control radius-30 ps-5 " 
                            required
                          />
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check form-switch">
                          <input name="remember" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="true">
                          <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                        </div>
                      </div>
                      <div class="col-6 text-end">
                        <a href="{{ route('password.request') }}">Lupa Password ?</a>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button 
                            type="submit" 
                            class="btn btn-lg btn-primary radius-30 submit"
                            name="submit"
                          >
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

</x-auth-layout>