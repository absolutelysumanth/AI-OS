<?php
$servername = "localhost"; // Your server name (usually localhost)
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "ai_os";      // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
