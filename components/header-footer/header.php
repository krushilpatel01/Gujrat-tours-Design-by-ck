<?php
// include 'user/config.php';

// session_start();


if (isset($_SESSION['username'])) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
} else {
    // echo $user_name;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header page</title>
</head>

<body>
    <div class="main">
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-1" style="height: 100px;">
            <div class="container">
                <a class="navbar-brand" href="index.php">Gujrat Tours</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
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
                              <a class="dropdown-item" href="trip-package.php">Trip package</a>
                              <a class="dropdown-item" href="trip-types.php">Trip Types</a>
                              <a class="dropdown-item" href="trip-coupen.php">Trip Coupen</a>
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
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <ul class="navbar-icon mb-2 mb-lg-0 text-center d-flex" style="list-style-type:none;">
                        <li class="nav-icon dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index: 999;">
                                <?php
                                if (isset($_SESSION['username'])) {
                                    echo "<li><a class='dropdown-item' href='#'>$user_name</a></li>";
                                } else {
                                    echo "<li class='dropdown-item'>Welcome User</li>";
                                }

                                if (isset($_SESSION['username'])) {
                                    echo "<li><a class='dropdown-item' href='#'>$user_name</a></li>";
                                } else {
                                    echo "<li><a class='btn dropdown-item' href='../Gujrat-tours/user/register.php'>Register Here</a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- main class over -->
    </div>
</body>
    
</html>