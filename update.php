<?php
include_once 'connection.php';
$successMessage = $errorMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle image upload if a file is selected
    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] === UPLOAD_ERR_OK) {
        // Process the uploaded image
        $imageData = file_get_contents($_FILES['imageUpload']['tmp_name']);
        $imageType = $_FILES['imageUpload']['type'];

        // Update the image in the database (assuming 'images' table)
        $sqlUpdateImage = "UPDATE images SET image_data=?, image_type=?";
        $stmtUpdateImage = mysqli_prepare($conn, $sqlUpdateImage);
        mysqli_stmt_bind_param($stmtUpdateImage, "ss", $imageData, $imageType);
        if (mysqli_stmt_execute($stmtUpdateImage)) {
            $successMessage .= "Image updated successfully.<br>";
        } else {
            $errorMessage .= "Error updating image: " . mysqli_error($conn) . "<br>";
        }
        mysqli_stmt_close($stmtUpdateImage);
    }

    // Handle contact information update
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $sqlUpdateContact = "UPDATE contacts SET email=?, phone=?, address=?";
    $stmtUpdateContact = mysqli_prepare($conn, $sqlUpdateContact);
    mysqli_stmt_bind_param($stmtUpdateContact, "sss", $email, $phone, $address);
    if (mysqli_stmt_execute($stmtUpdateContact)) {
        if (mysqli_stmt_affected_rows($stmtUpdateContact) > 0) {
            $successMessage .= "Contact information updated successfully.<br>";
        } else {
            $errorMessage .= "No changes made to contact information.<br>";
        }
    } else {
        $errorMessage .= "Error updating contact information: " . mysqli_error($conn) . "<br>";
    }
    mysqli_stmt_close($stmtUpdateContact);

    // Display success or error message
    if (!empty($errorMessage)) {
        // If errors occurred, display error message
        echo "<div style='color: red;'>$errorMessage</div>";
    } else {
        // If no errors, display success message
        echo "<div style='color: green;'>$successMessage</div>";
    }

    // Redirect back to the dashboard or another page after updating
    header("Location: dashboard.php");
    exit;
}
?>
