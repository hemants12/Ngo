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
<!-- jQuery UI for Datepicker -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<?php include('config.php'); ?>

<?php
// Default current date for the total amount calculation
$currentDate = date('Y-m-d');

// Fetch the total amount for the current date
$query = "SELECT * FROM donations WHERE DATE(created_at) = CURDATE()";
$res = mysqli_query($link, $query);

        // Initialize total amount variable for donations
        $totalAmount = 0;

        // Fetch the donations and calculate the total amount
        while ($data = mysqli_fetch_assoc($res)) {
            $totalAmount += $data['donationAmount'];
        }

        // SQL query to get memberships for today
        $query1 = "SELECT * FROM memberships WHERE DATE(start_date) = CURDATE()";
        $res1 = mysqli_query($link, $query1);

        // Initialize total amount variable for memberships
        $totalAmount1 = 0;

        // Fetch the memberships and calculate the total amount
        while ($data1 = mysqli_fetch_assoc($res1)) {
            $totalAmount1 += $data1['amount'];
        }

// Fetch campaigns for today
$query2 = "SELECT * FROM campaigns WHERE DATE(created_at) = CURDATE()";
$res2 = mysqli_query($link, $query2);

// Initialize total amount variable for campaigns
$totalAmount2 = 0;

// Fetch the campaigns and calculate the total amount
while ($data2 = mysqli_fetch_assoc($res2)) {
    $totalAmount2 += $data2['cam_amount'];
}

// Total amount for today
$total = $totalAmount + $totalAmount1 + $totalAmount2;
?>

<script>
$(document).ready(function() {
    // Initialize the date picker
    $("#datePicker").datepicker({
        dateFormat: 'yy-mm-dd', // Format for MySQL
        onSelect: function(selectedDate) {
            // Fetch and update the total amount when the date is selected
            fetchTotalAmount(selectedDate);
        }
    });

    // Function to fetch and update the total amount based on the selected date
    function fetchTotalAmount(date) {
        $.ajax({
            url: "fetch_total_amount.php", // PHP file to handle the date and query
            type: "POST",
            data: { date: date },
            success: function(response) {
                // Update the total amount
                $("#totalAmount").html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching total amount: " + error);
            }
        });
    }
});
</script>

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
                            <div class="alert alert-info mt-3 d-flex justify-content-between align-items-center">
                                <h4>Total Amount Today: 
                                    <strong id="totalAmount"><?php echo number_format($total, 2); ?></strong>
                                </h4>
                                <!-- Date Picker to the right of "Total Amount Today" -->
                                <input type="text" id="datePicker" placeholder="Select Date" class="form-control" style="width: 150px;">
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
