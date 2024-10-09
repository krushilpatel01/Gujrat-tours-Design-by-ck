<?php
include 'user/config.php';
// session_start();

if (isset($_GET['trip_id'])) {
    $trip_id = $_GET['trip_id'];
    
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['trip_query'])) {
    // Sanitize and store form inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email_id = $conn->real_escape_string($_POST['email_id']);
    $number = $conn->real_escape_string($_POST['number']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);
    $trip_id = $conn->real_escape_string($_POST['trip_id']);
    $trip_name = $conn->real_escape_string($_POST['trip_name']);

    // Insert the data into the inquiry table
    $insert_sql = "INSERT INTO trip_query (trip_id, trip_name, name, email, number, subject, message) 
                   VALUES ('$trip_id', '$trip_name', '$name', '$email_id', '$number', '$subject', '$message')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "<script>
                alert('Your Inquiry has been successfully sent. Our team will contact you!');
                window.location.href='trip-show.php?trip_id=$trip_id';
              </script>";
    } else {
        echo "<p>Error: " . $insert_sql . "<br>" . $conn->error . "</p>";
    }
}

// this code show specific trip in new page
if (isset($_POST['book_trip'])) {
    $trip_id = (int)$_POST['trip_id'];
    header("Location: book-trip.php?trip_id=$trip_id");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['trip_query'])) {
}

// this below code show title of page using this code
// Query to retrieve data from the trip table
$sql = "SELECT * FROM trip WHERE id = '$trip_id'";
$result2 = $conn->query($sql);
$row2 = $result2->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip - <?php echo htmlspecialchars($row2['name']); ?></title>
    <!-- include css all files -->
    <?php
    include "components/files/css.php";
    ?>
    <style>
        input:not([type="submit"]){
            width: 100%;
            padding: 10px 0px;
            text-indent: 10px;
        }
        .trip-price{
            margin-top: 100px;
            padding: 30px 10px;
            height: 200px;
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- nav start -->
    <?php include ("components/header-footer/header.php"); ?>
    <!-- nav over -->

        <div class="container">
            <div class="row page-section my-5">  
                <div class="col-12 pages"><span class="px-1"><a href="index.php">Home</a></span><span>/</span><span class="px-1"><a href="trip-package.php">All Trips</a></span><span>/</span><span class="px-1"><a href="trip-package.php">Trip</a></span></div>
            </div>
            <!-- show trip -->
            <div class="row trip-section">
                <?php
                // Query to retrieve data from the trip and day_wise_secudle tables
                $sql = "SELECT * FROM trip WHERE id = '$trip_id'";
                $result = $conn->query($sql);
                

                if ($result->num_rows > 0) {
                    // Fetch the trip data
                    $row = $result->fetch_assoc();
                
                    // trip-image
                    echo "<div class='col-12 trip-image'>";
                    $imagePath = 'AdminLTE-3.2.0/pages/trips-setting/upload_img/' . $row["image"];
                    if (file_exists($imagePath)) {
                        echo "<img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row["name"]) . "'>";
                    } else {
                        echo "<p>Image not available</p>";
                    }
                    echo "</div>";
                
                    // trip-details-start
                    echo "<div class='col-12 col-lg-9 trip-detail'>
                        <hr class='my-5 px-3'>
                        <h2 class='trip-name'>Trip Name: " . htmlspecialchars($row["name"]) . "</h2>
                        <h3 class='trip-detail mt-3' style='font-size:20px'>Trip Details: " . htmlspecialchars($row["detail"]) . "</h3>";
                
                        // Ensure $trip_id is properly sanitized to prevent SQL injection
                        $trip_id = htmlspecialchars($_GET['trip_id']);
                        
                        // Query to fetch day-wise schedule data
                        $day_secudle = "SELECT * FROM day_wise_secudle WHERE trip_id = ?";
                        $stmt = $conn->prepare($day_secudle);
                        
                        // Check if the statement preparation was successful
                        if ($stmt === false) {
                            die("Error preparing the SQL statement: " . $conn->error);
                        }
                        
                        // Bind the parameter
                        $stmt->bind_param('i', $trip_id);
                        
                        // Execute the query
                        $stmt->execute();
                        
                        // Get the result
                        $days_sec = $stmt->get_result();
                        
                        // Check if there are rows returned
                        if ($days_sec->num_rows > 0) {
                            $day_count = 1;
                            echo "<h6 class='mt-5'>Check Trip Day Wise Secudle:</h6>";
                            echo "<div class='accordion accordion-flush' id='accordionFlushExample'>";
                        
                            // Fetch the row with the day details
                            $days = $days_sec->fetch_assoc();
                        
                            // Loop through each day based on the total_days value
                            $total_days = intval($days['days']);
                            for ($i = 1; $i <= $total_days; $i++) {
                                $day_col = "day_$i";
                                if (isset($days[$day_col]) && !empty($days[$day_col])) {
                                    echo "<div class='accordion-item' style='border:1px solid black; margin:5px 0px;'>
                                            <h2 class='accordion-header' id='flush-heading$day_count'>
                                                <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse$day_count' aria-expanded='false' aria-controls='flush-collapse$day_count'>
                                                  Day $day_count
                                                </button>
                                            </h2>
                                            <div id='flush-collapse$day_count' class='accordion-collapse collapse' aria-labelledby='flush-heading$day_count' data-bs-parent='#accordionFlushExample'>
                                                <div class='accordion-body'>" . htmlspecialchars($days[$day_col]) . "</div>
                                            </div>
                                        </div>";
                                    $day_count++;
                                }
                            }
                        
                            echo "</div>"; // Close accordion
                        } else {
                            echo "<p>No day-wise schedule found for this trip.</p>";
                        }
                        
                        // Close the statement
                        $stmt->close();

                        
                    echo "</div>"; // Close trip-detail
                
                    // trip-price
                    echo "<div class='col-12 col-lg-3 trip-price mx-auto'>
                            <h3 class='price'>" . htmlspecialchars($row["price"]) . "/-</h3>
                            <hr>
                            <h6>Pay Per Person</h6>
                            <form action='' method='post'>
                                <input type='hidden' name='trip_id' value='$row[id]'>
                                <input type='hidden' name='trip_name' value='$row[name]'>
                                <input type='submit' name='book_trip' value='Book Trip' class='btn btn-warning mt-2' style='width:100%;'>
                            </form>
                          </div>";
                } else {
                    echo "<p>No trips found</p>";
                }
                ?>
            </div>

            <!-- trip-section over -->
            <div class='trip-inquiry-form mt-5'>
                <?php
                    // Query to retrieve data from the trip and day_wise_schedule tables
                    $sql = "SELECT * FROM trip WHERE id = '$trip_id'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Fetch the trip data
                        $row = $result->fetch_assoc();
                        echo "<form action='' method='post'>
                            <h2>You can send your inquiry via this form below</h2>
                    
                            <h4 class='mb-4'>Trip Name: " . htmlspecialchars($row['name']) . "</h4>
                    
                            <label for='name'>Your Name:</label>
                            <input type='text' name='name' id='' placeholder='Enter Your Name' required
                            style='width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;'>
                    
                            <label for='email' style='width:100%'>Your Email:</label>
                            <input type='email' name='email_id' id='' placeholder='Enter Your email' required
                            style='width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;'>
                    
                            <label for='number' style='width:100%'>Contact Number:</label>
                            <input type='number' name='number' id='' placeholder='Enter Your number' required
                            style='width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;'>
                    
                            <label for='subject' style='width:100%'>Enquiry Subject:</label>
                            <input type='text' name='subject' id='' placeholder='Enter Your enquiry subject' required
                            style='width:100%; margin:10px auto; padding:10px 0px; text-indent:10px; outline: none;'>
                    
                            <label for='message' style='width:100%'>Your Message:</label>
                            <textarea style='width:100%' name='message'></textarea>

                            <input type='hidden' name='trip_id' value='$row[id]'>
                            <input type='hidden' name='trip_name' value='$row[name]'>
                            <input type='submit' name='trip_query' class='btn btn-warning my-2' value='Send Message'>
                        </form>";
                    } else {
                        echo "<p>No trip found.</p>";
                    }
                ?>
            </div>

        <!-- container over -->
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

            <!-- footer start -->
            <?php include ("components/header-footer/user-footer.php"); ?>
        <!-- footer over -->
</body>
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
</html>