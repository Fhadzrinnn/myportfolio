<?php

include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);

    $sql = "UPDATE names SET first_name='$first_name', last_name='$last_name' WHERE id=1"; 

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method";
}

mysqli_close($conn);
?>
