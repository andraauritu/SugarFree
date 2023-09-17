<?php
$servername = "localhost";
$username = "andrauritu";
$password = "numauita";
$dbname = "sugarfree";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>