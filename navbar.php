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
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="reviews.html">Reviews</a></li>
        </ul>
    </nav>
    </body>
</html>