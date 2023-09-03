<div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="javascript:void(0);" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav m-auto text-center">
            <li class="nav-item">
                <a wire:navigate class="nav-link d-inline" href="<?php echo e(route('admin.index')); ?>">
                    <!-- __BLOCK__ --><?php if(getLogo()): ?>
                        <img src="<?php echo e(getLogo()); ?>" class="img-fluid" style="height: 41px;" alt="<?php echo e(config('app.name', 'Laravel')); ?>">
                    <?php endif; ?> <!-- __ENDBLOCK__ -->
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-cog"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a wire:click="editProfile" href="javascript:void(0);" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                    <a wire:click="logout" href="#" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <!--Start: Edit Profile Modal -->
    <div wire:ignore.self class="modal fade" id="edit_profile_modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark px-3 py-2">
                    <h5 class="modal-title text-white"><?php echo e(__('Users')); ?> - <small><?php echo e(__('Edit Profile')); ?></small></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit="updateProfile">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name <i class="text-danger">*</i></label>
                                    <input wire:model="form.name" type="text" class="form-control" placeholder="John Doe" required>
                                    <!-- __BLOCK__ --><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="form-text text-danger"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!-- __ENDBLOCK__ -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <i class="text-danger">*</i></label>
                                    <input wire:model="form.email" type="email" class="form-control" placeholder="yourname@example.com" required>
                                    <!-- __BLOCK__ --><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="form-text text-danger"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!-- __ENDBLOCK__ -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input wire:model="form.password" type="password" class="form-control" autocomplete="new-password" placeholder="******">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input wire:model="form.password_confirmation" type="password" class="form-control" autocomplete="new-password" placeholder="******">
                                </div>
                            </div>
                            <!-- __BLOCK__ --><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="col-sm-12 text-center">
                                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!-- __ENDBLOCK__ -->
                            <div class="col-sm-12 mt-4 text-right">
                                <button type="button" class="btn btn-default mr-1" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End: Edit Profile Modal -->
</div>

<?php /**PATH /Users/tahirkhanafridi/Sites/filemanager/resources/views/livewire/admin/components/header.blade.php ENDPATH**/ ?>