<?php
$dbHost = 'localhost'; // Change this if your database is hosted elsewhere
$dbUsername = 'id22056155_fhadzrinpanga';
$dbPassword = 'Llhanz@1207';
$dbName = 'id22056155_fhadzrinpanga';

$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
