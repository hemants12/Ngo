<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Line Chart Example')); ?>
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
                                    <h4 class="card-title">Donation Trends by Month</h4>
                                    <p class="text-muted">Monthly Donation Amount</p>
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

<?php
// Fetch data from the database
$query = "SELECT MONTHNAME(created_at) AS month, SUM(donationAmount) AS total_donation 
          FROM donations 
          GROUP BY MONTH(created_at) 
          ORDER BY MONTH(created_at)";
$result = mysqli_query($link, $query);

$months = [];
$donations = [];

while ($row = mysqli_fetch_assoc($result)) {
    $months[] = $row['month']; // Get month names
    $donations[] = (float)$row['total_donation']; // Get total donations as float
}

// Convert PHP arrays to JavaScript
$months_js = json_encode($months);
$donations_js = json_encode($donations);
// print_r($months_js); die();
// print_r($donations_js); die();
?>

<script>
    // Data fetched from PHP
    const months = <?php echo $months_js; ?>; // X-axis labels
    const donations = <?php echo $donations_js; ?>; // Y-axis data

    // Chart options
    const options = {
        chart: {
            type: 'line',
            height: 350,
        },
        series: [{
            name: 'Donation Amount',
            data: donations // Use dynamic data
        }],
        xaxis: {
            categories: months, // Use dynamic months
        },
        stroke: {
            curve: 'smooth',
            width: 3,
        },
        markers: {
            size: 5,
            colors: ['#556ee6'],
            strokeColors: '#fff',
            strokeWidth: 2,
        },
        colors: ['#556ee6'],
    };

    // Render the chart
    const chart = new ApexCharts(document.querySelector("#lineChart"), options);
    chart.render();
</script>

</body>
