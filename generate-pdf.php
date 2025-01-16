<?php
// Include database connection
include('Config.php');
require('fpdf186/fpdf.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "SELECT * FROM donations WHERE id = $id";
    $result = $link->query($sql);

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

        // Output the PDF
        $pdf->Output('D', 'Donation_Receipt_' . $id . '.pdf'); 
    } else {
        echo "No record found.";
    }

    // Close the database connection
    $link->close();
} else {
    echo "Invalid request.";
}

?>
