{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

 <div class="container-xxl">
     <div class="authentication-wrapper authentication-basic container-p-y">
         <div class="authentication-inner">
             <!-- Register -->
             <div class="card px-sm-6 px-0">
                 <div class="card-body">
                     <!-- Logo -->
                     <div class="app-brand justify-content-center">
                         <a href="index.html" class="app-brand-link gap-2">
                             <span class="app-brand-logo demo">
                                 <img src="{{ asset('admin/assets/img/logos/login_logo.png') }}" alt=""
                                     height="115" width="230" />

                             </span>
                         </a>
                     </div>
                     <!-- /Logo -->
                     <h4 class="mb-1">Reset Password</h4>

                     <form id="reset_password"class="mb-6" method="POST" action="{{ route('password.store') }}">
                        @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                     <div class="mb-6">
                         <label for="email" class="form-label">Email </label>
                         <input type="text" class="form-control" id="email" name="email"  value="{{  $request->email}}"
                             placeholder="Enter your email" autofocus readonly/>
                     </div>
                     <div class="mb-6">
                         <label for="password" class="form-label">Password </label>
                         <input  type="password" class="form-control" id="password" name="password"
                             placeholder="Enter your password" autofocus />
                     </div>
                     <div class="mb-6">
                         <label for="password_confirmation" class="form-label">Confirm Password </label>
                         <input  type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                             placeholder="Confirm your password" autofocus />
                     </div>

                     <div class="mb-8">



                         </div>
                     </div>
                     <div class="mb-6">
                         <button class="btn btn-primary d-grid w-100" type="submit">Reset Password</button>
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
