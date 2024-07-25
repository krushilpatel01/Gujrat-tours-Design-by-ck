<?php
include 'user/config.php';

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
    
        <section class="destination-list">
            <div class="container">
            <div class="title" style="text-align:center; margin:50px auto;">
                    <h2>We Are Provide Trips Types</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore, nostrum illum. Voluptas.</p>
                </div>
                <div class="row justinfy-content-between d-flex flex-wrap">
                <?php
                    // Query to retrieve data from the trip table
                    $sql = "SELECT * FROM types";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='col-12 col-lg-4 Destination-card'>";
                            // Check if the image file exists before displaying it
                            $imagePath = 'AdminLTE-3.2.0/pages/trips-setting/upload_img/' . $row['image'];
                            if (file_exists($imagePath)) {
                                echo "<img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                            } else {
                                echo "<p>Image not available</p>";
                            }
                        
                            echo "<div class='col-12 destination-card px-0'>
                                    <h2>" . htmlspecialchars($row['name']) . " - (0)</h2>
                                  </div>
                                </div>";
                        }
                    } else {
                        echo "<p>No Destination found</p>";
                    }
                    ?>
            </div>
        </section>

    <section class="trip"></section>
</body>
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
</html>