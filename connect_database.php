<?php
$servername = "db554888958.db.1and1.com";
$username = "dbo554888958";
$password = "3.1415isGood";
$database_name = "db554888958";
$database_port = 3306;
// Create connection
$conn = new mysqli($servername, $username, $password,$database_name,$database_port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->select_db($database_name);