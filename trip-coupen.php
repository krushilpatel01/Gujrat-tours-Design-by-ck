<?php
include 'user/config.php';
session_start();



// Query to retrieve data from the trip table
$sql = "SELECT * FROM types";
$result = $conn->query($sql);

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



</body>
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
</html>