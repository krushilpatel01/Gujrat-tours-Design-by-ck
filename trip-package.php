<?php
include 'user/config.php';
session_start();

// Initialize query to retrieve data from the trip table
$sql = "SELECT trip.* FROM trip
        JOIN destination ON trip.destination = destination.name
        WHERE 1=1"; // `WHERE 1=1` makes it easier to append conditions

// Apply filters if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Price filter
    if (!empty($_POST['price_range'])) {
        $price_range = (int)$_POST['price_range']; // Cast to int for safety
        $sql .= " AND trip.price <= $price_range";
    }

    // Destination filter
    if (!empty($_POST['destination'])) {
        $destination_name = $conn->real_escape_string($_POST['destination']);
        $sql .= " AND destination.name = '$destination_name'";
    }

    if (!empty($_POST['types'])) {
        $categories = array_map([$conn, 'real_escape_string'], $_POST['types']);
        $conditions = [];
    
        foreach ($categories as $category_name) {
            $conditions[] = "FIND_IN_SET('$category_name', trip.types)";
        }
    
        // Append conditions to the SQL query
        $sql .= " AND (" . implode(' OR ', $conditions) . ")";
    }
}

// Execute the query
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}


// this code show specific trip in new page
if (isset($_POST['show_trip'])) {
    $trip_id = (int)$_POST['trip_id'];
    header("Location: trip-show.php?trip_id=$trip_id");
    exit();
}

$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Package Page</title>
    <!-- Include CSS files -->
    <?php include "components/files/css.php"; ?>
</head>
<body>
    <!-- Navigation -->
    <?php include("components/header-footer/header.php"); ?>

    <section class="trip-package">
        <div class="container">
            <div class="title" style="text-align:center; margin:50px auto;">
                <h2>Our Latest Trips</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore, nostrum illum. Voluptas.</p>
            </div>
            <div class="row justify-content-between">
                <!-- Sidebar for Filters -->
                <aside class="col-lg-3">
                    <form method="POST" action="">
                        <h4>Filter Trips</h4>

                        <!-- Price Range Slider -->
                        <div class="form-group">
                            <label for="price_range">Price Range :
                            <?php 
                            if($price_range = "null"){
                                
                                echo "All Trip";
                            }
                            else{
                            echo $price_range;
                            }
                            ?></label>
                            <input type="number" class="form-control" name="price_range" id="price_range" placeholder="Enter max price">
                        </div>

                        <!-- Destination Dropdown -->
                        <div class="form-group">
                            <label for="destination">Destination:</label>
                            <select class="form-control" name="destination" id="destination">
                                <option value="">Select Destination</option>
                                <?php
                                $destination_query = "SELECT id, name FROM destination";
                                $destination_result = $conn->query($destination_query);
                                if ($destination_result->num_rows > 0) {
                                    while ($row = $destination_result->fetch_assoc()) {
                                        echo "<option value='" . htmlspecialchars($row["name"]) . "'>" . htmlspecialchars($row["name"]) . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No Destination Available</option>";
                                }
                                ?>
                            </select>
                        </div>
                            
                        <!-- category checkboxes -->
                        <div class="form-group">
                            <label for="trip_category">Trip Category:</label>
                            <?php
                            $types_query = "SELECT id, name FROM types";
                            $types_result = $conn->query($types_query);
                            if ($types_result->num_rows > 0) {
                                while ($row = $types_result->fetch_assoc()) {
                                    echo "<div><input type='checkbox' id='types" . htmlspecialchars($row["id"]) . "' name='types[]' value='" . htmlspecialchars($row["name"]) . "'>
                                    <label for='types" . htmlspecialchars($row["id"]) . "'>" . htmlspecialchars($row["name"]) . "</label></div>";
                                }
                            } else {
                                echo "<p>No Types Available</p>";
                            }
                            ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                        <button type="reset" class="btn btn-secondary" onclick="clearFilters()">Clear Filters</button>
                    </form>
                </aside>
                        
                <!-- Trip Listings -->
                <div class="col-lg-9">
                    <div class="row">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='col-12  col-md-6 col-lg-6 col-xl-4 trip-card'>
                                        <h5>Trip: " . htmlspecialchars($row['name']) . "</h5>
                                        <p>" . htmlspecialchars($row['detail']) . "</p>
                                        <h2>Price : " . htmlspecialchars($row['price']) . "</h2>";

                                $imagePath = 'AdminLTE-3.2.0/pages/trips-setting/upload_img/' . $row['image'];
                                if (file_exists($imagePath)) {
                                    echo "<img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                                } else {
                                    echo "<p>Image not available</p>";
                                }

                                echo "<h6 class='mt-3'>Destination: " . htmlspecialchars($row['destination']) . "</h6>
                                      <p>Types: " . htmlspecialchars($row['types']) . "</p>
                                      <p>Trip Days: " . htmlspecialchars($row['trip_days']) . " Days & " . htmlspecialchars($row['trip_nights']) . " Nights</p>";

                                echo "<form method='post' action=''>
                                        <input type='hidden' name='trip_id' value='" . htmlspecialchars($row['id']) . "'>
                                        <input type='submit' name='show_trip' class='btn btn-warning' value='Check Trip'>
                                      </form>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>No trips found</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

            <!-- footer start -->
            <?php include ("components/header-footer/user-footer.php"); ?>
        <!-- footer over -->

    <!-- Include JS files -->
    <?php include "components/files/js.php"; ?>

    <script>
function clearFilters() {
    // Reset the price range input value
    document.getElementById('price_range').value = '';

    // Reset the destination dropdown to its default option
    document.getElementById('destination').selectedIndex = 0;

    // Uncheck all the trip category checkboxes
    const checkboxes = document.querySelectorAll("input[name='types[]']");
    checkboxes.forEach((checkbox) => {
        checkbox.checked = false;
    });
}
</script>
</body>
</html>
