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
                            <h3>campaigns History</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            // Include database connection
                            include('Config.php');
                            
                            // Query to get all records
                            $sql = "SELECT * FROM campaigns";
                            $result = $link->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<div class='row'>";
                                
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                                    <div class='col-sm-6 col-xl-3'>
                                        <div class='card'>
                                            <img class='card-img-top img-fluid' src='uploads/". $row['image'] ."' alt='Card image cap'height='150' width='150'>
                                          

                                            <div class='card-body'>
                                                <h4 class='card-title mb-2'>" . $row['type'] . "</h4>
                                                <p class='card-text mb-0'>" . $row['description'] . "</p>
                                            </div>
                                            <div class='card-footer'>
                                                <a href='javascript:void(0);' class='card-link link-secondary'>Read More <i class='ri-arrow-right-s-line ms-1 align-middle lh-1'></i></a>
                                                <a href='javascript:void(0);' class='card-link link-success'>Bookmark <i class='ri-bookmark-line align-middle ms-1 lh-1'></i></a>
                                            </div>
                                        </div><!-- end card -->
                                    </div><!-- end col -->";
                                }

                                echo "</div>";  // Close the row div
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
</script>

<?php include 'layouts/vendor-scripts.php'; ?>
<!-- App js -->
<script src="assets/js/app.js"></script>
</body>
