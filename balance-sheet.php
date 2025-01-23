<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php
include('config.php');

// Calculate total donations within the last year
$query = "SELECT SUM(donationAmount) AS total FROM donations WHERE DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
$res = mysqli_query($link, $query);
$totalAmount = mysqli_fetch_assoc($res)['total'] ?: 0;

// Calculate total membership payments within the last year
$query1 = "SELECT SUM(amount) AS total FROM memberships WHERE DATE(start_date) >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
$res1 = mysqli_query($link, $query1);
$totalAmount1 = mysqli_fetch_assoc($res1)['total'] ?: 0;

// Calculate total campaign contributions within the last year
$query2 = "SELECT SUM(cam_amount) AS total FROM campaigns WHERE DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
$res2 = mysqli_query($link, $query2);
$totalAmount2 = mysqli_fetch_assoc($res2)['total'] ?: 0;

// Calculate the overall total for the year
$yearTotal = $totalAmount + $totalAmount1 + $totalAmount2;
?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Financial Year Balance Sheet')); ?>
    <?php include 'layouts/head-css.php'; ?>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <!-- jQuery UI for Datepicker -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <?php include('config.php'); ?>
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Balance Sheet Title -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h4 class="mb-3">Financial Year Balance Sheet</h4>
                        </div>
                    </div>

                    <!-- Balance Sheet Cards -->
                    <div class="row">
                        <!-- Donations Card -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Donations</h5>
                                    <p class="card-text">₹<?php echo number_format($totalAmount, 2); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Memberships Card -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Memberships</h5>
                                    <p class="card-text">₹<?php echo number_format($totalAmount1, 2); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Campaigns Card -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Campaigns</h5>
                                    <p class="card-text">₹<?php echo number_format($totalAmount2, 2); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Year Total Card -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Year Total</h5>
                                    <p class="card-text">₹<?php echo number_format($yearTotal, 2); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
