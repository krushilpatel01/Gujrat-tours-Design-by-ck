<?php
include '../../../user/config.php';

session_start();

if (isset($_SESSION['admin_name']) && isset($_SESSION['admin_id'])) {
    $user_id = $_SESSION['admin_id'];
    $user_name = $_SESSION['admin_name'];
  
    // Print user name and ID
  //   echo "Welcome, $user_name!<br>";
  //   echo "Your user ID is: $user_id<br>";
  //   echo "Session status: Active";
  // } else {
  //   echo "Session not active or user not logged in.";
  }
  else{
    header('location:../../login.php');
  }

if (isset($_POST['add_trip'])) {
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'upload_img/' . $image;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    // $bus_name = mysqli_real_escape_string($conn, $_POST['bus_name']);
    $bus_number = mysqli_real_escape_string($conn, $_POST['bus_number']);
    $driver_number = mysqli_real_escape_string($conn, $_POST['driver_number']);

    // destination value get
    $selected_value = $_POST['destination'];
    $selected_values = explode(',', $selected_value);

    if (count($selected_values) == 2) {
        $destination_id = $conn->real_escape_string($selected_values[0]);
        $destination = $conn->real_escape_string($selected_values[1]);
    }

    if (count($selected_values) == 2) {
        $types_id = $conn->real_escape_string($selected_values[0]);
        $types = $conn->real_escape_string($selected_values[1]);
    }

    // categories option value get
    if (!empty($_POST['categories'])) {
        // Retrieve the category names based on the selected IDs
        $id_placeholders = implode(",", array_fill(0, count($_POST['categories']), "?"));
        $stmt = $conn->prepare("SELECT name FROM categories WHERE id IN ($id_placeholders)");
        $stmt->bind_param(str_repeat("i", count($_POST['categories'])), ...$_POST['categories']);
        $stmt->execute();
        $result = $stmt->get_result();
        $category_names = [];
        while ($row = $result->fetch_assoc()) {
            $category_names[] = $row['name'];
        }
        $category_names_str = implode(",", $category_names);
    }

    $select_trip_name = mysqli_query($conn, "SELECT name FROM `bus` WHERE name = '$name'") or die('query failed');

    if (mysqli_num_rows($select_trip_name) > 0) {
        $message[] = 'Trip name already added';
    } else {
        $add_trip_query = mysqli_query($conn, "INSERT INTO `bus` (name, bus_number, driver_number, image, destination, auther) VALUES('$name', '$bus_number', '$driver_number', '$image', '$destination', '$user_name')") or die('query failed');

        if ($add_trip_query) {
            if ($image_size > 2000000) {
                $message[] = 'Image size is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Trip added successfully';
            }
        } else {
            $message[] = 'Trip could not be added!';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_trip'])) {
        if (isset($_POST['trip_id']) && !empty($_POST['trip_id'])) {
            $trip_id = intval($_POST['trip_id']); // Ensure trip_id is an integer
            
            // Delete query
            $delete_query = "DELETE FROM bus WHERE id = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param('i', $trip_id);

            if ($stmt->execute()) {
                echo "<script>alert('Bus successfully deleted!'); window.location.href='trip-bus.php';</script>";
            } else {
                echo "Error deleting trip: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Can't fetch ID";
        }
    }

    if (isset($_POST['update_trip'])) {
        if (isset($_POST['trip_id']) && !empty($_POST['trip_id'])) {
            $trip_id = intval($_POST['trip_id']); // Ensure trip_id is an integer
            
            // Redirect to update page
            header("Location: trip-update/update-bus.php?trip_id=" . urlencode($trip_id));
            exit();
        } else {
            echo "Can't fetch ID";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Bus - Update</title>

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
                            <h1>Add Bus</h1>
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
                        <div class="col-4 mb-5">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" required
                                    style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: 1px solid black; background-color:white; padding: 10px 0px;">

                                <label for="category" style="margin-bottom:0px;">Bus Name:</label>
                                <input type="text" name="name" id="" placeholder="Enter Bus Name" required
                                    style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">

                                <label for="category" style="margin-bottom:0px;">Bus Number</label>
                                <input type="number" name="bus_number" id="" placeholder="Enter Bus Number" required
                                    style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none; ">
                                    
                                <label for="category" style="margin-bottom:0px;">Bus Driver Number:</label>
                                <input type="number" name="driver_number" id="" placeholder="Enter Bus Driver Contact" required
                                    style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;"> 
                                    
                                <!-- choose distination -->
                                <label for="category" style="margin-bottom:0px;">Destination:</label>
                                <select id="destination" name="destination" required
                                    style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                                    <?php
                                    $destination_query = "SELECT id, name FROM destination";
                                    $destination_result = $conn->query($destination_query);
                                    if ($destination_result->num_rows > 0) {
                                        while ($row = $destination_result->fetch_assoc()) {
                                            echo "<option value='" . $row["id"] . "," . $row["name"] . "'>" . $row["name"] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No Destination Available</option>";
                                    }
                                    ?>
                                </select>
                                <input type="submit" name="add_trip" value="Add Trip Package" class="btn btn-warning"
                                    style="margin: 10px auto; padding:10px 0px; width:50%;">
                            </form>
                        </div>
                    </div>
                    <!-- show trip code -->
                    <div class="row d-flex flex-wrap">
                        <?php
                        $select_bus = mysqli_query($conn, "SELECT * FROM `bus`") or die('query failed');
                        if (mysqli_num_rows($select_bus) > 0) {
                            while ($fetch_bus = mysqli_fetch_assoc($select_bus)) {
                                ?>
                                <div class="col-3 px-2 d-block" style="height:100%; margin:20px 0px">
                                    <img src="upload_img/<?php echo $fetch_bus['image']; ?>" alt="" srcset=""
                                        style="width:100%; height:100%;">
                                    <h2 class="name :">Bus Name : <?php echo $fetch_bus['name']; ?></h2>
                                    <h5 class="price">Bus Number : <?php echo $fetch_bus['bus_number']; ?></h5>
                                    <h5 class="price">Driver Number : <?php echo $fetch_bus['driver_number']; ?></h5>
                                    <h5 class="price">Destination : <?php echo $fetch_bus['destination']; ?></h5>
                                    <form method="post" action="">
                                        <input type="hidden" name="trip_id" value="<?php echo $fetch_bus['id']; ?>">
                                            <input type="submit" name="update_trip" class="btn btn-warning" value="Update">
                                            <input type="submit" name="delete_trip" class="btn btn-warning" value="Delete">
                                    </form>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p class="empty">no product added yet!</p>';
                        }
                        ?>
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