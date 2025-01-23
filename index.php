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
$currentMonth = date('m'); // Current month (01-12)
$currentYear = date('Y');  // Current year (e.g., 2025)

// Query to fetch total donation amount for the current month
$query = "
    SELECT SUM(donationAmount) AS total 
    FROM donations 
    WHERE MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear";
$res = mysqli_query($link, $query);
$totalAmount = mysqli_fetch_assoc($res)['total'] ?: 0;

// Query to fetch total membership amount for the current month
$query1 = "
    SELECT SUM(amount) AS total 
    FROM memberships 
    WHERE MONTH(start_date) = $currentMonth AND YEAR(start_date) = $currentYear";
$res1 = mysqli_query($link, $query1);
$totalAmount1 = mysqli_fetch_assoc($res1)['total'] ?: 0;

// Query to fetch total campaign amount for the current month
$query2 = "
    SELECT SUM(cam_amount) AS total 
    FROM campaigns 
    WHERE MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear";
$res2 = mysqli_query($link, $query2);
$totalAmount2 = mysqli_fetch_assoc($res2)['total'] ?: 0;

// Calculate total amount for the current month
$monthTotal = $totalAmount + $totalAmount1 + $totalAmount2;

// Display the total for the current month








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






$currentMonth = date('m');
$currentYear = date('Y');

// Query to fetch total donation amount for the current month
$donationQuery = "
    SELECT SUM(donationAmount) AS total_donations
    FROM donations
    WHERE MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear";
$donationResult = $link->query($donationQuery);
$donationRow = $donationResult->fetch_assoc();
$totalDonations = $donationRow['total_donations'] ? $donationRow['total_donations'] : 0;


// Query to fetch total membership amount for the current month
$membershipQuery = "
    SELECT SUM(amount) AS total_memberships
    FROM memberships
    WHERE MONTH(start_date) = $currentMonth AND YEAR(start_date) = $currentYear";
$membershipResult = $link->query($membershipQuery);
$membershipRow = $membershipResult->fetch_assoc();
$totalMemberships = $membershipRow['total_memberships'] ? $membershipRow['total_memberships'] : 0;

// Query to fetch total campaign amount for the current month
$campaignQuery = "
    SELECT SUM(cam_amount) AS total_campaigns
    FROM campaigns
    WHERE MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear";
$campaignResult = $link->query($campaignQuery);
$campaignRow = $campaignResult->fetch_assoc();
$totalCampaigns = $campaignRow['total_campaigns'] ? $campaignRow['total_campaigns'] : 0;


// Calculate the total amount
$totalAmountincome = $totalDonations + $totalMemberships + $totalCampaigns;







$currentMonth = date('m');
$currentYear = date('Y');

// Query to fetch total expenses for the current month
$expenseQuery = "
    SELECT SUM(expense_amount) AS total_expenses
    FROM tbl_expense
    WHERE MONTH(date) = $currentMonth AND YEAR(date) = $currentYear";
$expenseResult = $link->query($expenseQuery);

if ($expenseResult->num_rows > 0) {
    $expenseRow = $expenseResult->fetch_assoc();
    $totalExpenses = $expenseRow['total_expenses'] ? $expenseRow['total_expenses'] : 0;
} else {
    $totalExpenses = 0;
}



$remainingBalance = $totalAmountincome - $totalExpenses;
?>
<script>
    $(document).ready(function () {

        $("#datePicker").datepicker({
            dateFormat: 'yy-mm-dd', // Format for MySQL
            onSelect: function (selectedDate) {

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
                success: function (response) {
                    $("#totalAmount").html(response);
                },
                error: function (xhr, status, error) {
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
                                                        <p class="fs-16 lh-base">Your free trial expired in <span
                                                                class="fw-semibold">17 days.</span> <i
                                                                class="mdi mdi-arrow-right"></i></p>
                                                        <div class="mt-3"><a href="pages-pricing.php"
                                                                class="btn btn-success">Upgrade Account!</a></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="px-3">
                                                        <img src="assets/images/user-illustarator-2.png"
                                                            class="img-fluid" alt="">
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
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Today
                                                    Donation <br>Collected</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹
                                                    <?php echo number_format($todayTotal); ?></h4>
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
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">This
                                                    Week's <br>Donations</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹
                                                    <?php echo number_format($weekTotal); ?></h4>
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
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">This
                                                    Month's <br>Donations</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹
                                                    <?php echo number_format($monthTotal); ?></h4>
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
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total
                                                    Yearly <br>Donations</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹
                                                    <?php echo number_format($yearTotal); ?></h4>
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
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total
                                                    Available <br>Balance</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4"
                                            style="margin-bottom: 13px;">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary ">₹
                                                    <?php echo number_format($remainingAmount); ?></h4>

                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-primary rounded fs-3">
                                                <i class="fas fa-hand-holding-usd text-light"></i>
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
                                            <div class="align-items-end justify-content-between mt-1">
                                                <div>
                                                    <div class="d-flex justify-content-between">
                                                        <h4 class="fs-16 fw-semibold ff-secondary">Silver</h4>
                                                        <h4 class="fs-16 fw-semibold ff-secondary">
                                                            <?php echo $silverCount; ?></h4>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <h4 class="fs-16 fw-semibold ff-secondary">Gold</h4>
                                                        <h4 class="fs-16 fw-semibold ff-secondary"><?php echo $goldCount; ?>
                                                        </h4>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <h4 class="fs-16 fw-semibold ff-secondary">Platinum</h4>
                                                        <h4 class="fs-16 fw-semibold ff-secondary">
                                                            <?php echo $platinumCount; ?></h4>
                                                    </div>
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
                                                        <h5 class="mb-0 text-primary">₹<?php echo number_format($totalAmountincome); ?></h5> <!-- Dummy value -->
                                                    </div>
                                                </div>
                                                <!-- Expenses Section -->
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-0">Expenses</p>
                                                        <h5 class="mb-0 text-danger">₹ <?php echo number_format($totalExpenses); ?></h5> <!-- Dummy value -->
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <p class="mb-0">Net Profit/Loss</p>
                                                <h5 class="mb-0 text-success">₹ <?php echo number_format($remainingBalance); ?></h5> <!-- Dummy value (Income - Expenses) -->
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end second column -->
                            </div><!-- end row -->
                                </div>
                            </div>


    
                           

                            <div class="row">
                                <!-- First Column with 2 Cards -->
                              
                                    <!-- First Card in First Column -->
                                    <div class="col-xl-3 col-md-6">
                                        <div class="card card-animate donation-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Amount Raised <br>By Campaign</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4"style="margin-bottom: 13px;">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary " >₹ <?php echo number_format($remainingAmount); ?></h4>

                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                        <i class="fas fa-chart-line text-warning"></i>
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
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">This Month <br>Donors</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4"style="margin-bottom: 13px;">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary " >₹ <?php echo number_format($remainingAmount); ?></h4>

                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                                            <i class="fas fa-users text-success"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <!-- Second Column -->
                                <div class="col-xl-6 col-md-6">
                                        <div class="card card-animate donation-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Highest Amount <br>Donor This Month</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4"style="margin-bottom: 13px;">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary " >Mr. Satender Saini</h4>

                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title  rounded fs-3">
                                                        ₹  1
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div><!-- end row -->
                    
    <!-- d-->
    <div class="row">
    <!-- Top 5 Donors Section -->
    <div class="col-xl-6">
        <div class="card h-100">
            <div class="card-header">
                <h4 class="card-title mb-0">Top 5 Donors</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Donor Name</th>
                                <th>Donation Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Example donor data
                            $topDonors = [
                                ['name' => 'John Doe', 'amount' => '₹ 5000'],
                                ['name' => 'Jane Smith', 'amount' => '₹ 4500'],
                                ['name' => 'Alex Johnson', 'amount' => '₹ 4000'],
                                ['name' => 'Emily Davis', 'amount' => '₹ 3500'],
                                ['name' => 'Michael Brown', 'amount' => '₹ 3000']
                            ];

                            foreach ($topDonors as $index => $donor) {
                                echo "<tr>
                                        <td>" . ($index + 1) . "</td>
                                        <td>{$donor['name']}</td>
                                        <td>{$donor['amount']}</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <!-- Active Campaigns and Progress Section -->
    <div class="col-xl-6">
        <div class="card h-100">
            <div class="card-header">
                <h4 class="card-title mb-0">Active Campaigns and Their Progress</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Campaign Name</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Example campaign data
                            $activeCampaigns = [
                                ['name' => 'School Supplies Fund', 'progress' => 75],
                                ['name' => 'Community Healthcare', 'progress' => 60],
                                ['name' => 'Clean Water Project', 'progress' => 90],
                                ['name' => 'Food Drive', 'progress' => 45],
                                ['name' => 'Orphanage Support', 'progress' => 50],
                                ['name' => 'Elderly Care', 'progress' => 65]
                            ];

                            foreach ($activeCampaigns as $index => $campaign) {
                                echo "<tr>
                                        <td>" . ($index + 1) . "</td>
                                        <td>{$campaign['name']}</td>
                                        <td>
                                            <div class='progress'>
                                                <div class='progress-bar' role='progressbar' style='width: {$campaign['progress']}%;' aria-valuenow='{$campaign['progress']}' aria-valuemin='0' aria-valuemax='100'>
                                                    {$campaign['progress']}%
                                                </div>
                                            </div>
                                        </td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- end table-responsive -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row mt-4">
    <!-- Active Campaigns and Progress Section -->
    <div class="col-xl-6">
        <div class="card h-100">
            <div class="card-header">
                <h4 class="card-title mb-0">Active Campaigns and Their Progress</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Campaign Name</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Example campaign data
                            $activeCampaigns = [
                                ['name' => 'School Supplies Fund', 'progress' => 75],
                                ['name' => 'Community Healthcare', 'progress' => 60],
                                ['name' => 'Clean Water Project', 'progress' => 90],
                                ['name' => 'Food Drive', 'progress' => 45],
                                ['name' => 'Orphanage Support', 'progress' => 50],
                                ['name' => 'Elderly Care', 'progress' => 65]
                            ];

                            foreach ($activeCampaigns as $index => $campaign) {
                                echo "<tr>
                                        <td>" . ($index + 1) . "</td>
                                        <td>{$campaign['name']}</td>
                                        <td>
                                            <div class='progress'>
                                                <div class='progress-bar' role='progressbar' style='width: {$campaign['progress']}%;' aria-valuenow='{$campaign['progress']}' aria-valuemin='0' aria-valuemax='100'>
                                                    {$campaign['progress']}%
                                                </div>
                                            </div>
                                        </td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- end table-responsive -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
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