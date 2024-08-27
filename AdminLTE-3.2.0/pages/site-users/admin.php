<?php
include '../../../user/config.php';

session_start();

if (isset($_SESSION['admin_name']) && isset($_SESSION['admin_id'])) {
    $user_id = $_SESSION['admin_id'];
    $user_name = $_SESSION['admin_name'];  
} else {
    header('location:../../login.php');
    exit();
}

if (isset($_POST['admin_crete'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user-roll']);

    // Handle file upload
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'user_img/' . $image; // Updated to 'user-img' folder

    if ($pass != $cpass) {
        $message[] = 'Confirm password does not match!';
    } else {
        // Validate file upload
        $allowed_types = ['image/jpg', 'image/jpeg', 'image/png'];
        $image_type = $_FILES['image']['type'];
        
        if (in_array($image_type, $allowed_types)) {
            if ($image_size <= 5000000) { // Limit file size to 5MB
                if (move_uploaded_file($image_tmp_name, $image_folder)) {
                    $pass = md5($pass); // Hash password

                    // Check if user already exists
                    $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('Query failed');
                    if (mysqli_num_rows($select_users) > 0) {
                        $message[] = 'User already exists!';
                    } else {
                        // Insert new user
                        $result = mysqli_query($conn, "INSERT INTO `user`(image, name, email, password, user_type) VALUES('$image', '$name', '$email', '$pass', '$user_type')") or die('Query failed');
                        if ($result) {
                            $message[] = 'Registered successfully!';
                            header('location:login.php');
                            exit();
                        } else {
                            $message[] = 'Error registering user!';
                        }
                    }
                } else {
                    $message[] = 'Failed to upload image.';
                }
            } else {
                $message[] = 'Image size is too large.';
            }
        } else {
            $message[] = 'Invalid image type.';
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Admin List</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <style>
        input[type=email] {
            width:100%; 
            margin:10px auto; 
            padding:10px 0px;
             text-indent:10px; 
             outline: none;
        }
    </style>
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
                            <h1>All Admin List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                                <li class="breadcrumb-item active">ticket-booking</li>
                            </ol>
                        </div>
                    </div>
                    <!-- add new trip -->
                    <div class="row add-trip">
                            <!-- Widget: user widget style 1 -->
                        <div class="col-12 col-md-4 my-5">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="text" name="name"placeholder="Enter Admin Name" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">

                                <input type="email" name="email" placeholder="Enter Admin Email" required>

                                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: 1px solid black; background-color:white; padding: 10px 0px;">

                                <input type="text" name="pass" placeholder="Enter Password" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">

                                <input type="password" name="cpass" placeholder="Enter confirm Password" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">

                                <select name="user-roll" id="" style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                                    <option value="admin">Admin</option>
                                    <option value="contributer">Contributer</option>
                                    <option value="manager">Manager</option>
                                    <option value="writer">Writer</option>
                                </select>

                                <input type="submit" name="admin_crete" value="Create Admin User" class="btn btn-warning"
                                style="margin: 10px auto; padding:10px 0px; width:50%;">
                            </form>
                        </div>
                        <?php
                        $select_bus = mysqli_query($conn, "SELECT * FROM `user` WHERE user_type = 'admin'") or die('query failed');
                        if (mysqli_num_rows($select_bus) > 0) {
                            while ($fetch_bus = mysqli_fetch_assoc($select_bus)) {
                        ?>
                        <div class="col-12 col-md-4 my-5">
                            <div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="row widget-user-header bg-info d-flex align-items-center" style="overflow:hidden">
                                    <div class="col-4 user-image" style="background-color: white;">
                                        <img class="" style="width:100%; height: 100%;" src="user_img/<?php echo $fetch_bus['image']; ?>"
                                            alt="User Avatar">
                                    </div>
                                    <div class="col-8 user-identity">
                                        <h3 class="widget-user-username"><?php echo $fetch_bus['name']; ?></h3>
                                        <h5 class="widget-user-desc"><?php echo $fetch_bus['email']; ?></h5>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">3,200</h5>
                                                <span class="description-text">SALES</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">13,000</h5>
                                                <span class="description-text">FOLLOWERS</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                            <div class="description-block">
                                                <h5 class="description-header">35</h5>
                                                <span class="description-text">PRODUCTS</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <div class="col-12">
                                    <div class="card card-primary collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title">Contribution</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                        class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <ul>
                                                <li>Trip - (0)</li>
                                                <li>Destination - (0)</li>
                                                <li>Types - (0)</li>
                                                <li>Categories - (0)</li>
                                                <li>Hotels - (0)</li>
                                                <li>Bus - (0)</li>
                                                <li>Coupen - (0)</li>
                                            </ul>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        } else {
                            echo '<p class="empty">no product added yet!</p>';
                        }
                        ?>
                            <!-- /.widget-user -->
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