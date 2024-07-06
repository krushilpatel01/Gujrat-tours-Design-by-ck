<?php
// include 'user/config.php';

// session_start();


if (isset($_SESSION['username'])) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
} else {
    echo "";
}

// echo "$user_id";
// echo "$user_name";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css.css">
    <!-- custom css -->
    <link rel="stylesheet" href="components\css\site-css.css">
</head>

<body>
    <div class="main">
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-1" style="height: 200px;">
            <div class="container">
                <a class="navbar-brand" href="../index.php">Gujrat Tours</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Destinations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Trips</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact us</a>
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
                        <!-- <li class="nav-icon">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-icon">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>



        <!-- main class over -->
    </div>
</body>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<!-- font awesome cdn js link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>

</html>