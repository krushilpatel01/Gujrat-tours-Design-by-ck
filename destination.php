<?php
include 'user/config.php';

session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destination page</title>
    <!-- include css all files -->
    <?php
    include "components/files/css.php";
    ?>
</head>

<body>
        <!-- nav start -->
        <?php include ("components\header-footer\header.php"); ?>
        <!-- nav over -->

        <section class="destination-list">
    <div class="container">
        <div class="title" style="text-align:center; margin:50px auto;">
            <h2>Our latest Tours Destination</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore, nostrum illum. Voluptas.</p>
        </div>
        <div class="row justify-content-between d-flex flex-wrap">
            <?php
            // Query to retrieve data from the destination table
            $sql = "SELECT * FROM destination";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($destination = $result->fetch_assoc()) {
                    $destinationName = $destination['name'];
                    $destinationImage = 'AdminLTE-3.2.0/pages/trips-setting/upload_img/' . $destination['image'];

                    // Query to count the number of trips for this destination
                    $sql1 = "SELECT COUNT(*) as trip_count FROM trip WHERE destination = '" . $conn->real_escape_string($destinationName) . "'";
                    $result1 = $conn->query($sql1);
                    $tripCountRow = $result1->fetch_assoc();
                    $tripCount = isset($tripCountRow['trip_count']) ? $tripCountRow['trip_count'] : 0;

                    // Output data of each destination
                    echo "<div class='col-12 col-lg-4 Destination-card'>";

                    // Check if the image file exists before displaying it
                    if (file_exists($destinationImage)) {
                        echo "<img src='" . htmlspecialchars($destinationImage) . "' alt='" . htmlspecialchars($destinationName) . "'>";
                    } else {
                        echo "<p>Image not available</p>";
                    }

                    echo "<div class='col-12 destination-card px-0'>
                            <h2 class='destination-h2'>Destination: " . htmlspecialchars($destinationName) . " - (" . $tripCount . " trips)</h2>
                          </div>
                        </div>";
                }
            } else {
                echo "<p>No destinations found</p>";
            }
            ?>
        </div>
    </div>
</section>


</body>
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
</html>