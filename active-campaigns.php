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
                    <div class="mt-3 d-flex align-items-center">
                        <label for="membershipFilter" class="me-2">Filter by Campaign Status:</label>
                        <select id="membershipFilter" class="form-select w-25 me-2">
                            <option value="">All</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <button id="filterButton" class="btn btn-primary">Filter</button>
                    </div>

                    <!-- Donation Records Table Card -->
                    <div class="card mt-5">
                        <div class="card-header text-center">
                            <h3>Campaigns History</h3>
                        </div>
                        <div class="card-body" id="campaignsContainer">
                            <?php
                            include('Config.php');
                            
                            // Fetch all campaigns
                            $sql = "SELECT * FROM campaigns";
                            $result = $link->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<div class='row'>";

                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                                    <div class='col-sm-6 col-xl-3 campaign-card' data-status='" . $row['status'] . "'>
                                        <div class='card'>
                                            <img class='card-img-top img-fluid' src='uploads/" . $row['image'] . "' alt='Card image cap' height='150' width='150'>
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

                            $link->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Filter Functionality -->
<script>
    $(document).ready(function() {
        // Initialize DataTables (if you're using it for another table)
        $('#donationTable').DataTable({
            "paging": true,
            "searching": true,
            "lengthChange": true,
            "info": true,
            "ordering": true,
            "responsive": true,
            "pageLength": 10,
            "lengthMenu": [5, 10, 25, 50, 100]
        });

        // Filter campaigns by status
        $('#filterButton').on('click', function() {
            var selectedStatus = $('#membershipFilter').val().toLowerCase();
            
            // Show or hide campaigns based on the filter
            $('.campaign-card').each(function() {
                var campaignStatus = $(this).data('status').toLowerCase();
                
                if (selectedStatus === "" || campaignStatus === selectedStatus) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

<?php include 'layouts/vendor-scripts.php'; ?>
<!-- App js -->
<script src="assets/js/app.js"></script>
</body>
