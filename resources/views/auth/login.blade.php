<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="logo d-flex align-items-center w-auto">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
            <p class="text-center small">Enter your username & password to login</p>
        </div>


        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" class="row g-3">
            @csrf

            <!-- Email Address -->
            <div class="col-12">
                <x-label for="email" :value="__('Email')" />
                <div class="input-group">
                    <span class="input-group-text">@</span>
                    <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                </div>
            </div>

            <!-- Password -->
            <div class="col-12">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="col-12">
                <div class="form-check">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                </div>
            </div>

            <x-button class="ml-3">
                {{ __('Log in') }}
            </x-button>

            <div class="col-12">
                <p class="small mb-0">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </p>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
