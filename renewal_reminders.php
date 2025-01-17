<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Reminder')); ?>
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
                    <!-- Reminder Table Card -->
                    <div class="card mt-3">
                        <div class="card-header text-center">
                            <h3>Upcoming Expirations (Next 10 Days)</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            // Include database connection
                            include('Config.php');
                            
                            // Current date
                            $currentDate = date('Y-m-d');
                            
                            // Query to get records expiring within 10 days
                            $sql = "SELECT * FROM memberships 
                                    WHERE end_date BETWEEN '$currentDate' AND DATE_ADD('$currentDate', INTERVAL 10 DAY)";
                            $result = $link->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<div class='table-responsive'>
                                        <table id='reminderTable' class='table table-bordered'>
                                            <thead>
                                                <tr>
                                                <th>Name</th>
                                                <th>Membership Type</th>
                                                <th>Amount</th>
                                                <th>End Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['membership_type'] . "</td>
                                            <td>" . $row['amount'] . "</td>
                                            <td>" . $row['end_date'] . "</td>
                                          </tr>";
                                }

                                echo "</tbody>
                                    </table>
                                  </div>";
                            } else {
                                echo "<p class='text-center'>No upcoming expirations within the next 10 days.</p>";
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
        $('#reminderTable').DataTable({
            "paging": true,
            "searching": true,
            "lengthChange": true,
            "info": true,
            "ordering": true,
            "responsive": true,
            "pageLength": 10,
            "lengthMenu": [5, 10, 25, 50, 100]
        });
    });
</script>

<?php include 'layouts/vendor-scripts.php'; ?>
</body>
