<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'New Donation')); ?>
    <?php include 'layouts/head-css.php'; ?>
</head>
<body>
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- Main Content Start -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="d-flex flex-column">
                    <div class="row h-100">

                        <!-- Top Donor Section -->
                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Top Donors</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Include database connection
                                    include('Config.php');

                                    // Query to get the total donations for each donor based on PAN Card Number
                                    $sql = "SELECT fullName, idProof, SUM(donationAmount) AS totalDonation
                                            FROM donations
                                            GROUP BY idProof, fullName
                                            ORDER BY totalDonation DESC";  // Order by total donation in descending order

                                    $result = $link->query($sql);

                                    if ($result->num_rows > 0) {
                                        echo "<div class='table-responsive'>
                                                <table class='table table-bordered'>
                                                    <thead>
                                                        <tr>
                                                            <th>Rank</th>
                                                            <th>Name</th>
                                                            <th>Total Donation</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";
                                        
                                        // Output data of each row
                                        $rank = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>" . $rank++ . "</td>
                                                    <td>" . $row['fullName'] . "</td>
                                                    <td>" . $row['totalDonation'] . "</td>
                                                  </tr>";
                                        }

                                        echo "</tbody>
                                            </table>
                                          </div>";
                                    } else {
                                        echo "No donations found.";
                                    }

                                    // Close the database connection
                                    $link->close();
                                    ?>
                                </div>
                            </div>
                        </div>

                    
                       

                    </div> <!-- End of Row -->
                </div> <!-- End of Flex Column -->
            </div> <!-- End of Container Fluid -->
        </div> <!-- End of Page Content -->
    </div> <!-- End of Main Content -->

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

</div> <!-- End of Layout Wrapper -->
</body>
</html>
