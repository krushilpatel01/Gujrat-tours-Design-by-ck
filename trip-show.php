<?php
include 'user/config.php';
session_start();

if (isset($_GET['trip_id'])) {
    $trip_id = $_GET['trip_id'];
    
    // If you expect $types_id to come from somewhere, assign it a value before using it
    // For example, you can fetch it based on the $trip_id or any other logic
    // $types_id = <some logic to retrieve types_id>;

    // Fetch the current details of the trip
    $query = "SELECT * FROM trip WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $trip_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $trip = $result->fetch_assoc();

} else {
    echo "No trip ID provided.";
    exit();
}

// Query to retrieve data from the trip table
$sql = "SELECT * FROM trip WHERE id = '$trip_id'";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip - Trip Show</title>
    <!-- include css all files -->
    <?php
    include "components/files/css.php";
    ?>
    <style>
        input:not([type="submit"]){
            width: 100%;
            margin: 10px auto;
            padding: 10px 0px;
            text-indent: 10px;
        }
    </style>
</head>
<body>

    <div class="main">
        <!-- nav start -->
        <?php include ("components/header-footer/header.php"); ?>
        <!-- nav over -->

        <div class="container">
            <div class="row page-section my-5">  
                <div class="col-12 pages"><span class="px-1"><a href="index.php">Home</a></span><span>/</span><span class="px-1"><a href="destination.php">Destination</a></span><span>/</span><span class="px-1"><a href="trip-package.php">Trip</a></span></div>
            </div>
            <!-- show trip -->
             <div class="row trip-section">
             <?php
                if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                echo "<div class='col-12 trip-image'>";
                            $imagePath = 'AdminLTE-3.2.0/pages/trips-setting/upload_img/' . $row["image"];
                            if (file_exists($imagePath)) {
                                echo "<img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row["name"]) . "'>";
                            } else {
                                echo "<p>Image not available</p>";
                            }
                echo "</div>";
                echo "<div class='col-9 trip-detail'>";
                echo "<hr class='my-5 px-3'>
                    <h2 class='trip-name'>Trip Name :  " . htmlspecialchars($row["name"]) . "</h2>
                    <h3 class='trip-detail mt-3' style='font-size:20px'>Trip Details :  " . htmlspecialchars($row["detail"]) . "</h3>
                    <div class='trip-form'>
                        <form action='' method='post'>
                            <h2 class='my-2'>You can send your inquiry via this form below</h2>

                            <h4 class='mt-5'>Trip Name : (here add trip name)</h4>

                            <label for='name'>Your Name:</label>
                            <input type='text' name='name' id='' placeholder='Enter Your Name' required
                            style='width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;'>

                            <label for='email' style='width:100%'>Your Email:</label>
                            <input type='email' name='email_id' id='' placeholder='Enter Your email' required
                            style='width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;'>

                            <label for='name' style='width:100%'>Contact Number:</label>
                            <input type='number' name='number' id='' placeholder='Enter Your number' required
                            style='width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;'>

                            <label for='name' style='width:100%'>Enquiry Subject:</label>
                            <input type='text' name='subject' id='' placeholder='Enter Your enquiry sebject' required
                            style='width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;'>

                            <label for='name' style='width:100%'>Your Message:</label>
                            <textarea style='width:100%' name='message'></textarea>
                            
                            <input type='submit' class='btn btn-warning my-2' value = 'send Message'>
                        </form>
                    </div>";
                echo "</div>";
                echo "<div class='col-3 trip-price'>
                    <h3 class='price'> " . htmlspecialchars($row["price"]) . "</h3>";
                echo "</div>";
                    }
                } else {
                    echo "<p>No trips found</p>";
                }
            ?>
            </div>
            <!-- trip-section over -->
        </div>

        <!-- main clsas over -->
    </div> 


    <?php
    // Close the connection
    $conn->close();
    ?>
            </div>
            <!-- <button type="submit" class="btn btn-success">Show All Trip</button> -->
        </div>
    </section>

    <section class="trip"></section>
</body>
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
</html>