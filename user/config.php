<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gujrat_tour-database";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
} else {
    echo '';
}
?>