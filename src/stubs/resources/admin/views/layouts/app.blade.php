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
    <body>
        <div id="app">
            <div id="wrapper">

                <!-- Sidebar -->
                @include('Admin::layouts.partials.sidebar')
                <!-- End of Sidebar -->

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Topbar -->
                        @include('Admin::layouts.partials.top.nav')
                        <!-- End of Topbar -->

                        <!-- Begin Page Content -->
                        <div class="container-fluid">
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

            <!-- Scroll to Top Button -->
            <a class="scroll-to-top rounded">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Modals-->
            @include('Admin::layouts.partials.modal-logout')
            @include('Admin::layouts.partials.modal-delete')
            <!-- End of Logout Modal -->
        </div>
        <!-- Scripts -->
        <script src="{{ asset('vendor/admin/js/manifest.js') }}"></script>
        <script src="{{ asset('vendor/admin/js/vendor.js') }}"></script>
        <script src="{{ asset('vendor/admin/js/app.js') }}"></script>
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
        @stack('scripts')
    </body>
</html>
