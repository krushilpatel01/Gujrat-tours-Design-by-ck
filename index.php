<?php
include 'user/config.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['show_trip'])) {
        $trip_id = $_POST['trip_id'];

        // Redirect to update page (create an update_trip.php page to handle updates)
        header("Location: trip-show.php?trip_id=$trip_id");
        exit();
    }
}

session_start();    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- include css all files -->
    <?php
    include "components/files/css.php";
    ?>
    <style>
        /* slider */
        .hero-slider {
            position: relative;
            height: 800px;
            z-index: 0;
            background-image: url(https://images.unsplash.com/photo-1461237439866-5a557710c921?q=80&w=2073&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0px;
        }
        .hero-slider nav{
            position: absolute;
        }

        .hero-slider .black-box{
            width: 100%;
            height: 100%;
            padding: 450px 400px 00px 200px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            z-index: 99;
        }
        @media only screen and (min-width:1030px) {
            .hero-slider .black-box{
                padding: 450px 400px 00px 200px;
            }
        }

        @media only screen and (min-width:768px) and (max-width:1029px){
            .hero-slider .black-box{
                padding: 450px 50px 0px 50px;
            }   
        }
        @media only screen and (max-width:767px){
            .hero-slider{
                height: 600px;
            }
            .hero-slider .black-box{
                padding: 250px 50px 0px 50px;
            }   

            .navbar-dark .navbar-nav .nav-link{
                color: black;
                background-color: white;
                margin: 2px auto;
            }
            .search-box{
                display: none;
            }
            .navbar-icon .navbar-icon{
                color: black;
                background-color: white;
                margin: 2px auto;
            }
        }
        .u-name{
            color: red;
            text-decoration: none;
        }
        a:hover{
            text-decoration: none;
            color: darkslateblue;
        }
    </style>
</head>

<body>
<!-- <div id="preloader">
	<div id="status">&nbsp;</div>
</div> -->
    <div class="main">
        <!-- nav start -->
        <!-- nav over -->
         
        <!-- slider start -->
         <!-- <div class="container"> -->
        <div class="hero-slider">
        <nav class="navbar navbar-expand-lg navbar-dark py-1" style="height: 100px;">
            <div class="container">
                <a class="navbar-brand text-white" href="index.php">Guj<span style="color:red;">rat</span> Tours</a>
                <button class="navbar-toggler" style="border:1px solid white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="destination.php">Destinations</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="trip-package.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Trips
                              </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item text-black" href="trip-package.php">Trip package</a>
                              <a class="dropdown-item text-black" href="trip-types.php">Trip Types</a>
                              <a class="dropdown-item text-black" href="trip-coupen.php">Trip Coupen</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about-us.php">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact-us.php">Contact us</a>
                        </li>
                    </ul>
                    <form class="search-box d-flex col-sm-d-none">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success bg-light" type="submit">Search</button>
                    </form>
                    <ul class="navbar-icon mb-2 mb-lg-0 text-center d-flex" style="list-style-type:none;">
                        <li class="nav-icon dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user" style="color:white;"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index: 999;">
                                <?php
                                if (isset($_SESSION['user_name'])) {
                                    echo "<a href='user.php'><li class='dropdown-item'>Welcome " . $_SESSION['user_name'] . "</li></a>";
                                } else {
                                    echo "<li><a class='dropdown-item' href='#'>Welcome User</a></li>";
                                }
                                
                                if (isset($_SESSION['user_name'])) {
                                    echo "<li><a class='dropdown-item' href='user/log-out.php'>Logout</a></li>";
                                } else {
                                    echo "<li><a class='btn dropdown-item' href='user/register.php'>Register User</a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="black-box">
            <h6 style="color:white;" data-aos="fade-up" data-aos-duration="500">Who We Are'</h6>
            <h1 style="color:white;" data-aos="fade-up" data-aos-duration="800">Gujrat Tours</h1>
            <p data-aos="fade-up" data-aos-duration="1000">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque sint numquam voluptate aperiam tempora? Sit, voluptates rerum ratione expedita, nisi tenetur itaque quam excepturi deleniti, obcaecati rem adipisci alias quo.</p>
            <input  data-aos="fade-up" data-aos-duration="1000" type="submit" value="Know More About Us" class="btn btn-warning">
        </div>
        </div>
        <!-- her slider over -->

        <!-- destinations list slider's -->
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
        </section>
        <!-- destinations list slider's over -->


        <!-- SHOW ALL THE FEATURED TRIP AVAILABLE IN THE DATABSE -->
        <section class="featured-trip">
            <div class="container">
            <div class="title" style="text-align:center; margin:50px auto;">
                    <h2>Our Featured Tours</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore, nostrum illum. Voluptas.</p>
            </div>
            <div class="row mx-auto" style="width:100%">
                <?php
                $sql = "SELECT * FROM trip WHERE featured = 'featured'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        // this is for image 
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
                        // this trip details
                        echo "<div class='col-12 col-lg-8 py-5'>";
                            echo "<div class='name'><h5>". htmlspecialchars($row["name"]) . "</h5></div>";
                            echo "<div class='row trip-detail align-items-center py-1'>";
                                echo "<div class='col-12 col-lg-8'>";
                                    echo "<div class='categories py-1'><i class='fa-solid fa-suitcase-rolling px-2'></i>" . htmlspecialchars($row["types"]) . "</div>";
                                    echo "<div class='destination py-1' style='color:red;'><i class='fa-solid fa-plane px-2' style='color:black;'></i>" . htmlspecialchars($row["destination"]) . " - Destination</div>";
                                echo "</div>";
                                echo "<div class='col-12 col-lg-4'>";
                                    echo "<div class='trip-price' style='font-size:35px'>Only " . htmlspecialchars($row["price"]) . "/-</div>";
                                echo "</div>";
                            echo "</div>";
                            echo "<div class='row desc-btn'>";
                                echo "<div class='col-12 col-lg-8 trip-desc'><b>Details : </b>" . htmlspecialchars($row["detail"]) . "</div>";
                                echo "<div class='col-12 col-lg-4 trip-desc'>";
                                echo "<form action='' method='post'>";
                                echo "<input type='hidden' name='trip_id' value='" . htmlspecialchars($row['id']) . "'>";
                                echo "<input type='submit' name='show_trip' value='Check Trip' class='btn btn-warning' style='width:100%';>";
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
        <!-- featured trip over -->

        <!-- show all the trip -->
        <section class="Trip-list">
            <div class="container">
                <div class="title" style="text-align:center; margin:50px auto;">
                    <h2>Our latest Tours</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore, nostrum illum. Voluptas.</p>
                </div>
                <div class="swiper mySwiper4">
                    <div class="swiper-wrapper">
                        <?php
                        // Query to retrieve data from the trip table
                        $sql = "SELECT * FROM trip";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='trip-card swiper-slide'>";
                                echo "<h5>Trip Name : ". htmlspecialchars($row["name"]) . "</h5>";
                                echo "<p>Price: ₹" . htmlspecialchars($row["price"]) . "</p>";
                                echo "<p>" . htmlspecialchars($row["detail"]) . "</p>";
                            
                                // Check if the image file exists before displaying it
                                $imagePath = 'AdminLTE-3.2.0/pages/trips-setting/upload_img/' . $row["image"];
                                if (file_exists($imagePath)) {
                                    echo "<img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row["name"]) . "'>";
                                } else {
                                    echo "<p>Image not available</p>";
                                }
                            
                                echo "<p>Destination: " . htmlspecialchars($row["destination"]) . "</p>";
                                echo "<p>Types: " . htmlspecialchars($row["types"]) . "</p>";
                                echo "<p>Author: " . htmlspecialchars($row["auther"]) . "</p>";
                                echo "<form action='' method='post'>";
                                echo "<input type='hidden' name='trip_id' value='" . htmlspecialchars($row['id']) . "'>";
                                echo "<input type='submit' name='show_trip' value='Check Trip' class='btn btn-warning' style='width:50%;'>";
                                echo "</form>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>No trips found</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- show trip close -->
        
        <!-- company details -->
        <section class="company-detail">
            <div class="container">
                <div class="col-12 blog-header text-center my-3">
                    <h2>Know More About Us</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima hic animi unde architecto
                        cumque
                        illo fuga necessitatibus debitis facilis nobis?</p>
                </div>
                <div class="row align-items-center mt-3">
                    <div class="col-12 col-lg-7 detail-box">
                        <h2>Discover Special Deals!</h2>
                        <h4>Make sure to check out these special promotions, We Are provide many types of Trips.</h4>
                        <input type="submit" value="See Trips" class="btn btn-warning">
                    </div>  
                    <div class="col-12 col-lg-5 mail-box my-5">
                        <h4>Don’t miss a thing About</h4>
                        <span style="color: red; font-size: 50px; font-weight:600;">'GUJRAT TOURS'</span>
                        <h4>Get update to special deals and exclusive offers.
                            Sign up to our newsletter!</h4>
                        <div class="mail">
                            <input type="email" name="email" placeholder="Enter Your Email" id="">
                            <input type="submit" value="Send Mail" class="btn btn-success send-mail-btn">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- company  details close -->

        <!-- company blogs -->
        <section class="content-blog">
            <div class="container">
                <div class="row content-header-blog">
                    <div class="col-12 blog-header text-center my-3">
                        <h2>Travel Blog</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima hic animi unde architecto
                            cumque
                            illo fuga necessitatibus debitis facilis nobis?</p>
                    </div>
                    <div class="col-12 contenttype-blog-list mb-5">
                        <div class="row blog-list">
                            <div class="col-12 col-lg-6 latest-blog">
                                <img class="blog-img"
                                    src="https://travel.nicdark.com/travel-agency-wordpress-theme/wp-content/uploads/sites/9/2023/05/i-parallax-11-1024x683.jpeg"
                                    alt="" srcset="">
                                <div class="date">Aug 1,2024</div>
                                <div class="blog-title">Plan For the Perfect Vacation.</div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque aliquid provident
                                    totam
                                    delectus? Eaque natus unde doloremque libero culpa tenetur!Lorem ipsum dolor sit
                                    amet,
                                    consectetur adipisicing elit. Neque aliquid provident totam
                                    delectus?</p>
                                <div class="blog-btn"><input type="submit" value="Read More" class="btn btn-success">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 aside-blog-list mt-4">
                                <div class="row blogs mb-3">
                                    <div class="col-12 col-md-6 col-lg-4 img">
                                        <img class="blog-img"
                                            src="https://travel.nicdark.com/travel-agency-wordpress-theme/wp-content/uploads/sites/9/2023/05/i-parallax-11-1024x683.jpeg"
                                            alt="" srcset="">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-8 blog-detail">
                                        <div class="date">Aug 1,2024</div>
                                        <div class="blog-title" style="font-size: 22px; font-weight: 500;">Plan For the
                                            Perfect Vacation.</div>
                                        <p style="font-size: 12px;">Lorem ipsum dolor
                                            sit amet,
                                            consectetur adipisicing elit. Neque aliquid provident
                                            totam
                                            delectus? Eaque natus unde doloremque libero culpa tenetur!Lorem ipsum dolor
                                            sit
                                            amet,
                                            consectetur adipisicing elit. Neque aliquid provident totam
                                            delectus?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
         <!-- company blogs end -->

        <!-- footer start -->
        <?php include ("components/header-footer/user-footer.php"); ?>
        <!-- footer over -->

        <!-- main class -->
    </div>
</body>
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</html>