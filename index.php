<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php
include('config.php');

// Calculate Today's total
$currentDate = date('Y-m-d');
$query = "SELECT SUM(donationAmount) AS total FROM donations WHERE DATE(created_at) = CURDATE()";
$res = mysqli_query($link, $query);
$totalAmount = mysqli_fetch_assoc($res)['total'] ?: 0;

$query1 = "SELECT SUM(amount) AS total FROM memberships WHERE DATE(start_date) = CURDATE()";
$res1 = mysqli_query($link, $query1);
$totalAmount1 = mysqli_fetch_assoc($res1)['total'] ?: 0;

$query2 = "SELECT SUM(cam_amount) AS total FROM campaigns WHERE DATE(created_at) = CURDATE()";
$res2 = mysqli_query($link, $query2);
$totalAmount2 = mysqli_fetch_assoc($res2)['total'] ?: 0;

$todayTotal = $totalAmount + $totalAmount1 + $totalAmount2;

// Calculate Last 7 Days total
$query = "SELECT SUM(donationAmount) AS total FROM donations WHERE DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
$res = mysqli_query($link, $query);
$totalAmount = mysqli_fetch_assoc($res)['total'] ?: 0;

$query1 = "SELECT SUM(amount) AS total FROM memberships WHERE DATE(start_date) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
$res1 = mysqli_query($link, $query1);
$totalAmount1 = mysqli_fetch_assoc($res1)['total'] ?: 0;

$query2 = "SELECT SUM(cam_amount) AS total FROM campaigns WHERE DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
$res2 = mysqli_query($link, $query2);
$totalAmount2 = mysqli_fetch_assoc($res2)['total'] ?: 0;

$weekTotal = $totalAmount + $totalAmount1 + $totalAmount2;

// Calculate Last 1 Month total
$query = "SELECT SUM(donationAmount) AS total FROM donations WHERE DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$res = mysqli_query($link, $query);
$totalAmount = mysqli_fetch_assoc($res)['total'] ?: 0;

$query1 = "SELECT SUM(amount) AS total FROM memberships WHERE DATE(start_date) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$res1 = mysqli_query($link, $query1);
$totalAmount1 = mysqli_fetch_assoc($res1)['total'] ?: 0;

$query2 = "SELECT SUM(cam_amount) AS total FROM campaigns WHERE DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$res2 = mysqli_query($link, $query2);
$totalAmount2 = mysqli_fetch_assoc($res2)['total'] ?: 0;

$monthTotal = $totalAmount + $totalAmount1 + $totalAmount2;

// Calculate Last 1 Year total
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

// Display the totals

// echo "<h3>Donations Summary</h3>";
// echo "Today's Donations: ₹" . number_format($todayTotal, 2) . "<br>";
// echo "This Week's Donations: ₹" . number_format($weekTotal, 2) . "<br>";
// echo "This Month's Donations: ₹" . number_format($monthTotal, 2) . "<br>";
// echo "This Year's Donations: ₹" . number_format($yearTotal, 2) . "<br>";





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $expense_type = mysqli_real_escape_string($link, $_POST['expenseReason']);
    $expense_amount = mysqli_real_escape_string($link, $_POST['expenseAmount']);
    $date = date('Y-m-d');

    // Calculate the total amount (already fetched in the main page)
    $query_total = "SELECT 
            (SELECT IFNULL(SUM(donationAmount), 0) FROM donations WHERE DATE(created_at) = CURDATE()) +
            (SELECT IFNULL(SUM(amount), 0) FROM memberships WHERE DATE(start_date) = CURDATE()) +
            (SELECT IFNULL(SUM(cam_amount), 0) FROM campaigns WHERE DATE(created_at) = CURDATE()) 
            AS total";
    $result = mysqli_query($link, $query_total);
    $row = mysqli_fetch_assoc($result);
    $total_collected_today = $row['total'];

    // Check if an entry for today's date exists
    $checkQuery = "SELECT expense_type, expense_amount FROM tbl_expense WHERE date = ?";
    $checkStmt = $link->prepare($checkQuery);
    $checkStmt->bind_param("s", $date);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // If entry exists, update the record
        $existingData = $checkResult->fetch_assoc();
        $existingExpenseType = $existingData['expense_type'];
        $existingExpenseAmount = $existingData['expense_amount'];

        // Append new expense type to the existing one
        $updatedExpenseType = $existingExpenseType . ', ' . $expense_type;

        // Update the record
        $updateQuery = "UPDATE tbl_expense SET 
                expense_type = ?, 
                total_amount = ?, 
                expense_amount = expense_amount + ? 
                WHERE date = ?";
        $updateStmt = $link->prepare($updateQuery);
        $updateStmt->bind_param("sdds", $updatedExpenseType, $total_collected_today, $expense_amount, $date);

        if ($updateStmt->execute()) {
            $_SESSION['success'] = "Your expense has been successfully updated.";
        } else {
            echo "Error: " . $updateStmt->error;
        }
        $updateStmt->close();
    } else {
        // If no entry exists, insert a new record
        $insertQuery = $link->prepare("INSERT INTO tbl_expense (expense_type, total_amount, expense_amount, date) VALUES (?, ?, ?, ?)");
        $insertQuery->bind_param("sdds", $expense_type, $total_collected_today, $expense_amount, $date);
        if ($insertQuery->execute()) {
            $_SESSION['success'] = "Your expense has been successfully submitted.";
        } else {
            echo "Error: " . $insertQuery->error;
        }
        $insertQuery->close();
    }

    // Clean up
    $checkStmt->close();
    mysqli_close($link);
}





//   tbl_expense fetch 

$query = "SELECT SUM(expense_amount) as total_expense FROM tbl_expense";
$result = mysqli_query($link, $query);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $totalExpense = $row['total_expense'];

    // Calculate the remaining amount
    $remainingAmount = $yearTotal - $totalExpense;
} else {
    $remainingAmount = $yearTotal; // If no expense is found
}




$sql = "
    SELECT 
        COUNT(*) AS total_memberships,
        SUM(CASE WHEN membership_type = 'Silver' THEN 1 ELSE 0 END) AS silver_count,
        SUM(CASE WHEN membership_type = 'Gold' THEN 1 ELSE 0 END) AS gold_count,
        SUM(CASE WHEN membership_type = 'Platinum' THEN 1 ELSE 0 END) AS platinum_count
    FROM memberships";

$result = $link->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $silverCount = $row['silver_count'];
    $goldCount = $row['gold_count'];
    $platinumCount = $row['platinum_count'];
} else {
    $silverCount = $goldCount = $platinumCount = 0;
}

?>
<script>
    $(document).ready(function() {

        $("#datePicker").datepicker({
            dateFormat: 'yy-mm-dd', // Format for MySQL
            onSelect: function(selectedDate) {

                fetchTotalAmount(selectedDate);
            }
        });

        function fetchTotalAmount(date) {
            $.ajax({
                url: "fetch_total_amount.php",
                type: "POST",
                data: {
                    date: date
                },
                success: function(response) {
                    $("#totalAmount").html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching total amount: " + error);
                }
            });
        }
    });
</script>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Dashboard')); ?>
    <!-- plugin css -->
    <link href="assets/libs/jsvectormap/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <?php include 'layouts/head-css.php'; ?>
    <style>
        /* Hover effect for donation columns */
        .donation-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .donation-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>



    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-5">
                            <div class="d-flex flex-column ">
                                <div class="row h-100">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="row align-items-end">
                                                    <div class="col-sm-8">
                                                        <div class="p-4">
                                                            <p class="fs-16 lh-base">Your free trial expired in <span class="fw-semibold">17 days.</span> <i class="mdi mdi-arrow-right"></i></p>
                                                            <div class="mt-3"><a href="pages-pricing.php" class="btn btn-success">Upgrade Account!</a></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="px-3">
                                                            <img src="assets/images/user-illustarator-2.png" class="img-fluid" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end card-body-->
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row-->



                            <!-- Donation Cards Section -->
                            <div class="row">
                                <!-- Card 1 -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate donation-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Today Donation <br>Collected</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹ <?php echo number_format($todayTotal); ?></h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                                        <i class="fas fa-donate text-success"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- Card 2 -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate donation-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">This Week's <br>Donations</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹ <?php echo number_format($weekTotal); ?></h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                        <i class="fas fa-hand-holding-usd text-warning"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3 -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate donation-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">This Month's <br>Donations</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹ <?php echo number_format($monthTotal); ?></h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-info-subtle rounded fs-3">
                                                        <i class="fas fa-coins text-info"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 4 -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate donation-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Yearly <br>Donations</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹ <?php echo number_format($yearTotal); ?></h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-danger-subtle rounded fs-3">
                                                        <i class="fas fa-wallet text-danger"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end row -->




                            <div class="row">
                                <!-- First Column with 2 Cards -->
                              
                                    <!-- First Card in First Column -->
                                    <div class="col-xl-3 col-md-6">
                                        <div class="card card-animate donation-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Available  <br>Balance</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4"style="margin-bottom: 13px;">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary " >₹ <?php echo number_format($remainingAmount); ?></h4>

                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                                            <i class="fas fa-donate text-success"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Second Card in First Column -->
                                    <div class="col-xl-3 col-md-6">
                                        <div class="card card-animate donation-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Active <br>Member</p>
                                                     
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-1">
                                                    <div>
                                                        <h4 class="fs-16 fw-semibold ff-secondary "> Silver <span class="d-flex align-items-end" > <?php echo $silverCount; ?></span></h4>
                                                        <h4 class="fs-16 fw-semibold ff-secondary "> Gold<?php echo $goldCount; ?></h4>
                                                        <h4 class="fs-16 fw-semibold ff-secondary "> Platinum<?php echo $platinumCount; ?></h4>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                                            <i class="fas fa-donate text-success"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               

                                <!-- Second Column -->
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title mb-0">Profit & Loss Summary</h4>
                                        </div><!-- end card header -->
                                        <div class="card-body">
                                            <div class="row">
                                                <!-- Income Section -->
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-0">Income</p>
                                                        <h5 class="mb-0 text-primary">₹ 80,000</h5> <!-- Dummy value -->
                                                    </div>
                                                </div>
                                                <!-- Expenses Section -->
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-0">Expenses</p>
                                                        <h5 class="mb-0 text-danger">₹ 30,000</h5> <!-- Dummy value -->
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <p class="mb-0">Net Profit/Loss</p>
                                                <h5 class="mb-0 text-success">₹ 50,000</h5> <!-- Dummy value (Income - Expenses) -->
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end second column -->
                            </div><!-- end row -->


                            <!-- Add the following CSS for styling -->
                            <style>
                                .text-success {
                                    color: #28a745 !important;
                                }

                                .text-danger {
                                    color: #dc3545 !important;
                                }

                                .text-primary {
                                    color: #007bff !important;
                                }

                                .text-info {
                                    color: #17a2b8 !important;
                                }

                                .text-warning {
                                    color: #ffc107 !important;
                                }
                            </style>








                        </div><!-- container-fluid -->
                    </div><!-- End Page-content -->
                </div><!-- end main content-->
            </div><!-- END layout-wrapper -->

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
</body>

</html>