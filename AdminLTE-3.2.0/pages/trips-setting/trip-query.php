<?php
include '../../../user/config.php';


session_start();

if (isset($_SESSION['admin_name']) && isset($_SESSION['admin_id'])) {
    $user_id = $_SESSION['admin_id'];
    $user_name = $_SESSION['admin_name'];
}
else{
    header('location:../../login.php');
  }

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
    if (isset($_POST['delete_trip'])) {
        // Check if trip_id is set
        if (isset($_POST['trip_id']) && !empty($_POST['trip_id'])) {
            $trip_id = $_POST['trip_id'];
            
            // Delete query
            $delete_query = "DELETE FROM trip_query WHERE id = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param('i', $trip_id);

            if ($stmt->execute()) {
                echo "<script>alert('Query successfully Delete!'); window.location.href='trip-query.php';</script>";
            } else {
                echo "Error deleting trip: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "cant fetch id";
        }
    }

    if (isset($_POST['update_trip'])) {
        $trip_id = $_POST['trip_id'];

        // Redirect to update page (create an update_trip.php page to handle updates)
        header("Location: trip-update/update-coupen.php?trip_id=$trip_id");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Trip-Query</title>

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
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index.php" class="nav-link">Home</a>
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
            <a href="../../index.php" class="brand-link">
                <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin Page</span>
            </a>

            <?php
            include '../UI/fixed-aside.php';
            ?>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Trip Query</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                                <li class="breadcrumb-item active">Trip Query</li>
                            </ol>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <!-- add new trip -->
                        <div class="row add-trip">
                            <div class="col-12 my-5">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Trip-Id</th>
                                            <th scope="col">Trip-Name</th>
                                            <th scope="col">User Name</th>
                                            <th scope="col">User Email</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Message</th>
                                            <th scope="col">Update / Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Pagination variables
                                        $limit = 10; // Number of entries to show per page
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $start = ($page - 1) * $limit;

                                        // Query to select data with pagination and ordering by latest first
                                        $select_user = mysqli_query($conn, "SELECT * FROM `trip_query` ORDER BY `id` DESC LIMIT $start, $limit") or die('Query failed');

                                        if (mysqli_num_rows($select_user) > 0) {
                                            while ($fetch_user = mysqli_fetch_assoc($select_user)) {
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo $fetch_user['id']; ?></th>
                                                    <th scope="row"><?php echo $fetch_user['trip_id']; ?></th>
                                                    <th scope="row"><?php echo $fetch_user['trip_name']; ?></th>
                                                    <td><?php echo $fetch_user['name']; ?></td>
                                                    <td><?php echo $fetch_user['email']; ?></td>
                                                    <td><?php echo $fetch_user['subject']; ?></td>
                                                    <td><?php echo $fetch_user['message']; ?></td>
                                                    <td>
                                                        <form method="post" action="">
                                                            <input type="hidden" name="trip_id" value="<?php echo $fetch_user['id']; ?>">
                                                            <input type="submit" name="delete_trip" class="btn btn-warning" value="Delete">
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo '<p class="empty">No Trip Queries yet!</p>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                    
                                <!-- Pagination -->
                                <?php
                                // Get the total number of records
                                $result_db = mysqli_query($conn, "SELECT COUNT(id) FROM `trip_query`");
                                $row_db = mysqli_fetch_row($result_db);
                                $total_records = $row_db[0];
                                $total_pages = ceil($total_records / $limit);
                                    
                                if ($total_pages > 1) {
                                    echo '<nav aria-label="Page navigation example">';
                                    echo '<ul class="pagination justify-content-start">';
                                
                                    // Previous button
                                    if ($page > 1) {
                                        echo sprintf(
                                            '<li class="page-item"><a class="page-link" href="trip-query.php?page=%d">Previous</a></li>',
                                            $page - 1
                                        );
                                    } else {
                                        echo '<li class="page-item disabled"><a class="page-link">Previous</a></li>';
                                    }
                                
                                    // Page numbers
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        $active = ($i == $page) ? 'active' : '';
                                        echo sprintf(
                                            '<li class="page-item %s"><a class="page-link" href="trip-query.php?page=%d">%d</a></li>',
                                            $active,
                                            $i,
                                            $i
                                        );
                                    }
                                
                                    // Next button
                                    if ($page < $total_pages) {
                                        echo sprintf(
                                            '<li class="page-item"><a class="page-link" href="trip-query.php?page=%d">Next</a></li>',
                                            $page + 1
                                        );
                                    } else {
                                        echo '<li class="page-item disabled"><a class="page-link">Next</a></li>';
                                    }
                                
                                    echo '</ul>';
                                    echo '</nav>';
                                }
                                
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                            
            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>

        <!-- footer link -->
        <?php
        include ('../../../components/header-footer/footer.php');
        ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
</body>

</html>