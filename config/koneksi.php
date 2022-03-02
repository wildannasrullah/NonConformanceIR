<?php
$servername = "192.168.88.88";
$username = "root";
$password = "19K23O15P";
$db = "ncir_krisanthium";


$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}

?>