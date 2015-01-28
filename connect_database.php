<?php
<<<<<<< HEAD
$servername = "x";
$username = "y";
$password = "z";
$database_name = "db";
=======
$servername = "localhost";
$username = "webuser";
$password = "3.1415isGood";
$database_name = "db554888958";
>>>>>>> 84a90a1... Changing db details because COME ON - Mr.B
$database_port = 3306;
// Create connection
$conn = new mysqli($servername, $username, $password,$database_name,$database_port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->select_db($database_name);