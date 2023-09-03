<div class="card-body">
    <p class="login-box-msg">{{ __('You forgot your password? Here you can easily retrieve a new password.') }}</p>
    <form wire:submit="generateNewPassword">
        <div class="input-group mb-3">
            <input wire:model="email" type="email" class="form-control" placeholder="{{ __('Email') }}" autocomplete="email" autofocus required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        @error('email') <p><small class="text-danger">{{ $message }}</small></p> @enderror
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Request new password') }}</button>
            </div>
        </div>
    </form>

    <p class="mt-3 mb-1 text-right">
        Already have an account? <a href="{{ route('login') }}" wire:navigate>{{ __('Login') }}</a>
    </p>
</div>
