<?php
// Include database connection file
include '../../../../user/config.php';

session_start();

if (!isset($_SESSION['admin_name']) || !isset($_SESSION['admin_id'])) {
    header('location:../../../login.php');
    exit();
}

$user_id = $_SESSION['admin_id'];
$user_name = $_SESSION['admin_name'];

if (isset($_GET['trip_id'])) {
    $trip_id = $_GET['trip_id'];

    // Fetch the current details of the trip
    $query = "SELECT * FROM room WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $trip_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $trip = $result->fetch_assoc();

    if (!$trip) {
        echo "Trip not found.";
        exit();
    }
} else {
    echo "No trip ID provided.";
    exit();
}

if (isset($_POST['save_update'])) {
    $trip_id = $_POST['trip_id'];
    $h_name = $_POST['name'];
    $h_address = $_POST['address'];
    $h_contact = $_POST['contact'];
    
        // destination value get
        $selected_value = $_POST['destination'];
        $selected_values = explode(',', $selected_value);
    
        if (count($selected_values) == 2) {
            $destination_id = $conn->real_escape_string($selected_values[0]);
            $h_destination = $conn->real_escape_string($selected_values[1]);
        }

    $trip_id = $_POST['trip_id'];

    // Check if image is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $image_folder = 'path/to/upload/folder/' . $image_name;

        move_uploaded_file($image_tmp_name, $image_folder);

        // If image is uploaded, include it in the update
        $query = "UPDATE `room` SET name = ?, addresss = ?, location = ?, person_contact = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssi', $h_name, $h_address, $h_destination, $h_contact,  $image_name, $trip_id);
    } else {
        // If no image is uploaded, exclude the image column from the update
        $query = "UPDATE `room` SET name = ?, addresss = ?, location = ?, person_contact = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssii', $h_name, $h_address, $h_destination, $h_contact, $trip_id);
    }

    if ($stmt->execute()) {
        header('Location: ../trip-room.php');
        exit();
    } else {
        echo "Failed to update the trip. Error: " . $stmt->error;
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Update Room</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
</head>

<body>
<div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../../index.php" class="nav-link">Home</a>
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
                                <img src="../../../dist/img/user1-128x128.jpg" alt="User Avatar"
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
                                <img src="../../../dist/img/user8-128x128.jpg" alt="User Avatar"
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
                                <img src="../../../dist/img/user3-128x128.jpg" alt="User Avatar"
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
            <a href="../../../index.php" class="brand-link">
                <img src="../../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin Page</span>
            </a>

            <?php
            include '../../UI/fixed-aside-2.php';
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
                            <h1>Update Room</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../../../index.php">Home</a></li>
                                <li class="breadcrumb-item active">ticket-booking</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row add-destination">
                        <div class="col-4 mb-5">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="trip_id" value="<?php echo $trip['id']; ?>">
                                <label for="category" style="margin-bottom:0px;">Hotel Name:</label>
                                <input type="text" name="name" id="" placeholder="Enter Hotel Name" value="<?php echo $trip['name']; ?>" required
                                    style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                                <label for="category" style="margin-bottom:0px;">Trip Address:</label>
                                <input type="text" name="address" id="" placeholder="Enter Hotel Address" value="<?php echo $trip['addresss']; ?>"  required
                                    style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                                <label for="category" style="margin-bottom:0px;">Person Contact:</label>
                                <input type="number" name="contact" id="" placeholder="Hotel Contact" value="<?php echo $trip['person_contact']; ?>"  required
                                    style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">                                <!-- choose distination -->
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
                                <input type="submit" name="save_update" value="Add Trip Package" class="btn btn-warning"
                                    style="margin: 10px auto; padding:10px 0px; width:50%;">
                            </form>
                        </div>
                    </div>
                </div>
            </section>       
        </div>

    <!-- footer link -->
    <?php
    include ('../../../../components/header-footer/footer.php');
    ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../../dist/js/demo.js"></script>
</body>

</html>