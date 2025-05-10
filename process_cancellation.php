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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingId = $_POST['booking_id'] ?? null;
$cancelPhone = $_POST['cust_phone'] ?? null;


    // Attempt to cancel the reservation
    $sql = "UPDATE Bookings1 SET state = 'cancel' WHERE booking_id = '$bookingId' AND cust_phone = '$cancelPhone'";

    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            echo "<div style='color:rgb(45, 245, 5); text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                    <div>Reservation cancelled successfully!</div>
                  </div>";
         
        } else {
            echo "<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                    <div>Error: No reservation found with that Booking ID and Phone Number.</div>
                  </div>";
        }
    } else {
        echo "<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                <div>Error: " . $conn->error . "</div>
              </div>";
    }
}

$conn->close();
?>
