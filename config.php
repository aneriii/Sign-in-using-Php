<?php
session_start();
$servername = "localhost";
$username = "root@localhost:3306"; // Update with your MySQL username
$password = "Password";     // Update with your MySQL password
$dbname = "user_auth";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>