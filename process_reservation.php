<?php
 include('navbar.php');
// Database connection details
$servername = "localhost";
$username = "root";
$password = "15April2005";
$dbname = "hotelmanage";

// Create connection
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
        $bookingId = '';
        for ($i = 0; $i < $length; $i++) {
            $bookingId .= $characters[rand(0, strlen($characters) - 1)];
        }

        // Check for uniqueness
        $stmt = $conn->prepare("SELECT COUNT(*) FROM Bookings1 WHERE booking_id = ?");
        $stmt->bind_param("s", $bookingId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    } while ($count > 0);

    return $bookingId;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotel = $conn->real_escape_string($_POST["hotel_id"]);
    $name = $conn->real_escape_string($_POST["cust_name"]);
    $phone = $conn->real_escape_string($_POST["cust_phone"]);
    $checkin = $conn->real_escape_string($_POST["check_in_date"]);
    $checkout = $conn->real_escape_string($_POST["check_out_date"]);

    // Use the new function to generate a unique ID
    $bookingId = generateBookingId($conn);
    $state = 'booked';

    $sql = "INSERT INTO Bookings1 (hotel_id, cust_phone, check_in_date, check_out_date, booking_id, state)
            VALUES ('$hotel', '$phone', '$checkin', '$checkout', '$bookingId', '$state')";
    

    if ($conn->query($sql) === TRUE) {
        echo "<div style='color: #00FF00; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                <div>Reservation submitted successfully!<br>Your Booking ID: <strong>$bookingId</strong></div>
              </div>";
        
    } else {
        echo "<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                <div>Error: " . $conn->error . "</div>
              </div>";
    }
}

$conn->close();
?>
