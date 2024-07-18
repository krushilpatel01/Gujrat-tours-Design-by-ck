<?php
include 'user/config.php';

// Query to retrieve data from the trip table
$sql = "SELECT * FROM types";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Types Page</title>
    <!-- include css all files -->
    <?php
    include "components/files/css.php";
    ?>
</head>

<body>
        <!-- nav start -->
        <?php include ("components\header-footer\header.php"); ?>
        <!-- nav over -->
    <section class="trip-package">
        <div class="container">
            <div class="row justinfy-content-between">
                <!-- <div class="col-12 d-flex"> -->
                    <?php
                        if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='col-12 col-lg-3 trip-card'">
                            // Check if the image file exists before displaying it
                            $imagePath = 'AdminLTE-3.2.0/pages/trips-setting/upload_img/' . $row["image"];
                            if (file_exists($imagePath)) {
                                echo "<img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row["name"]) . "'>";
                            } else {
                                echo "<p>Image not available</p>";
                            }

                            echo "<h2>Trip Name : ". htmlspecialchars($row["name"]) . "</h2>
                                    <p>" . htmlspecialchars($row["detail"]) . "</p>";
                            echo "</div>";
                        }
                        } else {
                            echo "<p>No trips found</p>";
                        }
                     ?>
                <!-- </div> -->
            </div>
        </div>
    </div>

    <?php
    // Close the connection
    $conn->close();
    ?>
            </div>
            <!-- <button type="submit" class="btn btn-success">Show All Trip</button> -->
        </div>
    </section>

    <section class="trip"></section>
</body>
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
</html>