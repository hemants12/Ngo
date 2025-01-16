<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'New Donation')); ?>
    <?php include 'layouts/head-css.php'; ?>
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
    $sql = "SELECT id, fullName, phone, created_at , donationAmount FROM donations";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='table-responsive'> <!-- Make the table responsive -->
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Donation Amount</th>
                             <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>";
        
        // Output data of each row
        $serial = 1;  // Start Serial No from 1
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $serial++ . "</td>
                    <td>" . $row['fullName'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['donationAmount'] . "</td>
                    <td>" . $row['created_at'] . "</td>
                  </tr>";
        }

        echo "</tbody>
            </table>
          </div>";  // Close the table-responsive div
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

<script>
    document.getElementById('donationAmount').addEventListener('change', function() {
        if (this.value === 'other') {
            document.getElementById('otherAmountDiv').style.display = 'block';
        } else {
            document.getElementById('otherAmountDiv').style.display = 'none';
        }
    });
</script>
<?php include 'layouts/vendor-scripts.php'; ?>
    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>
    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-analytics.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</div>
</body>
