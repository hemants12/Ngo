<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include database connection
include('config.php');
require('fpdf186/fpdf.php'); 

// Check if 'id' is passed in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare SQL query using prepared statements to prevent SQL injection
    $sql = "SELECT * FROM donations WHERE id = ?";
    $stmt = $link->prepare($sql);

    // Check if the statement was prepared correctly
    if ($stmt === false) {
        die('MySQL prepare error: ' . $link->error);
    }

    // Bind the 'id' to the prepared statement
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the result contains any rows
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Create PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Donation Receipt');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Name: ' . $row['fullName'], 0, 1);
        $pdf->Cell(0, 10, 'Mobile: ' . $row['phone'], 0, 1);
        $pdf->Cell(0, 10, 'Donation Amount: ' . $row['donationAmount'], 0, 1);
        $pdf->Cell(0, 10, 'Pan Card: ' . $row['idProof'], 0, 1);
        $pdf->Cell(0, 10, 'Date: ' . $row['created_at'], 0, 1);

        // Output the PDF to the browser with the file name based on ID
        $pdf->Output('D', 'Donation_Receipt_' . $id . '.pdf'); 
    } else {
        echo "No record found for ID: " . htmlspecialchars($id);
    }

    // Close the database connection
    $stmt->close();
    $link->close();
} else {
    echo "Invalid request. ID is required and should be numeric.";
}
?>
















<?php

// include('Config.php');
// require('fpdf186/fpdf.php'); 

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];

    
//     $sql = "SELECT * FROM donations WHERE id = $id";
//     $result = $link->query($sql);

//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();

        
//         $pdf = new FPDF();
//         $pdf->AddPage();
//         $pdf->SetFont('Arial', 'B', 16);
//         $pdf->Cell(40, 10, 'Donation Receipt');
//         $pdf->Ln(10);

        
//         $pdf->SetFont('Arial', '', 12);
//         $pdf->Cell(0, 10, 'Name: ' . $row['fullName'], 0, 1);
//         $pdf->Cell(0, 10, 'Mobile: ' . $row['phone'], 0, 1);
//         $pdf->Cell(0, 10, 'Donation Amount: ' . $row['donationAmount'], 0, 1);
//         $pdf->Cell(0, 10, 'Pan Card: ' . $row['idProof'], 0, 1);
//         $pdf->Cell(0, 10, 'Date: ' . $row['created_at'], 0, 1);

//         // Output the PDF
//         $pdf->Output('D', 'Donation_Receipt_' . $id . '.pdf'); 
//     } else {
//         echo "No record found.";
//     }

    
//     $link->close();
// } else {
//     echo "Invalid request.";
// }

?>
