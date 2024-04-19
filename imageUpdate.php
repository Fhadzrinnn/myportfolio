<?php

include 'connection.php';

if (isset($_POST['submit'])) {
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    $imageType = $_FILES['image']['type'];

   // Prepare image data for database
    $stmt = $conn->prepare("INSERT INTO images (image_data, image_type) VALUES (?, ?)");
    $stmt->bind_param("ss", $imageData, $imageType);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        echo "Image uploaded successfully.";
		
    } else {
        echo "Error uploading image: " . $conn->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>
