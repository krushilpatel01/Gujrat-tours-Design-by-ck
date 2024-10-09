<?php
include 'user/config.php';
session_start();


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
                <!-- trip type show -->
                <div class="row justinfy-content-between d-flex flex-wrap">
                <?php
                    // Query to retrieve data from the types table
                    $sql = "SELECT * FROM types";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $typeId = $row['id']; // Assuming there's an 'id' column
                            $typeName = $row['name'];
                            
                            // Assuming you're fetching the type ID and name like this:
                            $typeId = $row['id']; // Assuming there's an 'id' column in types
                            $typeName = $row['name'];
                            
                            // Query to count the number of trips for this type using FIND_IN_SET
                            $sql1 = "SELECT COUNT(*) as trip_count FROM trip WHERE FIND_IN_SET('$typeName', types)";
                            $result1 = $conn->query($sql1);
                            if (!$result1) {
                                echo "Error in count query: " . $conn->error;
                            } else {
                                $tripCountRow = $result1->fetch_assoc();
                                $tripCount = isset($tripCountRow['trip_count']) ? $tripCountRow['trip_count'] : 0;
                            }
                            
                            echo "<a href='type-showtrip.php?typeId=" . urlencode($typeId) . "' class='col-12 col-lg-4 trip-types-package my-3' style='text-decoration:none;'>";
                            echo "<div class='col-12 types-card'>";
                            // Check if the image file exists before displaying it
                            $imagePath = 'AdminLTE-3.2.0/pages/trips-setting/upload_img/' . $row['image'];
                            if (file_exists($imagePath)) {
                                echo "<img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                            } else {
                                echo "<p>Image not available</p>";
                            }
                        
                            echo "<div class='col-12 destination-card px-0'>
                                    <h2>" . htmlspecialchars($typeName) . " - (" . $tripCount . " trips)</h2>
                                  </div>
                                </div>
                            </a>";
                        }
                    } else {
                        echo "<p>No types found</p>";
                    }
                    ?>
                </div>
            </div>
        </section>

    <section class="trip"></section>

            <!-- footer start -->
            <?php include ("components/header-footer/user-footer.php"); ?>
        <!-- footer over -->
</body>
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
</html>