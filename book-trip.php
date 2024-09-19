<?php
include 'user/config.php';
session_start();

if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_id'])) {
    // Redirect to login page with trip_id as a query parameter
    $current_url = $_SERVER['REQUEST_URI'];
    header('Location: user/login.php?redirect=' . urlencode($current_url));
    exit();
}

// Initialize error message
$error_message = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['trip_id']) && isset($_POST['adult_qty']) && isset($_POST['child_qty']) && isset($_POST['selected_date'])) {
        $trip_id = $_POST['trip_id'];
        $adult_qty = $_POST['adult_qty'];
        $child_qty = $_POST['child_qty'];
        $selected_date = $_POST['selected_date'];
        $coupon_used = isset($_POST['coupon_used']) ? $_POST['coupon_used'] : ''; // Ensure it's a string
        $user_id = $_SESSION['user_id']; // Fetch the user ID from the session

        // Fetch trip details from the database
        $stmt = $conn->prepare("SELECT name, price, destination FROM trip WHERE id = ?");
        $stmt->bind_param('i', $trip_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $trip = $result->fetch_assoc();

        if (!$trip) {
            $error_message = "Trip not found.";
        } else {
            $trip_name = $trip['name'];
            $trip_price = $trip['price'];
            $destination = $trip['destination'];

            // Trip price calculation (for each person)
            $adult_price = $trip_price;
            $child_price = $trip_price;
            $total_price = ($adult_qty * $adult_price) + ($child_qty * $child_price);

            // Convert booking date to "Y-m-d" format for database insertion
            $booking_date = date('Y-m-d', strtotime($selected_date));

            // Ensure at least one adult or child is selected
            if ($adult_qty == 0 && $child_qty == 0) {
                $error_message = "Please select at least one adult or child to proceed with booking.";
            } else {
                // Convert booking date to the correct format (Y-m-d)
                $booking_date = date('Y-m-d', strtotime($selected_date));
            
                // Debugging: Print booking date and SQL query
                echo "Booking Date: " . $booking_date; // Debug booking date format
            
                // Construct the SQL query string directly
                $sql = "INSERT INTO trip_bookings (trip_id, trip_name, destination, booking_date, adult_qty, child_qty, trip_price, total_price, coupon_used, client_id) 
                        VALUES ($trip_id, '$trip_name', '$destination', '$booking_date', $adult_qty, $child_qty, $trip_price, $total_price, '$coupon_used', $user_id)";

                // Execute the query and check for success
                if ($conn->query($sql) === TRUE) {
                    // Get the last inserted booking ID
                    $booking_id = $conn->insert_id;
                
                    // Redirect to booking-success.php with the booking ID and date
                    echo "<script>
                    alert('Your Trip Booking has been successfully processed.');
                    window.location.href = 'booking-success.php?booking_id=" . $booking_id . "&booking_date=" . $booking_date . "';
                    </script>";
                } else {
                    // Output SQL error message
                    echo "Error: " . $conn->error;
                }
            }
        }
    } else {
        $error_message = "Required fields are missing!";
    }
}


// Fetch current trip details
if (isset($_GET['trip_id'])) {
    $trip_id = $_GET['trip_id'];
    $stmt = $conn->prepare("SELECT * FROM trip WHERE id = ?");
    $stmt->bind_param('i', $trip_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $trip = $result->fetch_assoc();
} else {
    echo "No trip ID provided.";
    exit();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <style>
        .calendar table {
            width: 100%;
            text-align: center;
        }

        .calendar th, .calendar td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .calendar th {
            background-color: #f8f9fa;
        }

        .calendar td {
            cursor: pointer;
        }

        .past-date {
            opacity: 0.5;
            pointer-events: none;
        }

        .selected-date {
            background-color: #00b894;
            color: white;
        }

        .quantity button {
            width: 30px;
            height: 30px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
        }

        .quantity input {
            width: 50px;
            text-align: center;
        }

        .summary-total {
            font-size: 20px;
            font-weight: bold;
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
    <div class="container my-5">
    <div class="row">
        <!-- Date and Time Section -->
        <div class="col-12 col-lg-8">
            <div id="date-time-section">
                <h3 class="mb-4">Select Date & Time</h3>
                <div class="calendar">
                    <!-- Month and Year Selector -->
                    <div id="calendar-controls" class="mb-3">
                        <select id="month-selector" class="form-select d-inline-block w-auto me-2">
                            <!-- Months will be populated dynamically -->
                        </select>
                        <select id="year-selector" class="form-select d-inline-block w-auto">
                            <!-- Years will be populated dynamically -->
                        </select>
                    </div>
                    <!-- Dynamic Calendar (Generated based on current date) -->
                    <div id="calendar-header" class="mb-3">
                        <h4 id="calendar-month-year"></h4>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Sun</th>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                            </tr>
                        </thead>
                        <tbody id="calendar-body">
                            <!-- JavaScript will populate calendar here -->
                        </tbody>
                    </table>
                    <button id="continue-btn" class="btn btn-warning mt-4">Continue</button>
                </div>
            </div>

            <!-- Traveller Selection Section -->
            <div id="traveller-section" style="display: none;">
                <h3 class="mb-4">Select Travellers</h3>
                <form method="POST" action="">
                    <input type="hidden" name="trip_id" value="<?php echo htmlspecialchars($trip_id); ?>"> <!-- Ensure trip_id is sent -->
                    
                    <!-- Display error message if any -->
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
                    <?php endif; ?>

                    <div class="people-count my-3 d-flex justify-content-between">
                        <h2><label for="">Travellers Type</label></h2>
                        <h2><label for="">Quantity</label></h2>
                    </div>
                    <div class="traveller-option mb-3 d-flex justify-content-between">
                        <label>Adult</label>
                        <div class="quantity">
                            <label><span>₹<?php echo $trip['price'];?> / person</span></label>
                            <button type="button" class="btn btn-secondary decrease bg-dark p-0">-</button>
                            <input type="text" id="adult-qty" name="adult_qty" value="0"> <!-- Added name attribute -->
                            <button type="button" class="btn btn-secondary increase bg-dark p-0">+</button>
                        </div>
                    </div>
                    <div class="traveller-option mb-3 d-flex justify-content-between">
                        <label>Child</label>
                        <div class="quantity">
                            <label><span>₹<?php echo $trip['price'];?> / person</span></label>
                            <button type="button" class="btn btn-secondary decrease bg-dark p-0">-</button>
                            <input type="text" id="child-qty" name="child_qty" value="0"> <!-- Added name attribute -->
                            <button type="button" class="btn btn-secondary increase bg-dark p-0">+</button>
                        </div>
                    </div>
                    <!-- Add an input field for coupons in the form -->
                    <label>Coupon Code (Optional)</label>
                    <input type="text" name="coupon_used" class="form-control mb-3" placeholder="Enter coupon code if any">

                    <input type="hidden" id="selected-date-hidden" name="selected_date" value="">

                    <button type="submit" id="proceed-btn" class="btn btn-primary mt-3">Proceed to Checkout</button>
                </form>
                <button id="back-btn" class="btn btn-secondary mt-3">Back</button>
            </div>
        </div>

        <!-- Booking Summary Section -->
        <div class="col-12 col-lg-4 my-4">
            <div class="card p-3">
                <div class="card-body">
                    <?php
                    // Query to retrieve data from the trip table
                    $sql = "SELECT * FROM trip WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('i', $trip_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Fetch the trip data
                        $row = $result->fetch_assoc();
                    
                        echo "<h5 class='card-title'>Booking Summary</h5>";
                        echo "<p>" . htmlspecialchars($row['name']) . "</p>";  // Fetch the correct 'name' field
                        echo "<p>Trip Price Per Person: " . htmlspecialchars($row['price']) . "</p>";  // Fetch the correct 'name' field
                        echo "<p>Starting Date: <span id='selected-date'>---</span></p>";
                    } else {
                        echo "<p>No trip found for this ID.</p>";
                    }
                
                    $stmt->close();
                    ?>
                    <div class="traveller-summary mb-4">
                        <p>Adults: <span id="adult-count">0</span></p>
                        <p>Children: <span id="child-count">0</span></p>
                    </div>
                
                    <div class="summary-total">Total: ₹<span id="total-price">0</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- footer start -->
    <?php include ("components/header-footer/user-footer.php"); ?>
    <!-- footer over -->

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    <?php
    // Assuming you already have fetched the trip details into $trip
    $tripPrice = isset($trip['price']) ? $trip['price'] : 0; // Default to 0 if no price is available
    ?>
    // Dynamically set the trip price from PHP
    const adultPrice = <?php echo $tripPrice; ?>;
    const childPrice = <?php echo $tripPrice; ?>;

    // Function to update total price
    function updateTotal() {
        const adultQty = parseInt($('#adult-qty').val()) || 0; // Default to 0 if empty or NaN
        const childQty = parseInt($('#child-qty').val()) || 0; // Default to 0 if empty or NaN
        const total = (adultQty * adultPrice) + (childQty * childPrice);
        $('#total-price').text(total.toLocaleString());
        $('#adult-count').text(adultQty);
        $('#child-count').text(childQty);
    }

    // Increase and decrease buttons
    $('.increase').click(function() {
        const input = $(this).siblings('input');
        input.val(parseInt(input.val()) + 1);
        updateTotal();
    });

    $('.decrease').click(function() {
        const input = $(this).siblings('input');
        if (parseInt(input.val()) > 0) {
            input.val(parseInt(input.val()) - 1);
            updateTotal();
        }
    });

    // Date selection
    $('#continue-btn').click(function() {
        const selectedDate = $('#calendar-body .selected-date').data('date');
        
        if (selectedDate) {
            $('#date-time-section').hide();
            $('#traveller-section').show();
            // Set the selected date to the hidden input field
            $('#selected-date-hidden').val(selectedDate);
            $('#selected-date').text(selectedDate);
        } else {
            alert('Please select a date.');
        }
    });

    $('#back-btn').click(function() {
        $('#date-time-section').show();
        $('#traveller-section').hide();
    });

    // Populate month and year selectors
    function populateSelectors() {
        const now = new Date();
        const monthSelect = $('#month-selector');
        const yearSelect = $('#year-selector');
        const months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        
        for (let i = 0; i < months.length; i++) {
            monthSelect.append(new Option(months[i], i + 1));
        }

        for (let i = now.getFullYear(); i <= now.getFullYear() + 10; i++) {
            yearSelect.append(new Option(i, i));
        }

        monthSelect.val(now.getMonth() + 1);
        yearSelect.val(now.getFullYear());
    }

    // Populate the calendar
    function populateCalendar() {
        const month = $('#month-selector').val();
        const year = $('#year-selector').val();
        const calendarBody = $('#calendar-body');

        const firstDay = new Date(year, month - 1, 1).getDay();
        const daysInMonth = new Date(year, month, 0).getDate();

        let calendarHtml = '<tr>';
        for (let i = 0; i < firstDay; i++) {
            calendarHtml += '<td></td>';
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const today = new Date();
            const isPastDate = new Date(year, month - 1, day) < today;

            calendarHtml += `<td class="${isPastDate ? 'past-date' : ''}" data-date="${year}-${month}-${day}">${day}</td>`;
            
            if ((day + firstDay) % 7 === 0) {
                calendarHtml += '</tr><tr>';
            }
        }
        calendarHtml += '</tr>';

        calendarBody.html(calendarHtml);
        $('#calendar-month-year').text(`${$('#month-selector option:selected').text()} ${year}`);
    }

    // Handle date selection
    $('#calendar-body').on('click', 'td:not(.past-date)', function() {
        $('#calendar-body td').removeClass('selected-date');
        $(this).addClass('selected-date');
    });

    // Event listeners
    $('#month-selector, #year-selector').change(populateCalendar);

    // Initialize
    populateSelectors();
    populateCalendar();
});
</script>


    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?>
</body>
</html>