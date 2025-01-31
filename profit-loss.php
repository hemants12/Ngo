<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'P&L Account Format')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <?php include('config.php'); ?>
    <style>
        .table-responsive {
            border: 2px solid;
        }
        .card-title {
            font-size: x-large;
            font-weight: 500;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 8px;
            text-align: left;
        }

        .section-title {
            font-weight: bold;
            font-size: 16px;
            background-color: #f8f9fa;
        }

        .section-end {
            font-weight: bold;
            font-size: 16px;
            background-color: #f8f9fa;
            text-align: end;
            padding-right: 20px;
        }

        .high {
            font-weight: bold;
            color: black;
        }
    </style>
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
                            <!-- P&L Account Table in Desired Format -->
                            <div class="card">
                                <div class="card-body">
                                    <!-- Title and Buttons -->
                                    <div class="card-header">
                                        <h4 class="card-title">Profit & Loss Account for FY2025</h4>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="section-title">
                                                    <th>Income</th>
                                                    <th>Amount (In ₹)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Fetch donation amount from the database
                                                $query = "SELECT SUM(donationAmount) as TotalAmount FROM donations"; // Change table/column as per your database
                                                $result = mysqli_query($link, $query);
                                                $donation = 0;

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $donation = $row['TotalAmount'] ? $row['TotalAmount'] : 0;
                                                } else {
                                                    echo "Error fetching data.";
                                                }
                                                ?>
                                                <!-- REVENUE Section -->
                                                <tr>
                                                    <td>Donation</td>
                                                    <td><?php echo number_format($donation); ?></td>
                                                </tr>
                                                <?php
                                                // Fetch donation amount from the database
                                                $query = "SELECT SUM(cam_amount) as TotalCamAmount FROM campaigns"; // Change table/column as per your database
                                                $result = mysqli_query($link, $query);
                                                $campaign = 0;

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $campaign = $row['TotalCamAmount'] ? $row['TotalCamAmount'] : 0;
                                                } else {
                                                    echo "Error fetching data.";
                                                }
                                                ?>
                                                <tr>
                                                    <td>Campaign</td>
                                                    <td><?php echo number_format($campaign); ?></td>
                                                </tr>
                                                <?php
                                                // Fetch donation amount from the database
                                                $query = "SELECT SUM(amount) as TotalmemberAmount FROM memberships"; // Change table/column as per your database
                                                $result = mysqli_query($link, $query);
                                                $member = 0;

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $member = $row['TotalmemberAmount'] ? $row['TotalmemberAmount'] : 0;
                                                } else {
                                                    echo "Error fetching data.";
                                                }
                                                ?>
                                                <tr>
                                                    <td>Memberships</td>
                                                    <td><?php echo number_format($member); ?></td>
                                                </tr>
                                                <?php
                                                // Fetch donation amount from the database
                                                $query = "SELECT SUM(otheramount) as TotalotherAmount FROM other"; // Change table/column as per your database
                                                $result = mysqli_query($link, $query);
                                                $other = 0;

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $other = $row['TotalotherAmount'] ? $row['TotalotherAmount'] : 0;
                                                } else {
                                                    echo "Error fetching data.";
                                                }
                                                ?>
                                                <tr>
                                                    <td>Additional Fund</td>
                                                    <td><?php echo number_format($other); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="section-end">Total Revenue</td>
                                                    <td style="text-align:center; font-size:16px; font-weight:bold; border-top:2px solid;border-bottom:2px solid;">
                                                        <?php echo number_format($donation + $campaign + $member + $other); ?>
                                                    </td>
                                                </tr>

                                                <!-- EXPENSES Section -->
                                                 <?php
                                                // Fetch all expenses except staff salary and office rent from tbl_expense
                                                $query_rent = "SELECT SUM(expense_amount) AS total_rent FROM tbl_expense WHERE expense_type LIKE '%Office Rent%'";
                                                $result_rent = mysqli_query($link, $query_rent);
                                                $row_rent = mysqli_fetch_assoc($result_rent);
                                                $office_rent = $row_rent['total_rent'];
                                                
                                               
                                                ?>
                                                <tr class="section-title">
                                                    <th>Expenses</th>
                                                    <th>Amount (In ₹)</th>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Staff Salary</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Office Rent</td>
                                                    <td><?php echo $office_rent; ?></td>
                                                </tr>
                                                <?php
                                                // Fetch all expenses except staff salary and office rent from tbl_expense
                                                $query_utility = "SELECT SUM(expense_amount) AS total_utilities FROM tbl_expense WHERE expense_type LIKE '%Utilities%'";
                                                $result_utility = mysqli_query($link, $query_utility);
                                                $row_utility = mysqli_fetch_assoc($result_utility);
                                                $utility = $row_utility['total_utilities'];
                                                
                                               
                                                ?>
                                                <tr>
                                                    <td>Utilities</td>
                                                    <td><?php echo $utility; ?></td>
                                                </tr>
                                                <?php
                                                // Fetch all expenses except staff salary and office rent from tbl_expense
                                                $query_Adv = "SELECT SUM(expense_amount) AS total_Adv FROM tbl_expense WHERE expense_type LIKE '%Advertisement%'";
                                                $result_Adv = mysqli_query($link, $query_Adv);
                                                $row_Adv = mysqli_fetch_assoc($result_Adv);
                                                $Adv = $row_Adv['total_Adv'];
                                                
                                               
                                                ?>
                                                <tr>
                                                    <td>Advertisement Expenses</td>
                                                    <td><?php echo $Adv; ?></td>
                                                </tr>
                                                <?php
                                                // Fetch all expenses except staff salary and office rent from tbl_expense
                                                $query_Marketing = "SELECT SUM(expense_amount) AS total_Marketing FROM tbl_expense WHERE expense_type LIKE '%Marketing%'";
                                                $result_Marketing = mysqli_query($link, $query_Marketing);
                                                $row_Marketing = mysqli_fetch_assoc($result_Marketing);
                                                $Marketing = $row_Marketing['total_Marketing'];
                                                
                                               
                                                ?>
                                                <tr>
                                                    <td>Marketing Expenses</td>
                                                    <td><?php echo $Marketing; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Other expenses</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Other expenses</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                <?php
// Assuming $conn is already established

$query_expense = "SELECT SUM(expense_amount) AS total_expense FROM tbl_expense"; // Replace 'expense_amount' if needed
$result_expense = mysqli_query($link, $query_expense);
$row_expense = mysqli_fetch_assoc($result_expense);
$total_expense = $row_expense['total_expense']; // Store total expense in one variable


?>

                                                    <td class="section-end">Total Expense</td>
                                                    <td style="text-align:center; font-size:16px; font-weight:bold;border-top:2px solid;">  
                                                        <?php echo number_format($office_rent + $utility + $Adv + $Marketing); ?></td>
                                                </tr>

                                                <!-- Profit before tax -->
                                                <tr>
                                                    <td class="section-title">Profit before tax ( Total Income - Total Expenses )</td>
                                                    <td style="text-align:center; font-size:16px; font-weight:bold; border-top:2px solid;border-bottom:2px solid;">
                                                        <?php echo number_format(( $donation + $campaign + $member + $other) - $total_expense); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- End of P&L Account Table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/vendor-scripts.php'; ?>
</body>
