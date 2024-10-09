<?php
include 'user/config.php';
session_start();





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Coupen Page</title>
    <!-- include css all files -->
    <?php
    include "components/files/css.php";
    ?>
</head>

<body>
        <!-- nav start -->
        <?php include ("components\header-footer\header.php"); ?>
        <!-- nav over -->

    <!-- include css all files -->
    <div class="container">
        <!-- show trip code -->
        <div class="title" style="text-align:center; margin:50px auto;">
                    <h2>Our latest Coupens</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore, nostrum illum. Voluptas.</p>
        </div>
        <div class="row d-flex flex-wrap">
        <?php
                    // Query to retrieve data from the trip table
                    $sql = "SELECT * FROM coupen";
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
                                    <h2>Name : " . htmlspecialchars($row['name']) . "</h2>
                                    <h6>Coupen Code : " . htmlspecialchars($row['code']) . "</h6>
                                  </div>
                                </div>";
                        }
                    } else {
                        echo "<p>No Destination found</p>";
                    }
                    ?>
        </div>
    </div>


            <!-- footer start -->
            <?php include ("components/header-footer/user-footer.php"); ?>
        <!-- footer over -->

</body>

    <?php
    include "components/files/js.php";
    ?>
</html>