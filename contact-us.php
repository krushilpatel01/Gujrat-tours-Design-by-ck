<?php
include 'user/config.php';
session_start();


    if (isset($_POST['send_message'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

         $add_trip_query = mysqli_query($conn, "INSERT INTO `contact_us_message`(name, email, message) VALUES('$name', '$email', '$message')") or die('query failed');
    }
    else {
        $message[] = 'Message not sent';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Page</title>
<!-- include css all files -->
<?php
    include "components/files/css.php";
    ?>
</head>

<body>
        <!-- nav start -->
        <?php include ("components\header-footer\header.php"); ?>
        <!-- nav over -->
         

        <section class="contact-us">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col">
                        <form action="" method="post">
                            <label for="name">Name :</label>
                            <input type="text" name="name" placeholder="enter your fullname" id="">
                            <label for="name">Email :</label>
                            <input type="email" name="email" placeholder="enter your email" id="">
                            <label for="message">Message</label>
                            <textarea name="message" id="" placeholder="enter your message"></textarea>
                            <input type="submit" name="send_message" value="Send Message" class="btn btn-info">
                        </form>
                    </div>
                    <div class="col">
                        <img src="components/images/extra-photos/travel_1_1-1-1-1.png" alt="" srcset="">
                    </div>
                </div>
            </div>
        </section>

        <!-- footer start -->
        <?php include ("components/header-footer/user-footer.php"); ?>
        <!-- footer over -->

</body>
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
</html>