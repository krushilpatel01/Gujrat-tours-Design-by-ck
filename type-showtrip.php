<?php
include 'user/config.php';

session_start();

if (isset($_GET['typeId'])) {
    $trip_id = $_GET['typeId'];
    
    // Fetch the current details of the trip
    $query = "SELECT * FROM types WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $trip_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $trip = $result->fetch_assoc();

} else {
    echo "No trip ID provided.";
    exit();
}

// Query to retrieve data from the trip table
$sql = "SELECT * FROM types WHERE id = '$trip_id'";
$result2 = $conn->query($sql);
$row2 = $result2->fetch_assoc();

// Initialize query to retrieve data from the trip table
$sql = "SELECT trip.* FROM trip
        JOIN destination ON trip.destination = destination.name
        WHERE 1=1"; // `WHERE 1=1` makes it easier to append conditions

// Apply filters if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "SELECT trip.* FROM trip
            JOIN destination ON trip.destination = destination.name
            WHERE 1=1";

    // Price filter
    if (!empty($_POST['price_range'])) {
        $price_range = (int)$_POST['price_range'];
        $sql .= " AND trip.price <= $price_range";
    }

    // Destination filter
    if (!empty($_POST['destination'])) {
        $destination_name = $conn->real_escape_string($_POST['destination']);
        $sql .= " AND destination.name = '$destination_name'";
    }

    // Categories filter
    if (!empty($_POST['types'])) {
    
        // Sanitize and escape category names
        $categories = array_map([$conn, 'real_escape_string'], $_POST['types']);
        
        $conditions = [];
    
        // Build conditions based on sanitized categories
        foreach ($categories as $category_name) {
            $conditions[] = "FIND_IN_SET('$category_name', trip.types)";
        }
    
        // Append conditions to the SQL query
        $sql .= " AND (" . implode(' OR ', $conditions) . ")";
    }


    // Execute the query
    $result = $conn->query($sql);

    if (!$result) {
        die("Error executing query: " . $conn->error);
    }
}

// this code show specific trip in new page
if (isset($_POST['show_trip'])) {
    $trip_id = (int)$_POST['trip_id'];
    header("Location: trip-show.php?trip_id=$trip_id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Types - <?php echo htmlspecialchars($row2['name']); ?></title>
    <!-- include css all files -->
    <?php
    include "components/files/css.php";
    ?>
</head>

<body>
    <!-- nav start -->
    <?php include ("components\header-footer\header.php"); ?>
    <!-- nav over -->

    <div class="container">
        <div class="row">
            <div class="col-12 destination-title mt-5 my-3">
                <h1 style="color:black; font-size:70px;"><?php echo htmlspecialchars($row2['name']); ?></h1>
                <p style="opacity: 0.8;"><?php echo htmlspecialchars($row2['detail']); ?></p>
            </div>
        </div>
        <div class="row justify-content-between">
            <!-- Sidebar for Filters -->
            <aside class="col-12 col-lg-3">
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
                    
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <button type="reset" class="btn btn-secondary" onclick="clearFilters()">Clear Filters</button>
                </form>
            </aside>
            <section class="col-12 col-lg-9 spe-destination">
            <div class="row" style="width:100%">
            <?php
// Assuming connection to the database is already established in $conn

// Prepare and execute the SQL query using FIND_IN_SET for multiple types
$sql = "SELECT * FROM trip WHERE FIND_IN_SET('" . $conn->real_escape_string($row2["name"]) . "', types)";

$result = $conn->query($sql);

// Check for query execution errors
if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Check if there are any results
if ($result->num_rows > 0) {
    // Loop through each result and display it
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-12 col-lg-4 trip2-card mx-0 px-2">';
        echo '<div class="image">';

        $imagePath = "AdminLTE-3.2.0/pages/trips-setting/upload_img/" . $row["image"];
        if (file_exists($imagePath)) {  
            echo "<img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row["name"]) . "'>";
        } else {
            echo "<p>Image not available</p>";
        }

        echo '</div>';
        echo '</div>';

        echo "<div class='col-12 col-lg-8 py-5'>";
        echo "<div class='name'><h5>" . htmlspecialchars($row["name"]) . "</h5></div>";
        echo "<div class='row trip-detail align-items-center py-1'>";
        echo "<div class='col-8'>";
        echo "<div class='categories py-1'><i class='fa-solid fa-suitcase-rolling px-2'></i>" . htmlspecialchars($row["types"]) . "</div>";
        echo "<div class='destination py-1' style='color:red;'><i class='fa-solid fa-plane px-2' style='color:black;'></i>" . htmlspecialchars($row["destination"]) . " - Destination</div>";
        echo "</div>";
        echo "<div class='col-4'>";
        echo "<div class='trip-price' style='font-size:30px; text-align:center;'>" . htmlspecialchars($row["price"]) . "/-</div>";
        echo "</div>";
        echo "</div>";

        echo "<div class='row desc-btn'>";
        echo "<div class='col-8 trip-desc' style='height:80px; overflow:hidden;'><b>Details : </b>" . htmlspecialchars($row["detail"]) . "</div>";
        echo "<div class='col-4 trip-desc'>";
        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='trip_id' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<input type='submit' name='show_trip' value='Check Trip' class='btn btn-warning' style='width:100%';>";
        echo "</form>";
        echo "</div>";
        echo "</div>";    
        echo "</div>";
    }
} else {
    echo "<p>No trips found for this type.</p>";
}
?>

</div>
            </section>
        </div>
    </div>

                <!-- footer start -->
                <?php include ("components/header-footer/user-footer.php"); ?>
        <!-- footer over -->

</body>
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
</html>