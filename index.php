<?php
include 'user/config.php';


session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <!-- include css all files -->
    <?php
    include "components/files/css.php";
    ?>
</head>

<body>
<!-- <div id="preloader">
	<div id="status">&nbsp;</div>
</div> -->
    <div class="main">
        <!-- nav start -->
        <?php include ("components/header-footer/header.php"); ?>
        <!-- nav over -->
         
        <!-- slider start -->
         <!-- <div class="container"> -->
        <div class="swiper mySwiper hero-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="height: 550px;">
                    <img src="components/slider/banners (4).jpg" alt="" srcset="">
                </div>
                <div class="swiper-slide" style="height: 500px;">
                    <img src="components/slider/banners (6).jpg" alt="" srcset="">
                </div>
                <div class="swiper-slide" style="height: 500px;">
                    <img src="components/slider/banners (5).jpg" alt="" srcset="">
                </div>  
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <!-- slider over -->
        <!-- </div> -->


        <section class="destiantion-list">
            <div class="container">
                <div class="title" style="text-align:center; margin:50px auto;">
                    <h2>We Are Provide Destination</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore, nostrum illum. Voluptas.</p>
                </div>
                  <!-- Swiper -->
                    <div class="swiper mySwiper3">
                        <div class="swiper-wrapper destination-card-circle">
                                <?php
                                // Query to retrieve data from the trip table
                                $sql = "SELECT * FROM destination";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<div class='swiper-slide col-12 col-lg-4 Destination-card'>";
                                        // Check if the image file exists before displaying it
                                        $imagePath = 'AdminLTE-3.2.0/pages/trips-setting/upload_img/' . $row['image'];
                                        if (file_exists($imagePath)) {
                                            echo "<img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                                        } else {
                                            echo "<p>Image not available</p>";
                                        }
                                    
                                        echo "<div class='col-12 destination-card px-0'>
                                                <h2 class='text-center'>" . htmlspecialchars($row['name']) . "</h2>
                                              </div>
                                            </div>";
                                    }
                                }
                                ?>
                        </div>
                    <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="featured-trip">
            <div class="container">
            <div class="title" style="text-align:center; margin:50px auto;">
                    <h2>Our Featured Tours</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore, nostrum illum. Voluptas.</p>
                </div>
                <div class="row" style="width:100%">
                    <?php
                    $sql = "SELECT * FROM trip WHERE featured = 'featured'";
                    $result = $conn->query($sql);

                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
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
                            echo "<div class='col-8 py-5'>";
                                echo "<div class='name'><h5>". htmlspecialchars($row["name"]) . "</h5></div>";
                                echo "<div class='row trip-detail align-items-center py-1'>";
                                    echo "<div class='col-8'>";
                                        echo "<div class='categories py-1'><i class='fa-solid fa-suitcase-rolling px-2'></i>" . htmlspecialchars($row["types"]) . "</div>";
                                        echo "<div class='destination py-1' style='color:red;'><i class='fa-solid fa-plane px-2' style='color:black;'></i>" . htmlspecialchars($row["destination"]) . " - Destination</div>";
                                    echo "</div>";
                                    echo "<div class='col-4'>";
                                        echo "<div class='trip-price' style='font-size:35px'>Only " . htmlspecialchars($row["price"]) . "/-</div>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<div class='row desc-btn'>";
                                    echo "<div class='col-8 trip-desc'><b>Details : </b>" . htmlspecialchars($row["detail"]) . "</div>";
                                    echo "<div class='col-4 trip-desc'>";

                                    echo "<form action='' method='post'>";
                                    echo "<input type='submit' value='Check Trip' class='btn btn-warning' style='width:100%';>";
                                    echo "</form>";
                                    echo "</div>";
                                echo "</div>";    
                            echo "</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </section>


        <section class="Trip-list">
            <div class="container">
                <div class="title" style="text-align:center; margin:50px auto;">
                    <h2>Our latest Tours</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore, nostrum illum. Voluptas.</p>
                </div>
                <div class="row justify-content-between index-trip">
                    <?php
                    // Query to retrieve data from the trip table
                        $sql = "SELECT * FROM trip";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='col-12 col-lg-4 trip-card mx-0 px-2'>
                                    <h5>Trip Name : ". htmlspecialchars($row["name"]) . "</h5>
                                    <p>Price: $" . htmlspecialchars($row["price"]) . "</p>
                                    <p>" . htmlspecialchars($row["detail"]) . "</p>";

                            // Check if the image file exists before displaying it
                            $imagePath = 'AdminLTE-3.2.0/pages/trips-setting/upload_img/' . $row["image"];
                            if (file_exists($imagePath)) {
                                echo "<img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row["name"]) . "'>";
                            } else {
                                echo "<p>Image not available</p>";
                            }

                            echo "<p>Destination: " . htmlspecialchars($row["destination"]) . "</p>
                                <p>Types: " . htmlspecialchars($row["types"]) . "</p>
                                <p>Author: " . htmlspecialchars($row["auther"]) . "</p>
                                <button class='btn btn-warning'>View More</button>
                                </div>";
                        }
                        } else {
                            echo "<p>No trips found</p>";
                        }
                     ?>
                </div>
            </div>
        </section>


        <!-- main class -->
    </div>

</body>
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
</html>