<?php
include('config.php');
if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update the status in the database
    $query = "UPDATE campaigns SET status = ? WHERE id = ?";
    if ($stmt = $link->prepare($query)) {
        $stmt->bind_param('si', $status, $id); // 's' for string, 'i' for integer
        if ($stmt->execute()) {
            echo "Status updated successfully!";
            header('Location: active-campaiguns.php');
        } else {
            echo "Failed to update status.";
        }
    } else {
        echo "Database query failed.";
    }

    $stmt->close();
}

$link->close();
?>