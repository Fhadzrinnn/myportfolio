<?php
include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // No need to escape, since it's an integer
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Prepare UPDATE statement
    $sql = "UPDATE contacts SET email=?, phone=?, address=? WHERE id=?";

    // Prepare the statement
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement preparation failed";
        exit();
    } else {
        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "sssi", $email, $phone, $address, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_stmt_error($stmt);
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request method";
}

// Close connection
mysqli_close($conn);
?>

