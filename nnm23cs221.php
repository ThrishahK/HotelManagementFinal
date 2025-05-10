<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "15April2005";
$dbname = "Hoteldata";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn)
die("Not connected" .mysqli_connect_error());
else
echo 'Connected';
?>