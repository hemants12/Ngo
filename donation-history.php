<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'New Donation')); ?>
    <?php include 'layouts/head-css.php'; ?>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div id="layout-wrapper">
<?php include 'layouts/menu.php'; ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <div class="row h-100">
                    <!-- Donation Records Table Card -->
                    <div class="card mt-5">
                        <div class="card-header text-center">
                            <h3>Donation History</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            // Include database connection
                            include('Config.php');
                            
                            // Query to get all records
                            $sql = "SELECT * FROM donations";
                            $result = $link->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<div class='table-responsive'>
                                        <table id='donationTable' class='table table-bordered'>
                                            <thead>
                                                <tr>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Donation Amount</th>
                                                <th>Pan Card</th>
                                                <th>Date</th>
                                                <th>Download</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>";
                                
                                // Output data of each row
                                // $serial = 1;  
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            
                                            <td>" . $row['fullName'] . "</td>
                                            <td>" . $row['phone'] . "</td>
                                            <td>" . $row['donationAmount'] . "</td>
                                            <td>" . $row['idProof'] . "</td>
                                            <td>" . $row['created_at'] ."</td>
                                               <td><button class='download-btn' data-id='" . $row['id'] . "'>Download</button></td>
                                            
                                          </tr>";
                                }

                                echo "</tbody>
                                    </table>
                                  </div>";
                            } else {
                                echo "No records found.";
                            }

                            // Close the database connection
                            $link->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#donationTable').DataTable({
            "paging": true,           // Enable pagination
            "searching": true,        // Enable search bar
            "lengthChange": true,     // Allow changing number of rows displayed
            "info": true,             // Show table info
            "ordering": true,         // Enable sorting
            "responsive": true,       // Make table responsive
            "pageLength": 10,         // Default number of rows
            "lengthMenu": [5, 10, 25, 50, 100] // Options for rows per page
        });
    });
    
    $(document).on('click', '.download-btn', function() {
        const id = $(this).data('id');
        if (id) {
            // Redirect to the PHP script for PDF generation
            window.location.href = 'generate-pdf.php?id=' + id;
        }
    });


</script>

<?php include 'layouts/vendor-scripts.php'; ?>
    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Vector map -->
    <script src="assets/libs/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>
    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-analytics.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>
