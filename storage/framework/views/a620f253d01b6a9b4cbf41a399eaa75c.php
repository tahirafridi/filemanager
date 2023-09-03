<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?> - <?php echo e(__('Dashboard')); ?></title>

        <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.svg')); ?>" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" async>
        <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('adminlte')); ?>/custom/style.css">
        <?php echo $__env->yieldPushContent('style'); ?>

        <script src="<?php echo e(asset('adminlte')); ?>/plugins/jquery/jquery.min.js"></script>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <img src="<?php echo e(asset('images/logo-wide.svg')); ?>" class="img-fluid" alt="<?php echo e(config('app.name', 'Laravel')); ?>" title="<?php echo e(config('app.name', 'Laravel')); ?>">
                </div>
                
                <?php echo e($slot); ?>

            </div>
        </div>
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('toastr', param => {
                    param = param[0] ?? param;
                    toastr[param['type']](param['message'], param['heading'], {
                        'timeOut': param['timeOut'],
                        'extendedTimeOut': param['timeOut'],
                        'closeButton': param['closeButton'],
                        'preventDuplicates': param['preventDuplicates']
                    });
                });
            });

            <?php if(session()->has('success')): ?>
                toastr['success']("<?php echo e(session('success')); ?>", "Success!", {
                    'timeOut': 6000,
                    'extendedTimeOut': 6000,
                    'closeButton': true,
                    'preventDuplicates': true
                });
            <?php endif; ?>

            <?php if(session()->has('error')): ?>
                toastr['error']("<?php echo e(session('error')); ?>", "Error!", {
                    'timeOut': 6000,
                    'extendedTimeOut': 6000,
                    'closeButton': true,
                    'preventDuplicates': true
                });
            <?php endif; ?>
        </script>

        <?php echo $__env->yieldPushContent('script'); ?>
    </body>
</html>
<?php /**PATH /Users/tahirkhanafridi/Sites/filemanager/resources/views/components/layouts/auth/app.blade.php ENDPATH**/ ?>