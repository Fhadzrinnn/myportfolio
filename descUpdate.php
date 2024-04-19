<?php
// Include database connection
include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the POST request
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Update query
    $sql = "UPDATE description SET description='$description' WHERE id=1"; 

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method";
}

// Close connection
mysqli_close($conn);
?>
