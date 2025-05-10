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

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    showMessage("Database connection failed: " . $conn->connect_error, false);
    exit;
}

function generateOrderID($conn) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $length = 5;
    $count = 1;

    do {
        $order_id = '';
        for ($i = 0; $i < $length; $i++) {
            $order_id .= $characters[rand(0, strlen($characters) - 1)];
        }

        $stmt = $conn->prepare("SELECT COUNT(*) FROM TAKEWAYS WHERE order_id = ?");
        if (!$stmt) {
            die("Prepare failed in generateOrderID: " . $conn->error);
        }

        $stmt->bind_param("s", $order_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    } while ($count > 0);

    return $order_id;
}

function showMessage($message, $success = true) {
    $color = $success ? '#00FF00' : 'red';
    echo "<div style='color: $color; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; font-size: 20px;'>
            <div>$message</div>
          </div>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = generateOrderID($conn);
    $food_items = isset($_POST['food']) ? implode(", ", $_POST['food']) : '';
    $delivery_location = trim($_POST['delivery_location'] ?? '');
    $hotel_name = trim($_POST['Hotel_name'] ?? 'External');
    $cust_phone = trim($_POST['cust_phone'] ?? '');

    if (!$food_items || !$delivery_location || !$cust_phone) {
        showMessage("Missing required fields.", false);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO TAKEWAYS (order_id, item_name, delivery_location, hotel_name, cust_phone, order_status) VALUES (?, ?, ?, ?, ?, 'ordered')");
    if (!$stmt) {
        showMessage("Prepare failed: " . $conn->error, false);
        exit;
    }

    $stmt->bind_param("sssss", $order_id, $food_items, $delivery_location, $hotel_name, $cust_phone);

    if ($stmt->execute()) {
        showMessage("Order placed successfully!<br>Your Order ID is: <strong>$order_id</strong>");
    } else {
        showMessage("Order failed: " . $stmt->error, false);
    }

    $stmt->close();
}
$conn->close();
?>
v
