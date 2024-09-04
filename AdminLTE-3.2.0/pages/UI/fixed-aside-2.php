<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | only Aside menu</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block" style="color:white;">
                            <?php
                            if (isset($_SESSION['admin_name'])) {
                                echo "$user_name";
                            } else {
                                echo "admin page";
                            }
                            ?>
                        </a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="../../../index.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../widgets.php" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Widgets
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                        <!-- trip-section start -->
                        <li class="nav-header">TRIPS</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>
                                    Trips Setting
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../../trips-setting/destination.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Destination</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../trips-setting/add-trip.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Trips</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../trips-setting/trip-coupen.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Trips Coupen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../trips-setting/trip-categories.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Trips Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../trips-setting/trip-room.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Trips Hotels</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../trips-setting/trip-bus.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Trips Bus</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="../../trips-setting/trip-query.php" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Trips querys
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../ticket-booking.php" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Tickets Booking
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li>
                        <!-- trip-section over -->
                        <li class="nav-header">Extra Section</li>
                        <!-- blog -->
                        <li class="nav-item">
                            <a href="../../blog.php" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Blog
                                </p>
                            </a>
                        </li>
                        <!-- calender -->
                        <li class="nav-item">
                            <a href="../../calendar.php" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Calendar
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li>
                        <!-- mail box -->
                        <li class="nav-item">
                            <a href="../../mailbox/mailbox.php" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>Mail Box</p>
                                <span class="badge badge-info right">2</span>
                            </a>
                        </li>
                        <li class="nav-header">All Users</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>
                                    Site User
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../../site-users/admin.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Admin</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../site-users/user.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="../../../../user/logout.php" class="btn btn-success nav-link">
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
    </div>



        <!-- jQuery -->
        <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
</body>