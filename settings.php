<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "makshaquille_part2";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
