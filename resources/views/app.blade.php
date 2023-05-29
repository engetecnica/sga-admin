<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SGA-E | @if (View::hasSection('title'))
            @yield('title')
        @else
            Dashboard
        @endif
    </title>
    <!-- plugins:css -->
    <link href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendors/css/vendor.bundle.base.css') }}" rel="stylesheet">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- End layout styles -->
    <link href="{{ asset('assets/images/favicon.ico') }}" rel="shortcut icon" />
</head>

<body>
    <div class="container-scroller">
        @yield('content')
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <!-- endinject -->
</body>

</html>
