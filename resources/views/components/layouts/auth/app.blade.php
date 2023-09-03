<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - {{ __('Dashboard') }}</title>

        <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" async>
        <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="{{ asset('adminlte') }}/custom/style.css">
        @stack('style')

        <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <img src="{{ asset('images/logo-wide.svg') }}" class="img-fluid" alt="{{ config('app.name', 'Laravel') }}" title="{{ config('app.name', 'Laravel') }}">
                </div>
                
                {{ $slot }}
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

            @if (session()->has('success'))
                toastr['success']("{{ session('success') }}", "Success!", {
                    'timeOut': 6000,
                    'extendedTimeOut': 6000,
                    'closeButton': true,
                    'preventDuplicates': true
                });
            @endif

            @if (session()->has('error'))
                toastr['error']("{{ session('error') }}", "Error!", {
                    'timeOut': 6000,
                    'extendedTimeOut': 6000,
                    'closeButton': true,
                    'preventDuplicates': true
                });
            @endif
        </script>

        @stack('script')
    </body>
</html>
