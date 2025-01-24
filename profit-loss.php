<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>


<?php
include('config.php');
// Initialize totals
$total_donations = 0;
$total_campaigns = 0;
$total_memberships = 0;
$total_other = 0;

// Donations Total
$donationQuery = "SELECT IFNULL(SUM(donationAmount), 0) AS total_donations FROM donations";
$result = $link->query($donationQuery);
if ($result) {
    $row = $result->fetch_assoc();
    $total_donations = $row['total_donations'];
}

// Campaigns Total
$campaignQuery = "SELECT IFNULL(SUM(cam_amount), 0) AS total_campaigns FROM campaigns";
$result = $link->query($campaignQuery);
if ($result) {
    $row = $result->fetch_assoc();
    $total_campaigns = $row['total_campaigns'];
}

// Memberships Total
$membershipQuery = "SELECT IFNULL(SUM(amount), 0) AS total_memberships FROM memberships";
$result = $link->query($membershipQuery);
if ($result) {
    $row = $result->fetch_assoc();
    $total_memberships = $row['total_memberships'];
}

// Other Income Total
$otherQuery = "SELECT IFNULL(SUM(otheramount), 0) AS total_other FROM other";
$result = $link->query($otherQuery);
if ($result) {
    $row = $result->fetch_assoc();
    $total_other = $row['total_other'];
}

// Calculate Grand Total
$grand_total = $total_donations + $total_campaigns + $total_memberships + $total_other;
?>

<head>
   
    <?php include 'layouts/head-css.php'; ?>

    <!-- ApexCharts Library -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

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
                        <div class="col-md-12">
                            <!-- Line Chart Card -->
                            <div class="card">
                                <div class="card-header">
                                <div class="container mt-5">
        <h2 class="text-center">Balance Sheet</h2>
        <table class="table table-bordered table-striped mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Source</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Donations</td>
                    <td><?php echo number_format($total_donations, 2); ?> </td>
                </tr>
                <tr>
                    <td>Campaigns</td>
                    <td><?php echo number_format($total_campaigns, 2); ?> </td>
                </tr>
                <tr>
                    <td>Memberships</td>
                    <td><?php echo number_format($total_memberships, 2); ?> </td>
                </tr>
                <tr>
                    <td>Other Income</td>
                    <td><?php echo number_format($total_other, 2); ?> </td>
                </tr>
                <tr class="table-primary">
                    <th>Grand Total</th>
                    <th><?php echo number_format($grand_total, 2); ?></th>
                </tr>
            </tbody>
        </table>
    </div>
                                   
                                </div>
                                <div class="card-body">
                                    <div id="lineChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/vendor-scripts.php'; ?>



</body>
