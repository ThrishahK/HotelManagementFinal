<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management System</title>
    <style>
    nav {
            background: #030396d6;
            padding: 15px 0;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            text-decoration: none;
            color: burlywood;
            font-size: 18px;
            padding: 10px 20px;
            transition: 0.3s;
        }

        nav ul li a:hover {
            background-color: burlywood;
            color: black;
            border-radius: 5px;
        }
        .welcome-header {
    background: black;
    padding: 20px;
    color: burlywood;
    text-align: center;
}
    </style>

</head>
<body>

    <header class="welcome-header">
        <h1>Welcome to Our Luxurious Hotels</h1>
        <p>Find your perfect stay with comfort and elegance.</p>
    </header>

    <nav>
        <ul>
            <li><a href="hotels.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="reviews.html">Reviews</a></li>
        </ul>
    </nav>
    </body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "15April2005";
$dbname = "hotelmanage";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center;'>
            <div>Connection failed: " . $conn->connect_error . "</div>
        </div>");
}

// Function to generate unique 5-character booking ID
function generateBookingId($conn) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $length = 5;
    $count=1;
    do {
        $booking_id = '';
        for ($i = 0; $i < $length; $i++) {
            $booking_id .= $characters[rand(0, strlen($characters) - 1)];
        }

        // Check if this ID already exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM Bookings1 WHERE booking_id = ?");
        $stmt->bind_param("s", $booking_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    } while ($count > 0);

    return $booking_id;
}

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect data
    $hotel_id = $_POST['hotel_id'] ?? null;
    $cust_phone = $_POST['cust_phone'] ?? null;
    $check_in_date = $_POST['check_in_date'] ?? null;
    $check_out_date = $_POST['check_out_date'] ?? null;
    $state = 'booked';

    // Validate fields
    if (empty($hotel_id) || empty($cust_phone) || empty($check_in_date) || empty($check_out_date)) {
        echo "<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center;'>
                <div>Please fill in all required fields.</div>
              </div>";
        $conn->close();
        exit();
    }

    // Generate a unique booking ID
    $booking_id = generateBookingId($conn);

    // Insert booking
    $stmt = $conn->prepare("INSERT INTO Bookings1 (booking_id, cust_phone, hotel_id, check_in_date, check_out_date, state) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $booking_id, $cust_phone, $hotel_id, $check_in_date, $check_out_date, $state);

    if ($stmt->execute()) {
        echo "<div style='color: #00FF00; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                <div>Booking successful! Your booking ID is: <strong>$booking_id</strong></div>
              </div>";
    } else {
        echo "<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center;'>
                <div>Error saving booking: " . $stmt->error . "</div>
              </div>";
    }

    $stmt->close();
} else {
    echo "<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center;'>
            <div>Invalid request method.</div>
          </div>";
}

$conn->close();
?>

