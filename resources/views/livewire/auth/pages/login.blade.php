<div class="card-body">
    <p class="login-box-msg">{{ __('Login in to start your session') }}</p>
    <form wire:submit="login">
        <div class="input-group">
            <input wire:model="email" type="email" class="form-control" placeholder="{{ __('Email') }}" autocomplete="email" autofocus required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        @error('email')<small class="form-text text-danger">{{ $message }}</small>@enderror

        <div class="input-group mt-3">
            <input wire:model="password" type="password" class="form-control" placeholder="{{ __('Password') }}" autocomplete="new-password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        @error('password')<small class="form-text text-danger">{{ $message }}</small>@enderror

        <div class="row mt-3">
            <div class="col-8">
                <div class="icheck-primary">
                    <input wire:model="remember" type="checkbox" id="remember">
                    <label for="remember">{{ __('Remember Me') }}</label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Log In') }}</button>
            </div>
        </div>
    </form>
    <div class="mt-3 text-center">
        <p>
            <a href="{{ route('forgot.password') }}" wire:navigate>{{ __('I forgot my password') }}</a>
        </p>
    </div>
</div>
