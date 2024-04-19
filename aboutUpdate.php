<?php
include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["about"]) && !empty($_POST["about"])) {
        $about = htmlspecialchars($_POST["about"]);
				include_once 'connection.php';
   
         $sql = "UPDATE about SET about_text = ? WHERE id = ?";

        // Prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $about, $id);

        // Set $id to the ID of the row you want to update
        $id = 1; // Change this to the appropriate ID

        // Execute the statement
        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "About cannot be empty";
    }
} else {
    // If someone tries to access this script directly
    echo "Access denied";
}
?>
