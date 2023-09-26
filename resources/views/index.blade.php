<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Inventory - Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Head js -->
    <script src="{{ asset('assets/js/head.js') }}"></script>
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


    @vite(['resources/js/app.js', 'resources/css/app.css'])

</head>

<!-- body start -->


<body data-layout-mode="default" data-theme="light" data-topbar-color="dark" data-menu-position="fixed"
    data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>
    <div id="app">
        <!-- auth pages -->
        <div id="auth" v-if="$route.path === '/login' || $route.path === '/register' || $route.path === '/forgot'">
            <router-view></router-view>
        </div>

        <!-- Begin page -->
        <div id="wrapper">


            <!-- Topbar Start -->
            @include('body.header')
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('body.sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <router-view></router-view>


                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                @include('body.footer')
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
    </div>

    <!-- END wrapper -->

    <!-- Right Sidebar -->
    @include('body.right_sidebar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!-- Vendor js -->

    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}


    <!-- Dashboar 1 init js-->
    {{-- <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script> --}}

    <!-- App js-->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <!-- datatables -->
    {{-- <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script> --}}
    <!-- datatable ends -->

    <!-- Datatables init -->
    {{-- <script src="assets/js/pages/datatables.init.js"></script> --}}

    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"></script>
    <!-- showing sidebar,topbar,footer-->
    <script>
        $(function() {
            let token = localStorage.getItem('token');
            if (token) {
                $('#sidebar').removeClass('d-none')
                $('#header').removeClass('d-none')
                $('#footer').removeClass('d-none')

            }
        })
    </script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    {{-- token timeout logic --}}
    <script>
        let lastUserActivityTime = Date.now();

        function trackUserActivity() {
            lastUserActivityTime = Date.now();
        }
        // Attach event listeners to track user activity
        document.addEventListener('mousemove', trackUserActivity);
        document.addEventListener('keydown', trackUserActivity);

        function checkTokenAndInactivity() {
            const MAX_INACTIVITY_TIME = 3600000 // 1 hour in milliseconds
            const token = localStorage.getItem('token');
            if (token) {
                if ((Date.now() - lastUserActivityTime) > MAX_INACTIVITY_TIME) {
                    localStorage.removeItem('token');
                    localStorage.removeItem('user');
                    router.push('/login');

                }


            }
        }

        setInterval(checkTokenAndInactivity, 1000);
    </script>

</body>

</html>
