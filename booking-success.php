<?php
include 'user/config.php';
session_start();

// Check if booking_id is set in the URL
if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Prepare and execute the query to fetch booking details
    $stmt = $conn->prepare("SELECT * FROM trip_bookings WHERE id = ?");
    $stmt->bind_param('i', $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch booking details
        $booking = $result->fetch_assoc();
    } else {
        $error_message = "Booking not found.";
    }
    $stmt->close();
} else {
    $error_message = "No booking ID provided.";
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
    <!-- Include any CSS or JS files here -->
</head>
<body>
    <?php if (isset($error_message)): ?>
        <p><?php echo htmlspecialchars($error_message); ?></p>
    <?php else: ?>
        <h1>Booking Confirmation</h1>
        <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($booking['id']); ?></p>
        <p><strong>Trip Name:</strong> <?php echo htmlspecialchars($booking['trip_name']); ?></p>
        <p><strong>Destination:</strong> <?php echo htmlspecialchars($booking['destination']); ?></p>
        <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($booking['booking_date']); ?></p>
        <p><strong>Adults:</strong> <?php echo htmlspecialchars($booking['adult_qty']); ?></p>
        <p><strong>Children:</strong> <?php echo htmlspecialchars($booking['child_qty']); ?></p>
        <p><strong>Total Price:</strong> $<?php echo htmlspecialchars($booking['total_price']); ?></p>
        <p><strong>Coupon Used:</strong> <?php echo htmlspecialchars($booking['coupon_used']); ?></p>
    <?php endif; ?>
</body>
</html>
