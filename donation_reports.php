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
                        <!-- Donation Amount Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Donation Trends by Month 2025</h4>
                                    <p class="text-muted">Monthly Donation Amount</p>
                                </div>
                                <div class="card-body">
                                    <div id="donationAmountChart"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Users Count Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Donor Trends by Month 2025</h4>
                                    <p class="text-muted">Monthly Number of Donors</p>
                                </div>
                                <div class="card-body">
                                    <div id="donorCountChart"></div>
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
// Fetch donation amount data
$query1 = "SELECT MONTHNAME(created_at) AS month, SUM(donationAmount) AS total_donation 
           FROM donations 
           GROUP BY MONTH(created_at) 
           ORDER BY MONTH(created_at)";
$result1 = mysqli_query($link, $query1);

$months1 = [];
$donations = [];

while ($row = mysqli_fetch_assoc($result1)) {
    $months1[] = $row['month'];
    $donations[] = (float)$row['total_donation'];
}

// Fetch donor count data
$query2 = "SELECT MONTHNAME(created_at) AS month, COUNT(id) AS donor_count 
           FROM donations 
           GROUP BY MONTH(created_at) 
           ORDER BY MONTH(created_at)";
$result2 = mysqli_query($link, $query2);

$months2 = [];
$donorCounts = [];

while ($row = mysqli_fetch_assoc($result2)) {
    $months2[] = $row['month'];
    $donorCounts[] = (int)$row['donor_count'];
}

// Convert PHP arrays to JavaScript
$months1_js = json_encode($months1);
$donations_js = json_encode($donations);

$months2_js = json_encode($months2);
$donorCounts_js = json_encode($donorCounts);
?>

<script>
    // Donation Amount Chart Data
    const months1 = <?php echo $months1_js; ?>;
    const donations = <?php echo $donations_js; ?>;

    const options1 = {
        chart: {
            type: 'line',
            height: 350,
        },
        series: [{
            name: 'Donation Amount',
            data: donations
        }],
        xaxis: {
            categories: months1,
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

    // Render Donation Amount Chart
    const chart1 = new ApexCharts(document.querySelector("#donationAmountChart"), options1);
    chart1.render();

    // Donor Count Chart Data
    const months2 = <?php echo $months2_js; ?>;
    const donorCounts = <?php echo $donorCounts_js; ?>;

    const options2 = {
        chart: {
            type: 'line',
            height: 350,
        },
        series: [{
            name: 'Donor Count',
            data: donorCounts
        }],
        xaxis: {
            categories: months2,
        },
        stroke: {
            curve: 'smooth',
            width: 3,
        },
        markers: {
            size: 5,
            colors: ['#34c38f'],
            strokeColors: '#fff',
            strokeWidth: 5,
        },
        colors: ['#34c38f'],
    };

    // Render Donor Count Chart
    const chart2 = new ApexCharts(document.querySelector("#donorCountChart"), options2);
    chart2.render();
</script>

<!-- ApexCharts Library -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
</body>
