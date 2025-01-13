<?php
include('config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $number = $_POST['number'];
    // Add other fields similarly

    // Prepare the SQL update query
    $query = "UPDATE users SET username = ?, number = ? WHERE id = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("ssi", $username, $number, $id);

    // Execute the query
    if ($stmt->execute()) {
        echo "User updated successfully.";
        // Redirect or show a success message
    } else {
        echo "Error updating user: " . $link->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$link->close();
?>
