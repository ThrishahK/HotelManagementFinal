
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
            <li><a href="dineoptions.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="reviews.html">Reviews</a></li>
        </ul>
    </nav>
    </body>
</html>


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db_connection.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['dining_type'])) {
        // This is a reservation
        $location = $_POST['dining_type'] ?? '';
        $phone = $_POST['cust_phone'] ?? '';
        $diners = $_POST['dnumber'] ?? '';
        $timing = $_POST['dining_time'] ?? '';
        $veg = isset($_POST['veg']) ? 1 : 0;
        $non_veg = isset($_POST['non_veg']) ? 1 : 0;
        $hotelname = isset($_POST["Hotel_name"]) ? $conn->real_escape_string($_POST["Hotel_name"]) : '';
        $state = 'booked';
        

        function DiningId($conn) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $length = 5;
            $count=1;
            do {
                $diningId = '';
                for ($i = 0; $i < $length; $i++) {
                    $diningId .= $characters[rand(0, strlen($characters) - 1)];
                }
        
                // Check for uniqueness
                $stmt = $conn->prepare("SELECT COUNT(*) FROM Bookings1 WHERE booking_id = ?");
                $stmt->bind_param("s", $diningId);
                $stmt->execute();
                $stmt->bind_result($count);
                $stmt->fetch();
                $stmt->close();
            } while ($count > 0);
        
            return $diningId;
        }
        $diningId = DiningId($conn);
        // Insert reservation details into the database
        $sql = "INSERT INTO DININGs (dining_type, cust_phone, dnumber, dining_time, veg, non_veg, dining_id,Hotel_name,state)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssisiisss", $location, $phone, $diners, $timing, $veg, $non_veg, $diningId, $hotelname, $state);

        if ($stmt->execute()) {
            // Set the state to 'booked' after reservation is successful
            $update_state_sql = "UPDATE DININGs SET state = 'booked' WHERE dining_id = ?";
            $stmt_update = $conn->prepare($update_state_sql);
            $stmt_update->bind_param("s", $diningId);
            $stmt_update->execute();
            $stmt_update->close();

            echo "<div style='color: #00FF00; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                <div>Reservation done successfully!<br>Your Dining ID: <strong>$diningId</strong></div>
              </div>";
        } else {
            echo "<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                <div>Error: " . $conn->error . "</div>
              </div>";
        }

        $stmt->close();
        $conn->close();

    } elseif (isset($_POST['dining_id'])) {
        // This is a cancellation
        $phone = $_POST['cust_phone'] ?? '';
        $diningId = $_POST['dining_id'] ?? '';
        
        $stmt = $conn->prepare("UPDATE DININGs SET state = 'cancel' WHERE dining_id = ? AND cust_phone = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
    
        $stmt->bind_param("ss", $diningId, $phone);
    
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "<div style='color:rgb(45, 245, 5); text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                        <div>Reservation cancelled successfully!</div>
                      </div>";
            } else {
                echo "<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                        <div>Error: No reservation found with that Dining ID and Phone Number.</div>
                      </div>";
            }
        } else {
            echo "<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                    <div>Error: " . $conn->error . "</div>
                  </div>";
        }
    }
}    
?>

