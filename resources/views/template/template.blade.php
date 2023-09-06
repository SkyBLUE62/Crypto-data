<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset("assets/vendors/mdi/css/materialdesignicons.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/vendors/css/vendor.bundle.base.css")}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset("assets/vendors/jvectormap/jquery-jvectormap.css")}}">
    <link rel="stylesheet" href="{{asset("assets/vendors/flag-icon-css/css/flag-icon.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/vendors/owl-carousel-2/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/vendors/owl-carousel-2/owl.theme.default.min.css")}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    @yield('css')
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset("assets/css/jquery-ui.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset("assets/images/favicon.png")}}" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <!-- start navbar -->
<?php $user = Auth::user(); ?>
        @include('include.nav')
        <!-- end navbar -->

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav w-100">
                        <li class="nav-item w-100">
                            <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" method="post" action="{{url('/search/redirect')}}">
                                @csrf
                                <input type="text" class="form-control" id="searchInput" placeholder="Search coin" name="searchbar">
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <?php if (Auth::user() == true) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                <div class="navbar-profile">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{$user['name']}}</p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
                                <h6 class="p-3 mb-0">Profile</h6>
                                <div class="dropdown-divider"></div>
                                {{-- <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-settings text-success"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Settings</p>
                                    </div>
                                </a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="{{url('/logout')}}">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Log out</p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a href="{{url('/signup')}}" class="btn btn-outline-light btn-rounded get-started-btn">Connexion</a>
                            </li>
                      <?php  } ?>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->


            <div class="main-panel">
                <!-- start wrapper -->
                <div class="content-wrapper">
                    @yield('content')
                </div>

                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Thomas
                            Alexandre</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset("assets/vendors/js/vendor.bundle.base.js")}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset("assets/vendors/chart.js/Chart.min.js")}}"></script>
    <script src="{{asset("assets/vendors/progressbar.js/progressbar.min.js")}}"></script>
    <script src="{{asset("assets/vendors/jvectormap/jquery-jvectormap.min.js")}}"></script>
    <script src="{{asset("assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js")}}"></script>
    <script src="{{asset("assets/vendors/owl-carousel-2/owl.carousel.min.js")}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset("assets/js/off-canvas.js")}}"></script>
    <script src="{{asset("assets/js/hoverable-collapse.js")}}"></script>
    <script src="{{asset("assets/js/misc.js")}}"></script>
    <script src="{{asset("assets/js/settings.js")}}"></script>
    <script src="{{asset("assets/js/todolist.js")}}"></script>
    <script src="{{asset("assets/js/jquery-ui.min.js")}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset("assets/js/dashboard.js")}}"></script>
    <script src="{{asset("assets/js/search/search.js")}}"></script>

    @yield('script')
    <!-- End custom js for this page -->
</body>

</html>
