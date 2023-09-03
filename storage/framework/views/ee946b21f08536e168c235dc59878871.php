<div class="card-body">
    <p class="login-box-msg"><?php echo e(__('Login in to start your session')); ?></p>
    <form wire:submit="login">
        <div class="input-group mb-3">
            <input wire:model="email" type="email" class="form-control" placeholder="<?php echo e(__('Email')); ?>" autocomplete="email" autofocus required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input wire:model="password" type="password" class="form-control" placeholder="<?php echo e(__('Password')); ?>" autocomplete="new-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input wire:model="remember" type="checkbox" id="remember">
                    <label for="remember"><?php echo e(__('Remember Me')); ?></label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('Log In')); ?></button>
            </div>
        </div>
    </form>
    <div class="mt-3 text-center">
        <p>
            <a href="<?php echo e(route('forgot.password')); ?>" wire:navigate><?php echo e(__('I forgot my password')); ?></a>
        </p>
    </div>
</div>
<?php /**PATH /Users/tahirkhanafridi/Sites/filemanager/resources/views/livewire/auth/pages/login.blade.php ENDPATH**/ ?>