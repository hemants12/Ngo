<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<?php
include('config.php');

// Calculate Today's total
$currentDate = date('Y-m-d');
$query = "SELECT SUM(donationAmount) AS total FROM donations WHERE DATE(created_at) = CURDATE()";
$res = mysqli_query($link, $query);
$totalAmount = mysqli_fetch_assoc($res)['total'] ?: 0;
$todayTotal = $totalAmount;


// Calculate Last 7 Days total
// $query = "SELECT SUM(donationAmount) AS total FROM donations WHERE DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
// $res = mysqli_query($link, $query);
// $totalAmount = mysqli_fetch_assoc($res)['total'] ?: 0;
// $weekTotal = $totalAmount;


$query = "SELECT SUM(donationAmount) AS total 
          FROM donations 
          WHERE DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
            AND DATE(created_at) <= CURDATE()";
$res = mysqli_query($link, $query);

if (!$res) {
    die("Query Error: " . mysqli_error($link)); 
}

$weekTotal = mysqli_fetch_assoc($res)['total'] ?: 0;



// print_r($weekTotal);die()


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
$monthTotal = $totalAmount;


// Calculate Last 1 Year total


// Updated Query
// $query = "SELECT SUM(donationAmount) AS total FROM donations WHERE created_at BETWEEN '$start_date' AND '$end_date'";
// $result = mysqli_query($link, $query);
// $row = mysqli_fetch_assoc($result);
// $total = $row['total'];
// print_r($total); die();




// Calculate Last 1 Year total  

$start_date = date('Y-04-01', strtotime(date('Y') . '-04-01'));
$end_date = date('Y-03-31', strtotime(date('Y') . '-04-01 +1 year'));

if (date('m') < 4) {
    // For months January, February, March
    $start_date = date('Y-04-01', strtotime(date('Y') . '-04-01 -1 year'));
    $end_date = date('Y-03-31', strtotime(date('Y') . '-03-31'));
}
$query3 = "SELECT SUM(donationAmount) AS total FROM donations WHERE created_at BETWEEN '$start_date' AND '$end_date'";
$res3 = mysqli_query($link, $query3);
$totalAmount3 = mysqli_fetch_assoc($res3)['total'] ?: 0;
// $query = "SELECT SUM(donationAmount) AS total FROM donations WHERE created_at BETWEEN '$start_date' AND '$end_date'";
$query1 = "SELECT SUM(amount) AS total FROM memberships WHERE DATE(start_date)BETWEEN '$start_date' AND '$end_date'";
$res1 = mysqli_query($link, $query1);
$totalAmount1 = mysqli_fetch_assoc($res1)['total'] ?: 0;

$query2 = "SELECT SUM(cam_amount) AS total FROM campaigns WHERE DATE(created_at)BETWEEN '$start_date' AND '$end_date'";
$res2 = mysqli_query($link, $query2);
$totalAmount2 = mysqli_fetch_assoc($res2)['total'] ?: 0;
// print_r($totalAmount2);die();

$query4 = "SELECT SUM(otheramount) AS total FROM other WHERE DATE(other_date)BETWEEN '$start_date' AND '$end_date'";
$res4 = mysqli_query($link, $query4);
$totalAmount4 = mysqli_fetch_assoc($res4)['total'] ?: 0;
// print_r($totalAmount4); die();

$yearTotal = $totalAmount1 + $totalAmount2 + $totalAmount3 + $totalAmount4;



//   tbl_expense fetch 
// $query4 = "SELECT SUM(otheramount) AS total FROM other WHERE DATE(other_date)BETWEEN '$start_date' AND '$end_date'";

$query = "SELECT SUM(expense_amount) as total_expense FROM tbl_expense WHERE DATE(date)BETWEEN '$start_date' AND '$end_date' ";
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

$otherquery = "
SELECT SUM(otheramount) AS total_other
FROM other
WHERE MONTH(other_date) =  $currentMonth AND YEAR(other_date) = $currentYear";
$otherResult = $link->query($otherquery);
$otherrow = $otherResult->fetch_assoc();
$totalother = $otherrow['total_other'] ? $otherrow['total_other'] : 0;

// Calculate the total amount
$totalAmountincome = $totalDonations + $totalMemberships + $totalCampaigns + $totalother;


// Query to fetch total expenses for the current month

$currentMonth = date('m');
$currentYear = date('Y');
$expenseQuery = "
    SELECT SUM(expense_amount) AS total_expenses 
    FROM tbl_expense 
    WHERE DATE(date) >= '$start_date' AND DATE(date) <= '$end_date'";

$expenseResult = $link->query($expenseQuery);

if ($expenseResult->num_rows > 0) {
    $expenseRow = $expenseResult->fetch_assoc();
    $totalExpenses = $expenseRow['total_expenses'] ? $expenseRow['total_expenses'] : 0;
   
} else {
    $totalExpenses = 0;
}



$remainingBalance = $totalAmountincome - $totalExpenses;




// top 5 donor data show 
$donor5 = "SELECT fullName, idProof, SUM(donationAmount) AS totalDonation
           FROM donations
           GROUP BY idProof, fullName
           ORDER BY totalDonation DESC
           LIMIT 5";
$donorresult = $link->query($donor5);

// Fetch the first donor separately
$topDonor = null;
if ($donorresult->num_rows > 0) {
    $topDonor = $donorresult->fetch_assoc(); // Fetch the first result for top donor
};




?>


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
                                            <?php echo number_format($totalAmount3); ?></h4>
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
                                <div class="d-flex align-items-end justify-content-between mt-4" style="margin-bottom: 13px;">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary ">₹ <?php echo number_format($totalAmount2); ?></h4>

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
                                <div class="d-flex align-items-end justify-content-between mt-4" style="margin-bottom: 13px;">
                                    <div>
                                        <?php
                                        $sql = "SELECT COUNT(*) AS total_users FROM donations";
                                        $result = $link->query($sql);

                                        // Fetch and display the total users
                                        if ($result && $row = $result->fetch_assoc()) {

                                        ?>
                                            <h4 class="fs-22 fw-semibold ff-secondary"> <?php echo $row['total_users']; ?></h4>
                                        <?php
                                        } else {
                                            echo "Error: " . $conn->error;
                                        }
                                        ?>


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


                                <div class="d-flex align-items-end justify-content-between mt-4" style="margin-bottom: 13px;">
                                    <?php
                                    // Reset the rank and fetch the rest of the top 5 donors

                                    if ($topDonor) {
                                        // Display the top donor as rank 1 (already fetched)
                                        echo "<div>
           <h4 class='fs-22 fw-semibold ff-secondary'>" . ucfirst($topDonor['fullName']) . "</h4>
          </div>
          <div class='avatar-sm flex-shrink-0'>
            <span class='avatar-title rounded fs-22 mt-1' style='background-color:white; color:black; '>
              " . $topDonor['totalDonation'] . "
            </span>
          </div>";
                                    }
                                    ?>
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

                                            $rank = 1;
                                            while ($row = $donorresult->fetch_assoc()) {
                                                echo "<tr>
                                                    <td>" . $rank++ . "</td>
                                                    <td>" . ucfirst($row['fullName']) . "</td>
                                                    
                                                    <td>" . $row['totalDonation'] . "</td>
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
                                            // Database query
                                            include('config.php');
                                            $sql = "SELECT name, cam_amount, target_goal FROM campaigns WHERE status = 'active'";
                                            $result = $link->query($sql);

                                            if ($result->num_rows > 0) {
                                                $index = 1; // For serial numbers
                                                while ($row = $result->fetch_assoc()) {
                                                    $campaignName = $row['name']; // Campaign name
                                                    $camAmount = $row['cam_amount']; // Current campaign amount
                                                    $targetGoal = $row['target_goal']; // Target goal

                                                    // Calculate progress percentage
                                                    $progress = ($targetGoal > 0) ? round(($camAmount / $targetGoal) * 100) : 0;

                                                    // Table row with progress bar
                                                    echo "<tr>
                                        <td>$index</td>
                                        <td>$campaignName</td>
                                        <td>
                                            <div class='progress'>
                                                <div class='progress-bar' role='progressbar' style='width: {$progress}%;' aria-valuenow='{$progress}' aria-valuemin='0' aria-valuemax='100'>
                                                    {$progress}%
                                                </div>
                                            </div>
                                        </td>
                                      </tr>";
                                                    $index++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='3'>No active campaigns found.</td></tr>";
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
                                <h4 class="card-title mb-0">Renewal Reminders The Progress</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Membership Type</th>
                                                <th>Days Remaining</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include('Config.php');

                                            // Current date
                                            $currentDate = date('Y-m-d');

                                            // Query to fetch memberships expiring within the next 30 days
                                            $sql = "SELECT name, membership_type, end_date, 
                                    DATEDIFF(end_date, '$currentDate') AS days_remaining 
                                    FROM memberships 
                                    WHERE end_date >= '$currentDate' 
                                    AND end_date <= DATE_ADD('$currentDate', INTERVAL 30 DAY)";
                                            $result = $link->query($sql);

                                            if ($result->num_rows > 0) {
                                                $index = 1;
                                                while ($row = $result->fetch_assoc()) {
                                                    $name = $row['name'];
                                                    $membershipType = $row['membership_type'];
                                                    $daysRemaining = $row['days_remaining'];

                                                    // Display table row with days remaining
                                                    echo "<tr>
                                            <td>$index</td>
                                            <td>$name</td>
                                            <td>$membershipType</td>
                                            <td>
                                                $daysRemaining days
                                            </td>
                                          </tr>";
                                                    $index++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='4' class='text-center'>No memberships expiring within the next 30 days.</td></tr>";
                                            }

                                            // Close the database connection
                                            $link->close();
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



            </div>
        </div>
    </div>
    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/libs/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="assets/js/pages/dashboard-analytics.init.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>