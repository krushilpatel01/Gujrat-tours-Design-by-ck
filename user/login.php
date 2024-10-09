<?php

include 'config.php';
session_start();

// Start output buffering
ob_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass'") or die('Query failed: ' . mysqli_error($conn));

    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);

        // Debugging: Print the fetched user data
        echo "Fetched user data: <pre>";
        print_r($row);
        echo "</pre>";

        // Debugging: Check the user type
        $user_type = trim(strtolower($row['user_type']));
        echo "User type (after trimming and converting to lowercase): $user_type<br>";

        if ($user_type == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];

            // Check for a redirect query parameter
            if (isset($_GET['redirect'])) {
                header('Location: ' . $_GET['redirect']);
            } else {
                header('Location: ..\AdminLTE-3.2.0\index.php');
            }
            ob_end_flush(); // End output buffering and send headers
            exit;

        } elseif ($user_type == 'user') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];

            // Check for a redirect query parameter
            if (isset($_GET['redirect'])) {
                header('Location: ' . $_GET['redirect']);
            } else {
                header('Location: ..\index.php');
            }
            ob_end_flush(); // End output buffering and send headers
            exit;

        } else {
            echo 'Unrecognized user type!';
        }

    } else {
        echo 'Incorrect email or password!';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="..\components\css\site-css.css">
</head>

<body>
    <!-- nav start -->
    <?php include ("..\components\header-footer\header2.php"); ?>
    <!-- nav over -->

    <div class="container">
        <section class="row form-container mx-auto">
            <form class="col-sm-12 col-lg-6 my-5" action="" method="post">
                <h3>Login Form</h3>
                <input type="email" name="email" placeholder="Enter your email" id="" class="box" required>
                <input type="password" name="password" placeholder="Enter your password" id="" class="box" required>
                <input type="submit" name="submit" value="Login Now" class="btn btn-warning">
                <p>Create a new account here! <a href="register.php">Register now</a></p>
            </form>
        </section>
    </div>

            <!-- footer start -->
            <?php include ("../components/header-footer/user-footer2.php"); ?>
        <!-- footer over -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- font awesome cdn js link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>

</body>

</html>