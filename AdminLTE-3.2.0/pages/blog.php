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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['blog_submit'])) {
    // Sanitize and store form inputs
    $blog_title = $conn->real_escape_string($_POST['blog_title']);
    $blog_description = $conn->real_escape_string($_POST['blog_description']);
    $blog_action = $conn->real_escape_string($_POST['blog_action']);

    // Handle file upload for blog image
    $target_dir = "blog-img/";
    $target_file = $target_dir . basename($_FILES["blog_img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["blog_img"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["blog_img"]["size"] > 500000) { // 500KB limit
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["blog_img"]["tmp_name"], $target_file)) {
            // Insert the data into the blog table
            $insert_sql = "INSERT INTO blog (blog_title, blog_desc, blog_action, blog_img) 
                           VALUES ('$blog_title', '$blog_description', '$blog_action', '$target_file')";

            if ($conn->query($insert_sql) === TRUE) {
                echo "<script>alert('Blog successfully created!'); window.location.href='blog.php';</script>";
            } else {
                echo "<p>Error: " . $insert_sql . "<br>" . $conn->error . "</p>";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Blog</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../plugins/fullcalendar/main.css">
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
          <a href="../index3.html" class="nav-link">Home</a>
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
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
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
                <img src="../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
                <img src="../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
                <img src="../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
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
                <h1>Blog</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item active">Blog</li>
                </ol>
            </div>
        </div>
        
        <!-- Add Blog Form -->
        <div class="row add-blog">
            <div class="col-4 mb-5">
                <form action="admin_blog.php" method="post" enctype="multipart/form-data">
                    <h2>Create a New Blog Post</h2>

                    <label for="blog_title">Blog Title:</label>
                    <input type="text" name="blog_title" id="blog_title" placeholder="Enter Blog Title" required
                        style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">

                    <label for="blog_description">Blog Description:</label>
                    <textarea name="blog_description" id="blog_description" placeholder="Enter Blog Description" required
                        style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;"></textarea>

                    <label for="blog_action">Blog Action:</label>
                    <select name="blog_action" id="blog_action" required
                        style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                        <option value="feature">Feature</option>
                        <option value="main">Main</option>
                        <option value="demo">Demo</option>
                    </select>

                    <label for="blog_img">Blog Image:</label>
                    <input type="file" name="blog_img" id="blog_img" required
                        style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline:1px;">

                    <input type="submit" name="blog_submit" class="btn btn-warning my-2" value="Create Blog">
                </form>
            </div>
        </div>

        <!-- Display Blogs -->
        <div class="row show-blog">
            <?php
            // Fetch blog posts from the database
            $query = "SELECT * FROM blog ORDER BY id DESC";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($fetch_blog = $result->fetch_assoc()) {
                    $imageSrc = 'uploads/blog_images/' . htmlspecialchars($fetch_blog['blog_img']);
                    
                    echo '<div class="col-12 col-lg-3 px-2 d-block" style="width:100%; margin:20px 0px">';
                    echo '<img src="' . $imageSrc . '" alt="Blog Image" style="width:100%; height:auto;">';
                    echo '<p class="detail">Blog ID: ' . htmlspecialchars($fetch_blog['id']) . '</p>';
                    echo '<h4 class="name">Blog Title: ' . htmlspecialchars($fetch_blog['blog_title']) . '</h4>';
                    echo '<p class="detail">Description: ' . htmlspecialchars($fetch_blog['blog_desc']) . '</p>';
                    echo '<p class="detail">Action: ' . htmlspecialchars($fetch_blog['blog_action']) . '</p>';
                    echo '<form method="post" action="admin_blog.php">';
                    echo '<input type="hidden" name="blog_id" value="' . htmlspecialchars($fetch_blog['id']) . '">';
                    echo '<input type="submit" name="delete_blog" class="btn btn-warning" value="Delete">';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "<p>No blogs found.</p>";
            }
            ?>
        </div>
    </div><!-- /.container-fluid -->
</section>

    <!-- /.content-wrapper -->
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
  <!-- Bootstrap -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery UI -->
  <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- fullCalendar 2.2.5 -->
  <script src="../plugins/moment/moment.min.js"></script>
  <script src="../plugins/fullcalendar/main.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
</body>

</html>