 <style>
    /* ── LOGIN INPUT FIX ── */

/* Email input */
.authentication-wrapper .form-control {
    border: 1.5px solid #d0d3db !important;
    border-radius: 8px !important;
    padding: 10px 14px !important;
    font-size: 14px !important;
    color: #1a1c23 !important;
    background-color: #ffffff !important;
    box-shadow: none !important;
    transition: border-color .2s, box-shadow .2s !important;
}

.authentication-wrapper .form-control:focus {
    border-color: #6c63ff !important;
    box-shadow: 0 0 0 3px rgba(108,99,255,0.15) !important;
    outline: none !important;
}

.authentication-wrapper .form-control::placeholder {
    color: #adb5bd !important;
    font-size: 13px !important;
}

/* ── PASSWORD FIELD FIX ── */
/* Outer wrapper gets the border */
.authentication-wrapper .input-group.input-group-merge {
    border: 1.5px solid #d0d3db !important;
    border-radius: 8px !important;
    background: #ffffff !important;
    overflow: hidden !important;
    transition: border-color .2s, box-shadow .2s !important;
}

/* Focus state on password wrapper */
.authentication-wrapper .input-group.input-group-merge:focus-within {
    border-color: #6c63ff !important;
    box-shadow: 0 0 0 3px rgba(108,99,255,0.15) !important;
}

/* Remove border from inner input — outer wrapper handles it */
.authentication-wrapper .input-group.input-group-merge .form-control {
    border: none !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    background: transparent !important;
}

/* Eye icon button */
.authentication-wrapper .input-group.input-group-merge .input-group-text {
    border: none !important;
    background: #ffffff !important;
    color: #9ca3af !important;
    padding: 0 12px !important;
}
 </style>
 <div class="container-xxl">
     <div class="authentication-wrapper authentication-basic container-p-y">
         <div class="authentication-inner">
             <!-- Register -->
             <div class="card px-sm-6 px-0">
                 <div class="card-body">
                     <!-- Logo -->
                     <div class="app-brand justify-content-center">
                         <a href="javascript:void(0);" class="app-brand-link gap-2">
                             <span class="app-brand-logo demo">
                                 <img src="{{ asset('admin/assets/img/logos/login_logo.png') }}" alt=""
                                     height="115" width="230" />

                             </span>
                         </a>
                     </div>
                     <!-- /Logo -->
                     <h4 class="mb-1">Welcome ! 👋</h4>

                     <form id="formAuthentication"class="mb-6" method="POST" action="{{ route('login') }}">
                        @csrf
                     <div class="mb-6">
                         <label for="email" class="form-label">Email </label>
                         <input type="text" class="form-control" id="email" name="email"
                             placeholder="Enter your email" autofocus />
                     </div>
                     <div class="mb-6 form-password-toggle">
                         <label class="form-label" for="password">Password</label>
                         <div class="input-group input-group-merge">
                             <input type="password" id="password" class="form-control" name="password"
                                 placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                 aria-describedby="password" />
                             <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                         </div>
                     </div>
                     <div class="mb-8">
                         <div class="d-flex justify-content-between">
                             <div class="form-check mb-0">
                                 <input class="form-check-input" type="checkbox" id="remember-me" />
                                 <label class="form-check-label" for="remember-me"> Remember Me </label>
                             </div>

                             @if (Route::has('password.request'))
                                     <a  href="{{ route('password.request') }}">
                                         <span>Forgot Password?</span>
                                     </a>
                                 </a>
                             @endif
                         </div>
                     </div>
                     <div class="mb-6">
                         <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                     </div>
                     </form>

                     {{-- <p class="text-center">
                         <span>New on our platform?</span>
                         <a href="auth-register-basic.html">
                             <span>Create an account</span>
                         </a>
                     </p> --}}
                 </div>
             </div>
             <!-- /Register -->
         </div>
     </div>
 </div>
