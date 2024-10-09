<?php
include 'user/config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: user/login.php');
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID from the session

// Fetch user details from the database
$user_query = $conn->prepare("SELECT * FROM user WHERE id = ?");
$user_query->bind_param('i', $user_id);
$user_query->execute();
$user_result = $user_query->get_result();
$user = $user_result->fetch_assoc();

// Fetch user bookings from the database
$booking_query = $conn->prepare("SELECT * FROM trip_bookings WHERE client_id = ?");
$booking_query->bind_param('i', $user_id);
$booking_query->execute();
$bookings_result = $booking_query->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
    <?php include "components/files/css.php"; ?>
</head>
<body>

    <!-- Navigation -->
    <?php include("components/header-footer/header.php"); ?>
    <!-- main class start -->
    <div class="main">
        <!-- user Information start -->
        <div class="container mt-5">
            <!-- Updated User Information Section -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h4 class="card-title mb-3">Name: <?php echo htmlspecialchars($user['name']); ?></h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone'] ?? 'N/A'); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Joined On:</strong> <?php echo date('F j, Y', strtotime($user['date'])); ?></p>
                                    <p><strong>Membership:</strong> <?php echo htmlspecialchars($user['membership'] ?? 'Standard Member'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Booking Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Your Order Bookings</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Trip Name</th>
                                <th>Date</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($bookings_result->num_rows > 0) : ?>
                                <?php while ($booking = $bookings_result->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($booking['id']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['trip_name']); ?></td>
                                        <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($booking['booking_date']))); ?></td>
                                        <td>$<?php echo htmlspecialchars($booking['total_price']); ?></td>
                                        <td>
                                            <span class="badge bg-<?php 
                                                if ($booking['status'] == 'Confirmed') {
                                                    echo 'success';  // Green for confirmed bookings
                                                } elseif ($booking['status'] == 'pending') {
                                                    echo 'warning';  // Yellow for pending bookings
                                                } elseif ($booking['status'] == 'Canceled') {
                                                    echo 'danger';   // Red for canceled bookings
                                                } 
                                            ?>">
                                                <?php echo htmlspecialchars($booking['status']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No bookings found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Logout Button -->
            <div class="text-end">
                <a href="user/logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
        <!-- main class over -->
    </div>

            <!-- footer start -->
            <?php include ("components/header-footer/user-footer.php"); ?>
        <!-- footer over -->

    <!-- Include JS files -->
    <?php include "components/files/js.php"; ?>
</body>
</html>
