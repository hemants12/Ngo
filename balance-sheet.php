<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php 
include('config.php');
$query = "SELECT SUM(donationAmount) AS total FROM donations WHERE DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
$res = mysqli_query($link, $query);
$totalAmount = mysqli_fetch_assoc($res)['total'] ?: 0;

$query1 = "SELECT SUM(amount) AS total FROM memberships WHERE DATE(start_date) >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
$res1 = mysqli_query($link, $query1);
$totalAmount1 = mysqli_fetch_assoc($res1)['total'] ?: 0;

$query2 = "SELECT SUM(cam_amount) AS total FROM campaigns WHERE DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
$res2 = mysqli_query($link, $query2);
$totalAmount2 = mysqli_fetch_assoc($res2)['total'] ?: 0;

$yearTotal = $totalAmount + $totalAmount1 + $totalAmount2;
// print_r($yearTotal);die();

?>
<head>
<?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'New Donation')); ?>
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
                <div class="d-flex flex-column">
                    <div class="row h-100">
                        <div class="card">
                            
                        
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
