<?php
$servername = "x";
$username = "y";
$password = "z";
$database_name = "db";
$database_port = 3306;
// Create connection
$conn = new mysqli($servername, $username, $password,$database_name,$database_port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->select_db($database_name);