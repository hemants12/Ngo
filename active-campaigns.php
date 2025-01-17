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
                                echo "<div class='table-responsive'>
                                        <table id='donationTable' class='table table-bordered'>
                                            <thead>
                                                <tr>
                                                <th>Name</th>
                                                <th>type</th>
                                                <th>start_date</th>
                                                <th>end_date</th>
                                                <th>description</th>
                                                <th>target goal</th>
                                                <th>image</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['type'] . "</td>
                                            <td>" . $row['start_date'] . "</td>
                                            <td>" . $row['end_date'] . "</td>
                                            <td>" . $row['description'] . "</td>
                                            <td>" . $row['target_goal'] . "</td>
                                            
                                              <td><img src='uploads/" . $row['image'] . "' alt='' height='100' width='100'  ></td>
                                             
                                            <td>" . $row['status'] . "</td>
                                            <td>
                                                <button class='btn btn-sm btn-primary download-btn' data-id='" . $row['id'] . "'>Edit</button>
                                                <form method='POST' action='delete_donation.php' style='display:inline;'>
                                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                    <button type='submit' class='btn btn-sm btn-danger remove-item-btn' onclick='return confirm(\"Are you sure you want to delete this record?\");'>
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
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

   
</script>

<?php include 'layouts/vendor-scripts.php'; ?>
<!-- App js -->
<script src="assets/js/app.js"></script>
</body>
