<?php

include 'config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cp-password']));
    $user_type = $_POST['user-roll'];

    $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'user already exist!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password not matched!';
        } else {
            $result = mysqli_query($conn, "INSERT INTO `user`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
            $message[] = 'registered successfully!';
            header('location:login.php');
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css.css">
    <!-- custom css -->
    <link rel="stylesheet" href="..\components\css\site-css.css">
</head>

<body>
    <!-- nav start -->
    <?php
    include ("..\components\header-footer\header.php");
    ?>
    <!-- nav over -->

    <div class="container">
        <section class="form-container">
            <form action="" method="post">
                <h3>Regestation Form</h3>
                <input type="text" name="name" placeholder="enter your name" id="" class="box">
                <input type="email" name="email" placeholder="enter your em" id="" class="box">
                <input type="password" name="password" placeholder="enter your password" id="" class="box">
                <input type="password" name="cp-password" placeholder="re-enter your password" id="" class="box">
                <select name="user-roll" id="">
                    <option value="User">user</option>
                    <option value="Admin">admin</option>
                </select>
                <input type="submit" name="submit" value="Register Now" class="btn btn-warning">
                <p>already have an account? <a href="login.php">login now</a></p>
            </form>
        </section>
    </div>



</body>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<!-- font awesome cdn js link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>

</html>