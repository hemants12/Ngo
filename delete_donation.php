<?php
include('Config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = intval($_POST['id']);

        // Prepare the SQL delete statement
        $sql = "DELETE FROM donations WHERE id = ?";

        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {


                header('Location: donation-history.php');
            } else {
                echo json_encode(['success' => false, 'message' => 'Error executing query.']);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare query.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$link->close();
