<?php
include 'user/config.php';

// Check if booking ID and date are passed in the URL
if (isset($_GET['booking_id']) && isset($_GET['booking_date'])) {
    $booking_id = $_GET['booking_id'];
    $booking_date = $_GET['booking_date'];

    // Fetch the booking details from the database using the booking ID
    $stmt = $conn->prepare("SELECT * FROM trip_bookings WHERE id = ?");
    $stmt->bind_param('i', $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    if ($booking) {
        // Store booking details in variables for later use
        $bookingDetails = [
            "Booking ID" => $booking['id'],
            "Trip Name" => $booking['trip_name'],
            "Destination" => $booking['destination'],
            "Booking Date" => htmlspecialchars($booking_date),
            "Adults" => $booking['adult_qty'],
            "Children" => $booking['child_qty'],
            "Total Price" => $booking['total_price']
        ];
    } else {
        $error_message = "Booking details not found.";
    }
    $stmt->close();
} else {
    $error_message = "Invalid booking details.";
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Success</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        .booking-card {
            border: 1px solid #dee2e6;
            padding: 20px;
            margin-top: 20px;
        }
        .action-btns {
            margin-top: 20px;
        }
        .action-btns button {
            margin-right: 10px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
        <!-- include css all files -->
        <?php
    include "components/files/css.php";
    ?>
</head>
<body>
    <!-- nav start -->
    <?php include ("components/header-footer/header.php"); ?>
    <!-- nav over -->
    <div class="container mt-5 mb-5">
        <h1 class="text-success">Booking Successful!</h1>

        <?php if (isset($bookingDetails)): ?>
            <div class="booking-card">
                <h3>Booking Details</h3>
                <table class="table table-bordered mt-3">
                    <tbody>
                        <?php foreach ($bookingDetails as $key => $value): ?>
                            <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $value; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Download / Print Button and Go to My Account Button -->
            <div class="no-print action-btns">
                <button onclick="window.print();" class="btn btn-primary">Print or Download Booking Details</button>
                <a href="index.php" class="btn btn-secondary">Go to My Account</a>
            </div>

        <?php else: ?>
            <div class="alert alert-danger mt-4">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- footer start -->
    <?php include ("components/header-footer/user-footer.php"); ?>
    <!-- footer over -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
</body>
</html>
