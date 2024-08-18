<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aishatu_best_academy";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
