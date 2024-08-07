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
    $query = "SELECT * FROM trip WHERE id = ?";
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

// Handle form submission for updating trip
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $trip_name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $trip_days = $_POST['trip_day'];
    $trip_nights = $_POST['trip_night'];
    $destination_id = $conn->real_escape_string($_POST['destination']);
    $destination_query = "SELECT name FROM destination WHERE id = '$destination_id'";
    $destination_result = $conn->query($destination_query);
    $destination_name = ($destination_result->num_rows > 0) ? $destination_result->fetch_assoc()['name'] : '';

    $categories = !empty($_POST['categories']) ? $_POST['categories'] : [];
    $types = !empty($_POST['types']) ? $_POST['types'] : [];
    $featured = isset($_POST['featured']) ? $_POST['featured'] : ''; 

    // Categories
    if (!empty($categories)) {
        $id_placeholders = implode(",", array_fill(0, count($categories), "?"));
        $stmt = $conn->prepare("SELECT name FROM categories WHERE id IN ($id_placeholders)");
        $stmt->bind_param(str_repeat("i", count($categories)), ...$categories);
        $stmt->execute();
        $result = $stmt->get_result();
        $category_names = [];
        while ($row = $result->fetch_assoc()) {
            $category_names[] = $row['name'];
        }
        $category_names_str = implode(",", $category_names);
    } else {
        $category_names_str = '';
    }

    // Types
    if (!empty($types)) {
        $id_placeholders = implode(",", array_fill(0, count($types), "?"));
        $stmt = $conn->prepare("SELECT name FROM types WHERE id IN ($id_placeholders)");
        $stmt->bind_param(str_repeat("i", count($types)), ...$types);
        $stmt->execute();
        $result = $stmt->get_result();
        $type_names = [];
        while ($row = $result->fetch_assoc()) {
            $type_names[] = $row['name'];
        }
        $types_str = implode(",", $type_names);
    } else {
        $types_str = '';
    }

    // Update the trip in the database
    $update_query = "UPDATE trip SET name = ?, price = ?, detail = ?, trip_days = ?, trip_nights = ?, destination = ?, types = ?, featured = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('sissssssi', $trip_name, $price, $detail, $trip_days, $trip_nights, $destination_name, $types_str, $featured, $trip_id);

    if ($stmt->execute()) {
        echo "<script>alert('Trip successfully Update!'); window.location.href='../add-trip.php';</script>";
                header("Location: ../add-trip.php");
    } else {
        echo "Error updating trip: " . $stmt->error;
    }
    $stmt->close();
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
                            <h1>Update Trip</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../../../index.php">Home</a></li>
                                <li class="breadcrumb-item active">ticket-booking</li>
                            </ol>
                        </div>
                    </div>
                    <!-- add new trip -->
                    <div class="row add-trip">
                        <div class="col-4 mb-5">
                            <form method="post" action="update_trip.php?trip_id=<?php echo htmlspecialchars($trip_id); ?>"
                            style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                                <label for="name">Trip Name:</label>
                                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($trip['name']); ?>" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                                <label for="price">Price:</label>
                                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($trip['price']); ?>" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">

                                <label for="detail">Detail:</label>
                                <textarea id="detail" name="detail" required style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;"><?php echo htmlspecialchars($trip['detail']); ?></textarea>
                            

                                <label for="trip_day">Trip Days:</label>
                                <input type="number" id="trip_day" name="trip_day" value="<?php echo htmlspecialchars($trip['trip_days']); ?>" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">


                                <label for="trip_night">Trip Nights:</label>
                                <input type="number" id="trip_night" name="trip_night" value="<?php echo htmlspecialchars($trip['trip_nights']); ?>" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">


                                <label for="destination">Destination:</label>
                                <select id="destination" name="destination"value="<?php echo htmlspecialchars($trip['destination']); ?>"  required 
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                                    <?php
                                    $destination_query = "SELECT id, name FROM destination";
                                    $destination_result = $conn->query($destination_query);
                                    if ($destination_result->num_rows > 0) {
                                        while ($row = $destination_result->fetch_assoc()) {
                                            echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No Destination Available</option>";
                                    }
                                    ?>
                                </select>

                                <label for="destination">Trip Types:</label>
                                <?php
                                    $types_query = "SELECT id, name FROM types";
                                    $types_result = $conn->query($types_query);
                                    if ($types_result->num_rows > 0) {
                                        while ($row = $types_result->fetch_assoc()) {
                                            echo "<div><input type='checkbox' id='types" . $row["id"] . "' name='types[]' value='" . $row["id"] . "'>
                                            <label for='types" . $row["id"] . "'>" . $row["name"] . "</label></div>";
                                        }
                                    } else {
                                        echo "<p>No Types Available</p>";
                                    }
                                ?>
                                <label for="destination" style="color:red;">Trip Featured:</label>
                                <select name="featured" id="featured" style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                                    <option value="Featured">Featured</option>
                                    <option value="Special">Special</option>
                                    <option value="Demo">Demo</option>
                                </select>
                                <input type="submit" name="" value="Update Trip" class="btn btn-warning"
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