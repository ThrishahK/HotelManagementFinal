<?php
$servername = "localhost";   // or your DB host
$username = "root";          // default for XAMPP/WAMP
$password = "15April2005";              // default for XAMPP/WAMP is empty
$dbname = "hotelmanage"; // replace with your actual DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<div style='color: red; text-align: center; font-family: Arial; background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center;'>
            <div>Connection failed: " . $conn->connect_error . "</div>
        </div>" );
}
?>
