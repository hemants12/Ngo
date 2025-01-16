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
                    <!-- Dropdown and Filter Button -->
                    <div class="mt-3 d-flex align-items-center">
                        <label for="membershipFilter" class="me-2">Filter by Membership Type:</label>
                        <select id="membershipFilter" class="form-select w-25 me-2">
                            <option value="">All</option>
                            <option value="Silver">Silver Plan</option>
                            <option value="Gold">Gold Plan</option>
                            <option value="Platinum">Platinum Plan</option>
                        </select>
                        <button id="filterButton" class="btn btn-primary">Filter</button>
                    </div>
                    
                    <!-- Donation Records Table Card -->
                    <div class="card mt-3">
                        <div class="card-header text-center">
                            <h3>Membership History</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            // Include database connection
                            include('Config.php');
                            
                            // Query to get all records
                            $sql = "SELECT * FROM memberships";
                            $result = $link->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<div class='table-responsive'>
                                        <table id='donationTable' class='table table-bordered'>
                                            <thead>
                                                <tr>
                                                <th>Name</th>
                                                <th>Membership Type</th>
                                                <th>Amount</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td class='membership-type'>" . $row['membership_type'] . "</td>
                                            <td>" . $row['amount'] . "</td>
                                            <td>" . $row['start_date'] ."</td>
                                            <td>" . $row['end_date'] ."</td>
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

<!-- Initialize DataTables and Filter -->
<script>
    $(document).ready(function() {
        const table = $('#donationTable').DataTable({
            "paging": true,
            "searching": true,
            "lengthChange": true,
            "info": true,
            "ordering": true,
            "responsive": true,
            "pageLength": 10,
            "lengthMenu": [5, 10, 25, 50, 100]
        });

        // Filter button logic
        $('#filterButton').on('click', function() {
            const filterValue = $('#membershipFilter').val();
            if (filterValue) {
                // Apply filter to the membership-type column
                table.columns(1).search(filterValue).draw();
            } else {
                // Clear filter
                table.columns(1).search('').draw();
            }
        });
    });
</script>

<?php include 'layouts/vendor-scripts.php'; ?>

    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/libs/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="assets/js/pages/dashboard-analytics.init.js"></script>
    <script src="assets/js/app.js"></script>
</body>
