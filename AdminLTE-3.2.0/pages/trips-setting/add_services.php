<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../../user/config.php';

session_start();

if (!isset($_SESSION['admin_name']) || !isset($_SESSION['admin_id'])) {
    header('location:../../login.php');
    exit();
}

$user_id = $_SESSION['admin_id'];
$user_name = $_SESSION['admin_name'];

if (isset($_GET['trip_id'])) {
    $trip_id = $_GET['trip_id'];

    // Fetch the trip details if needed
    $query = "SELECT * FROM trip WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $trip_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $trip = $result->fetch_assoc();

    if ($trip) {
        $trip_name = $trip['name'];

        // Handle form submission for adding services
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_services'])) {
            $room_id = $_POST['room_id']; // Ensure this input exists in the form
            $transport_id = $_POST['transport'];

            // Fetch the room details from the room table
            $room_query = "SELECT name, location FROM room WHERE id = ?";
            $stmt = $conn->prepare($room_query);
            $stmt->bind_param("i", $room_id);
            $stmt->execute();
            $room_result = $stmt->get_result();

            if ($room_result->num_rows > 0) {
                $room = $room_result->fetch_assoc();
                $hotel_name = $room['name'];
                $room_location = $room['location'];

                // Fetch transport details from the bus table
                $transport_query = "SELECT destination, name FROM bus WHERE id = ?";
                $stmt = $conn->prepare($transport_query);
                $stmt->bind_param("i", $transport_id);
                $stmt->execute();
                $transport_result = $stmt->get_result();

                if ($transport_result->num_rows > 0) {
                    $transport = $transport_result->fetch_assoc();
                    $transport_name = $transport['name'];
                    $transport_destination = $transport['destination'];

                    $hotel_price = $_POST['hotel_price'];
                    $transport_price = $_POST['transport_price'];
                    
                    $upload_dir = 'C:/xampp/htdocs/Gujrat-tours/AdminLTE-3.2.0/pages/trips-setting/uploads/';
                    
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }

                    $total_files = count($_FILES['image']['name']);
                    for ($i = 0; $i < $total_files; $i++) {
                        $file_name = $_FILES['image']['name'][$i];
                        $file_tmp = $_FILES['image']['tmp_name'][$i];
                        $file_destination = $upload_dir . basename($file_name);

                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            // Prepare the insert statement
                            $insert_hotel = $conn->prepare("INSERT INTO add_services (trip_id, trip_name, hotel_name, hotel_price, hotel_img, transpot_type, transpot_price, auther) VALUES (?, ?, ?, ?, ?, ?, ?, ?)") or die('query failed');
                            
                            // Bind parameters: adjust the format string if needed
                            $insert_hotel->bind_param('issdssss', $trip_id, $trip_name, $hotel_name, $hotel_price, $file_destination, $transport_name, $transport_price, $user_name);

                            if ($insert_hotel->execute()) {
                                echo "<script>alert('Services added successfully!'); window.location.href='add-trip.php';</script>";
                            } else {
                                echo "<script>alert('Error executing query: " . $insert_hotel->error . "');</script>";
                            }
                        } else {
                            echo "<script>alert('Failed to upload file: $file_name');</script>";
                        }
                    }
                } else {
                    echo "<script>alert('Transport not found.');</script>";
                }
            } else {
                echo "<script>alert('Room not found.');</script>";
            }
        }
    } else {
        echo "<script>alert('Trip not found.');</script>";
    }
} else {
    echo "<script>alert('Please provide a trip ID.');</script>";
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Update Trip</title>

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
                        <h1>Add Services for Trip: <?php echo htmlspecialchars($trip['name']); ?></h1>
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
                        <form method="post" action="" enctype="multipart/form-data">
                            <h2>Hotel Facility</h2>
                            <!-- Destination -->
                            <label for="destination">Hotel Available:</label>
                            <select id="destination" name="room_id" required
                                    style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                                <?php
                                    // Fetch destinations from the trip table
                                    $trip_query = "SELECT id, destination FROM trip";
                                    $trip_result = $conn->query($trip_query);

                                    // Fetch rooms from the room table
                                    $room_query = "SELECT id, location, name FROM room";
                                    $room_result = $conn->query($room_query);

                                    if ($trip_result && $trip_result->num_rows > 0 && $room_result && $room_result->num_rows > 0) {
                                        $destinations = [];
                                    
                                        // Store destinations
                                        while ($trip_row = $trip_result->fetch_assoc()) {
                                            $destinations[] = $trip_row['destination'];
                                        }
                                    
                                        $has_matching_room = false;
                                    
                                        // Generate options for matching rooms
                                        while ($room_row = $room_result->fetch_assoc()) {
                                            if (in_array($room_row['location'], $destinations)) {
                                                echo "<option value='" . $room_row["id"] . "'>" . $room_row["name"] . " - " . $room_row["location"] . "</option>";
                                                $has_matching_room = true;
                                            }
                                        }
                                    
                                        if (!$has_matching_room) {
                                            echo "<option value=''>No Matching Destination Available</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No Destination or Room Data Available</option>";
                                    }
                                ?>
                            </select>


                            <label for="hotel_price">Hotel Price (One Days):</label>
                            <input type="text" id="hotel_price" name="hotel_price" required
                            style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">

                            <!-- File Input -->
                            <label for="hotel_price">Hotel Images:</label>
                            <input type="file" name="image[]" accept="image/jpg, image/jpeg, image/png" multiple required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: 1px solid black; background-color:white; padding: 10px 0px;">

                            <h2>Transport Services</h2>
                            <label for="transport_type">Transport Type (Bus/Plane):</label>
                            <select id="transport_id" name="transport" required
            style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
        <?php
            // Fetch destinations from the trip table
            $trip_query = "SELECT destination FROM trip";
            $trip_result = $conn->query($trip_query);

            // Fetch transportation options from the bus table
            $bus_query = "SELECT id, destination, name FROM bus";
            $bus_result = $conn->query($bus_query);

            if ($trip_result && $trip_result->num_rows > 0 && $bus_result && $bus_result->num_rows > 0) {
                $destinations = [];
                while ($trip_row = $trip_result->fetch_assoc()) {
                    $destinations[] = $trip_row['destination'];
                }

                $has_matching_transport = false;
                while ($bus_row = $bus_result->fetch_assoc()) {
                    if (in_array($bus_row['destination'], $destinations)) {
                        echo "<option value='" . $bus_row["id"] . "'>" . $bus_row["destination"] . " - " . $bus_row["name"] . "</option>";
                        $has_matching_transport = true;
                    }
                }

                if (!$has_matching_transport) {
                    echo "<option value=''>No Matching Destination Available</option>";
                }
            } else {
                echo "<option value=''>No Destination or Transport Data Available</option>";
            }
        ?>
    </select>
                            <label for="transport_price">Transport Price:</label>
                            <input type="text" id="transport_price" name="transport_price" required
                            style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">

                            <input type="submit" name="add_services" value="Add Services" class="btn btn-warning"
                            style="margin: 10px auto; padding:10px 0px; width:50%;">

                        </form>
                    </div>
                </div>
            </div>
        </section>       
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