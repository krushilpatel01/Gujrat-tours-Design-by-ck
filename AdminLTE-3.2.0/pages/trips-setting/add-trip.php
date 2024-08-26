<?php
include '../../../user/config.php';

session_start();

if (!isset($_SESSION['admin_name']) || !isset($_SESSION['admin_id'])) {
    header('location:../../login.php');
    exit();
}

$user_id = $_SESSION['admin_id'];
$user_name = $_SESSION['admin_name'];

// add trip all code
if (isset($_POST['add_trip'])) {
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'upload_img/' . $image;
    $trip_name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $trip_days = $_POST['trip_day'];
    $trip_nights = $_POST['trip_night'];
    $featured = isset($_POST['featured']) ? $_POST['featured'] : '';  // Check if 'featured' key exists

    // Destination handling
    $destination_id = $conn->real_escape_string($_POST['destination']);
    $destination_query = "SELECT name FROM destination WHERE id = '$destination_id'";
    $destination_result = $conn->query($destination_query);
    if ($destination_result->num_rows > 0) {
        $destination_name = $destination_result->fetch_assoc()['name'];
    } else {
        $destination_name = ''; // Handle case where destination ID is not found
    }

    // Categories handling
    if (!empty($_POST['categories'])) {
        $categories = $_POST['categories'];
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
        $category_names_str = ''; // Default if no categories are selected
    }

    // Types handling
    if (!empty($_POST['types'])) {
        $types = $_POST['types'];
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
        $types_str = ''; // Default if no types are selected
    }

    // Check if trip name already exists
    $select_trip_name = mysqli_query($conn, "SELECT name FROM `trip` WHERE name = '$trip_name'") or die('query failed');

    if (mysqli_num_rows($select_trip_name) > 0) {
        $message[] = 'Trip name already added';
    } else {
        // Add trip to the database
        $add_trip_query = mysqli_query($conn, "INSERT INTO `trip`(name, price, detail, image, trip_days, trip_nights, destination, types, featured, auther) 
        VALUES('$trip_name', '$price', '$detail', '$image', '$trip_days', '$trip_nights', '$destination_name', '$types_str', '$featured', '$user_name')") or die('query failed');

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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
    if (isset($_POST['delete_trip'])) {
        // Check if trip_id is set
        if (isset($_POST['trip_id']) && !empty($_POST['trip_id'])) {
            $trip_id = $_POST['trip_id'];
            
            // Delete query
            $delete_query = "DELETE FROM trip WHERE id = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param('i', $trip_id);

            if ($stmt->execute()) {
                echo "<script>alert('Trip successfully Delete!'); window.location.href='add-trip.php';</script>";
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
        header("Location: trip-update/update_trip.php?trip_id=$trip_id");
        exit();
    }

    if (isset($_POST['add_Services'])) {
        $trip_id = $_POST['trip_id'];

        // Redirect to add services page (create an add_services.php page to handle adding services)
        header("Location: add_services.php?trip_id=$trip_id");
        exit();
    }

    if(isset($_POST['add_Itinerary'])){
        $trip_id = $_POST['trip_id'];
        
        header("Location: trip-update/trip_secudle.php?trip_id=$trip_id");
        exit();
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Add-Trip</title>

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
                            <h1>Add Trip</h1>
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
                            <!-- File Input -->
                            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: 1px solid black; background-color:white; padding: 10px 0px;">
                            <!-- Trip Name -->
                            <label for="name">Trip Name:</label>
                            <input type="text" name="name" id="name" placeholder="Enter Trip Name" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                            <!-- Trip Price -->
                            <label for="price">Trip Price:</label>
                            <input type="text" name="price" id="price" placeholder="Enter Trip Price" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                            <!-- Trip Detail -->
                            <label for="detail">Trip Detail:</label>
                            <input type="text" name="detail" id="detail" placeholder="Enter Trip Detail" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                            <!-- Days and Nights -->
                            <label for="daysNights">Select Days and Nights:</label>
                            <input type="number" name="trip_day" id="trip_day" placeholder="Enter Days" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                            <input type="number" name="trip_night" id="trip_night" placeholder="Enter Nights" required
                                style="width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;">
                            <!-- Destination -->
                            <label for="destination">Destination:</label>
                            <select id="destination" name="destination" required
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
                            <!-- Room -->
                            <label for="destination" style="color:red;">Trip Categories:</label>
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
                            <!-- Submit Button -->
                            <input type="submit" name="add_trip" value="Add Trip Package" class="btn btn-warning"
                                style="margin: 10px auto; padding:10px 0px; width:50%;">
                        </form>
                    </div>
                </div>
                <!-- show trip code -->
                <div class="row d-flex flex-wrap">
                    <?php
                    $select_trip = mysqli_query($conn, "SELECT * FROM `trip`") or die('query failed');
                    if (mysqli_num_rows($select_trip) > 0) {
                        while ($fetch_trip = mysqli_fetch_assoc($select_trip)) {
                            ?>
                            <div class="col-3 px-2 d-block" style="height:100%; margin:20px 0px">
                                <img src="upload_img/<?php echo $fetch_trip['image']; ?>" alt="" srcset=""
                                    style="width:100%; height:100%;">
                                <p class="detail">Trip ids : <?php echo $fetch_trip['id']; ?></p>
                                <h4 class="name"><?php echo $fetch_trip['name']; ?></h3>
                                <h5 class="price">Price : <?php echo $fetch_trip['price']; ?></h5>
                                <p class="detail">Trip Details : <?php echo $fetch_trip['detail']; ?></p>
                                <p class="detail">Trip Destination : <?php echo $fetch_trip['destination']; ?></p>
                                <p class="detail">Trip Categories : <?php echo $fetch_trip['types']; ?></p>
                                <p class="detail">Trip Days : <?php echo $fetch_trip['trip_days']; ?>  &  <?php echo $fetch_trip['trip_nights']; ?> Nights</p>
                                <p class="detail">Trip Featured : <?php echo $fetch_trip['featured']; ?></p>
                                <form method="post" action="">
                                    <input type="hidden" name="trip_id" value="<?php echo $fetch_trip['id']; ?>">
                                    <input type="submit" name="delete_trip" class="btn btn-warning" value="Delete">
                                    <input type="submit" name="update_trip" class="btn btn-warning" value="Update">
                                    <input type="submit" name="add_Services" class="btn btn-warning" value="Add Services">
                                    <input type="submit" name="add_Itinerary" class="btn btn-warning mt-1" value="Add Days schedule">
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