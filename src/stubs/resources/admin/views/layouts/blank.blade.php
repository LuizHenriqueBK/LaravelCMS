<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#FEE49F">
    <meta name="msapplication-TileColor" content="#c3c3c3">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('vendor/admin/css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-gradient-primary">
    <div id="wrapper" style="height: 100vh;">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid" id="app">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            @include('Admin::layouts.partials.footer')
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    @if(session()->has('toast_error'))
        <script type="text/javascript">
            Swal.fire({
              icon: 'error',
              title: "{{ session()->pull('toast_error') }}",
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 10000,
              timerProgressBar: true
            });
        </script>
    @endif
    @stack('scripts')
</body>
</html>
