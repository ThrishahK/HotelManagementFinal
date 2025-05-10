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
            <li><a href="takeaway.html">Home</a></li>
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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$orderID = $_POST['order_id'] ?? '';
$custPhone = $_POST['cust_phone'] ?? '';

if (!empty($orderID) && !empty($custPhone)) {
    $stmt = $conn->prepare("UPDATE TAKEWAYS SET order_status = 'canceled' WHERE order_id = ? AND cust_phone = ?");
    
    if (!$stmt) {
        echo "<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                <div>Prepare failed: " . $conn->error . "</div>
              </div>";
        exit();
    }

    $stmt->bind_param("ss", $orderID, $custPhone);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo "<div style='color: #00FF00; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                <div>Order successfully canceled!<br> Order ID: <strong>$orderID</strong></div>
              </div>";
    } else {
        echo "<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
                <div>Order not found or already canceled.</div>
              </div>";
    }

    $stmt->close();
} else {
    echo "<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
            <div>Missing order ID or phone number.</div>
          </div>";
}

$conn->close();
?>

