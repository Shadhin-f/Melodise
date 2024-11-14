<?php
// Database connection variables
$servername = "localhost";
$username = "root";  // Replace with your actual database username
$password = "";  // Replace with your actual database password
$dbname = "melodise_db";  // Make sure this matches your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
