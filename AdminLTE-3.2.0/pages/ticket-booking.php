<?php
include '../../user/config.php';
session_start();

if (isset($_SESSION['admin_name']) && isset($_SESSION['admin_id'])) {
    $user_id = $_SESSION['admin_id'];
    $user_name = $_SESSION['admin_name'];
  }
  else{
    header('location:../login.php');
  }

// Handle booking status update
if (isset($_POST['update_status'])) {
    $trip_id = $_POST['trip_id'];
    $status = $_POST['status'];

    $update_query = "UPDATE `trip_bookings` SET `status`='$status' WHERE `id`='$trip_id'";
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        $_SESSION['message'] = 'Booking status updated successfully!';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Failed to update booking status.';
        $_SESSION['message_type'] = 'danger';
    }

    header('Location:ticket-booking.php'); // Redirect back to booking page
    exit();
}

// Handle booking deletion
if (isset($_POST['delete_trip'])) {
    $trip_id = $_POST['trip_id'];

    $delete_query = "DELETE FROM `trip_bookings` WHERE `id`='$trip_id'";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        $_SESSION['message'] = 'Booking deleted successfully!';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Failed to delete booking.';
        $_SESSION['message_type'] = 'danger';
    }

    header('Location: ticket-booking.php'); // Redirect back to booking page
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Ticket-Booking</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../index.php" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Page</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
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
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="../index.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <!-- <i class="right fas fa-angle-left"></i> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="widgets.php" class="nav-link">
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
                  <a href="trips-setting/destination.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Destination</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="trips-setting/add-trip.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Trips</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="trips-setting/trip-coupen.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Trips Coupen</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="trips-setting/trip-categories.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Trips Categories</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="trips-setting/trip-types.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Trips Types</p>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="trips-setting/trip-room.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Trips Hotels</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="trips-setting/trip-bus.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Trips Bus</p>
                    </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
            <a href="trips-setting/trip-query.php" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        Trips querys
                        <span class="badge badge-info right">2</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="ticket-booking.php" class="nav-link">
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
                <a href="blog.php" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        Blog
                    </p>
                </a>
            </li>
            <!-- calender -->
            <li class="nav-item">
                <a href="calendar.php" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        Calendar
                        <span class="badge badge-info right">2</span>
                    </p>
                </a>
            </li>
            <!-- mail box -->
            <li class="nav-item">
                <a href="mailbox/mailbox.php" class="nav-link">
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
                          <a href="site-users/admin.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Admin</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="site-users/user.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Users</p>
                          </a>
                      </li>
                  </ul>
              </li>
            <li class="nav-item">
              <a href="../../user/logout.php" class="btn btn-success nav-link">
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
    </aside>


        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Ticket Booking</h1>
          </div>
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item active">ticket-booking</li>
                </ol>
          </div>
        </div>
        <div class="row trip-booking-list">
            <div class="col-12 my-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Trip Name</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Trip Price</th>
                            <th scope="col">Booking Date</th>
                            <th scope="col">Adult Qty</th>
                            <th scope="col">Child Qty</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Update/Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Pagination variables
                    $limit = 10; // Number of bookings per page
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $start = ($page - 1) * $limit;
                            
                    // Fetch bookings ordered by oldest booking date first with pagination
                    $select_user = mysqli_query($conn, "SELECT * FROM `trip_bookings` ORDER BY id DESC LIMIT $start, $limit") or die('Query failed');
                            
                    if (mysqli_num_rows($select_user) > 0) {
                        while ($fetch_user = mysqli_fetch_assoc($select_user)) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $fetch_user['id']; ?></th>
                        <td><?php echo $fetch_user['trip_name']; ?></td>
                        <td><?php echo $fetch_user['destination']; ?></td>
                        <td><?php echo $fetch_user['trip_price']; ?></td>
                        <td><?php echo $fetch_user['booking_date']; ?></td>
                        <td><?php echo $fetch_user['adult_qty']; ?></td>
                        <td><?php echo $fetch_user['child_qty']; ?></td>
                        <td><?php echo $fetch_user['total_price']; ?></td>
                        <td>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="trip_id" value="<?php echo $fetch_user['id']; ?>">
                                <select name="status" class="form-control">
                                    <option value="pending" <?php if ($fetch_user['status'] == 'pending') { echo 'selected'; } ?>>Pending</option>
                                    <option value="Confirmed" <?php if ($fetch_user['status'] == 'Confirmed') { echo 'selected'; } ?>>Confirmed</option>
                                    <option value="Canceled" <?php if ($fetch_user['status'] == 'Canceled') { echo 'selected'; } ?>>Canceled</option>
                                </select>
                                <input type="submit" name="update_status" class="btn btn-warning mt-2" value="Update Status">
                                <input type="submit" name="delete_trip" class="btn btn-danger mt-2" value="Delete">
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<p class="empty">No bookings available!</p>';
                    }
                    ?>
                    </tbody>
                </table>
                      
                <!-- Bootstrap Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php
                        // Count total number of rows
                        $total_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM `trip_bookings`");
                        $total_result = mysqli_fetch_assoc($total_query);
                        $total_pages = ceil($total_result['total'] / $limit);
                      
                        // Display previous button
                        if ($page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?page='.($page - 1).'">Previous</a></li>';
                        }
                      
                        // Display page numbers
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo '<li class="page-item '.($i == $page ? 'active' : '').'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                        }
                      
                        // Display next button
                        if ($page < $total_pages) {
                            echo '<li class="page-item"><a class="page-link" href="?page='.($page + 1).'">Next</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
    </div>



        <!-- footer link -->
        <?php
        include ('../../components/header-footer/footer.php');
        ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
  </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
</body>

</html>