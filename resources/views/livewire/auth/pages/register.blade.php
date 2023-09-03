<div class="card-body">
    <p class="login-box-msg">{{ __('Register Your Account') }}</p>
    <form wire:submit="register">
        <div class="mb-3">
            <div class="input-group">
                <input wire:model="name" type="text" class="form-control" placeholder="{{ __('Your Name') }}" autofocus required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            @error('name')<small class="form-text text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3">
            <div class="input-group">
                <input wire:model="email" type="email" class="form-control" placeholder="{{ __('Email') }}" autocomplete="email" autofocus required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            @error('email')<small class="form-text text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="row">
            <div class="col-8">
                {{ __('Have an account?') }} <a href="{{ route('login') }}" wire:navigate>Login</a>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
            </div>
        </div>
    </form>
</div>
