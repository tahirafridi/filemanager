<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?>: <?php echo e(__('Admin Panel')); ?></title>

        <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.svg')); ?>" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/dist/css/adminlte.min.css">
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/custom/style.css">
        <?php echo $__env->yieldContent('style'); ?>

        <script src="<?php echo e(asset('adminlte')); ?>/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo e(asset('adminlte')); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="<?php echo e(asset('adminlte')); ?>/dist/js/adminlte.min.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

        <script>
            function copyText(obj, id) {
                // Get the text field
                var copyText = document.getElementById(id);

                // Select the text field
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices

                // Copy the text inside the text field
                navigator.clipboard.writeText(copyText.value);

                obj.text('Copied').addClass('text-success');

                setTimeout(() => {
                    obj.text('Copy').removeClass('text-success');
                }, 3000);
            }
        </script>
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.components.header', []);

$__html = app('livewire')->mount($__name, $__params, '2SzV8xi', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <div class="text-center">
                    <span class="brand-link text-white-50">MENU</span>
                </div>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a wire:navigate href="<?php echo e(route('admin.index')); ?>" class="nav-link <?php echo e(request()->is('admin') ? 'active' : ''); ?>">
                                    <i class="nav-icon fa fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('folder_access')): ?>
                                <li class="nav-item">
                                    <a wire:navigate href="<?php echo e(route('admin.folders.index')); ?>" class="nav-link <?php echo e(request()->is('admin/folders*') ? 'active' : ''); ?>">
                                        <i class="nav-icon fas fa-folder-open"></i>
                                        <p>Folders</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('file_access')): ?>
                                <li class="nav-item">
                                    <a wire:navigate href="<?php echo e(route('admin.files.index')); ?>" class="nav-link <?php echo e(request()->is('admin/files*') ? 'active' : ''); ?>">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>Files</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user_access', 'role_access'])): ?>
                                <li class="nav-item  <?php echo e(request()->is('admin/users*') ? 'menu-open' : ''); ?>">
                                    <a href="#" class="nav-link <?php echo e(request()->is('admin/users*') ? 'active' : ''); ?>">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>Users <i class="fas fa-angle-left right"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_access')): ?>
                                            <li class="nav-item">
                                                <a wire:navigate href="<?php echo e(route('admin.users.index')); ?>" class="nav-link <?php echo e(request()->is('admin/users') ? 'active' : ''); ?>">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>All Users</p>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_access')): ?>
                                            <li class="nav-item">
                                                <a wire:navigate href="<?php echo e(route('admin.roles.index')); ?>" class="nav-link <?php echo e(request()->is('admin/users/roles*') ? 'active' : ''); ?>">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Roles</p>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting_access')): ?>
                                <li class="nav-item">
                                    <a wire:navigate href="<?php echo e(route('admin.settings.index')); ?>" class="nav-link <?php echo e(request()->is('admin/settings*') ? 'active' : ''); ?>">
                                        <i class="nav-icon fas fa-wrench"></i>
                                        <p>Settings</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <?php echo e($slot); ?>

            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <div class="row">
                    <div class="col">
                        <?php if(getLogo()): ?>
                            <img src="<?php echo e(getLogo()); ?>" class="img-fluid" style="height: 35px;" alt="<?php echo e(config('app.name', 'Laravel')); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="col">
                        <div class="text-right mt-2">
                            Developed by <strong><a href="https://tahirafridi.com" target="_blank">Tahir Afridi</a></strong>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->

        <script>
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('toastr', param => {
                    $('#add_modal').modal('hide');
                    $('#edit_modal').modal('hide');
                    $('#edit_profile_modal').modal('hide');

                    toastr.clear();

                    param = param[0] ?? param;
                    toastr[param['type']](param['message'], param['heading'], {
                        'timeOut': param['timeOut'],
                        'extendedTimeOut': param['timeOut'],
                        'closeButton': param['closeButton'],
                        // 'preventDuplicates': param['preventDuplicates'],
                        "positionClass": "toast-top-right",
                        "progressBar": true,
                    });
                });

                Livewire.on('showDeleteConfirmationModal', function () {
                    $('#delete-confirmation-modal').modal({
                        keyboard: false,
                        'backdrop': 'static'
                    });
                });

                Livewire.on('showEditProfileModal', function () {
                    $('#edit_profile_modal').modal({
                        keyboard: false,
                        'backdrop': 'static'
                    });
                });

                Livewire.on('showAddModal', function () {
                    $('#add_modal').modal({
                        keyboard: false,
                        'backdrop': 'static'
                    });
                });

                Livewire.on('showViewModal', function () {
                    $('#view_modal').modal({
                        keyboard: false,
                        'backdrop': 'static'
                    });
                });

                Livewire.on('showEditModal', function () {
                    $('#edit_modal').modal({
                        keyboard: false,
                        'backdrop': 'static'
                    });
                });

                Livewire.on('closeAddModal', function () {
                    $('#add_modal').modal('hide');
                });

                Livewire.on('closeEditModal', function () {
                    $('#edit_modal').modal('hide');
                });

                Livewire.on('showFixedConfirmationModal', function () {
                    $('#fixed-confirmation-modal').modal({
                        keyboard: false,
                        'backdrop': 'static'
                    });
                });

                Livewire.on('showSharegModal', function () {
                    $('#share_modal').modal({
                        keyboard: false,
                        'backdrop': 'static'
                    });
                });

                Livewire.on('closeEditProfileModal', function () {
                    $('#edit_profile_modal').modal('hide');
                });

                Livewire.on('setFocus', function (param) {
                    setTimeout(() => {
                        $(`${param[0]}`).focus();
                    }, 500);
                });
            });
        </script>
    </body>
</html>
<?php /**PATH /Users/tahirkhanafridi/Sites/filemanager/resources/views/components/layouts/admin/app.blade.php ENDPATH**/ ?>