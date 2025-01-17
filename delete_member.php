<?php
include('Config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['membership_id']) && !empty($_POST['membership_id'])) {
        $membership_id = intval($_POST['membership_id']);
        
        // Prepare the SQL delete statement
        $sql = "DELETE FROM memberships WHERE membership_id = ?";
        
        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("i", $membership_id);
            
            if ($stmt->execute()) {
                
               
                header('Location: member_list.php'); 
               
            } else {
                echo json_encode(['success' => false, 'message' => 'Error executing query.']);
            }
            
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare query.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid membership_id.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$link->close();
?>
