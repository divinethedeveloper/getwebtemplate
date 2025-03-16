<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'getbusinesswebsite';

// Create mysqli connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get mysqli connection
function getConnection() {
    global $conn;
    return $conn;
}

?>