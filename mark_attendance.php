 <?php
include('Config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staff_id = $_POST['staff_id'];
    $status = $_POST['status'];
    $submitted_date = $_POST['date'];
    $current_date = date('Y-m-d');

    // Only allow marking attendance for current date
    if ($submitted_date !== $current_date) {
        echo json_encode(['success' => false, 'error' => 'Can only mark attendance for current date']);
        exit;
    }

    // Check if attendance already exists for this date and staff member
    $checkSql = "SELECT id FROM attendance WHERE staff_id = ? AND date = ?";
    $checkStmt = $link->prepare($checkSql);
    $checkStmt->bind_param("is", $staff_id, $current_date);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Update existing attendance
        $sql = "UPDATE attendance SET status = ? WHERE staff_id = ? AND date = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("sis", $status, $staff_id, $current_date);
    } else {
        // Insert new attendance record
        $sql = "INSERT INTO attendance (staff_id, date, status) VALUES (?, ?, ?)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("iss", $staff_id, $current_date, $status);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $link->error]);
    }

    $stmt->close();
    $link->close();
}
