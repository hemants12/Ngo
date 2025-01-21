<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'New Donation')); ?>
    <?php include 'layouts/head-css.php'; ?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <?php
    include('config.php');
    $currentDate = date('Y-m-d');
    $query = "SELECT * FROM donations WHERE DATE(created_at) = CURDATE()";
    $res = mysqli_query($link, $query);
    $totalAmount = 0;
    while ($data = mysqli_fetch_assoc($res)) {
        $totalAmount += $data['donationAmount'];
    }
    $query1 = "SELECT * FROM memberships WHERE DATE(start_date) = CURDATE()";
    $res1 = mysqli_query($link, $query1);
    $totalAmount1 = 0;
    while ($data1 = mysqli_fetch_assoc($res1)) {
        $totalAmount1 += $data1['amount'];
    }
    $query2 = "SELECT * FROM campaigns WHERE DATE(created_at) = CURDATE()";
    $res2 = mysqli_query($link, $query2);
    $totalAmount2 = 0;
    while ($data2 = mysqli_fetch_assoc($res2)) {
        $totalAmount2 += $data2['cam_amount'];
    }
    $total = $totalAmount + $totalAmount1 + $totalAmount2;




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








    // Fetch data from the database
    $query = "SELECT `expense_id`, `expense_type`, `total_amount`, `expense_amount`, `date` 
    FROM `tbl_expense` 
    WHERE `date` = CURDATE()";
$result = mysqli_query($link, $query);

if ($result && $result->num_rows > 0) {
while ($row = mysqli_fetch_assoc($result)) {
  $total_amount = $row['total_amount'];
  $expense_amount = $row['expense_amount'];
  $remaining_amount = $total_amount - $expense_amount;

  // Determine the icon and status message
}
} else {
echo '<p>No records found for today.</p>';
}

// Close connection after all queries are executed





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
                                <div class="alert mt-2 d-flex justify-content-between align-items-center" style="margin-bottom:0px;">
                                    <h4>Total Amount Today:
                                        <strong id="totalAmount"><?php echo number_format($total); ?></strong>
                                    </h4>
                                    <input type="text" id="datePicker" placeholder="Select Date" class="form-control"
                                        style="width: 150px;">
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Today Donation <br>Collection</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹ <?php echo number_format($totalAmount); ?>
                                                    </h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                                        <i class="fas fa-donate text-success"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Today Campaign <br>Collection</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹
                                                        <?php echo number_format($totalAmount2); ?>
                                                    </h4>

                                                </div>

                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-info-subtle rounded fs-3">
                                                        <i class="fas fa-tasks text-info"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Today Membership <br> Collection</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹<?php echo number_format($totalAmount,); ?>0
                                                    </h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                        <i class="bx bx-user-circle text-warning"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Today <br>Balance</p>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                        ₹
                                                        <?php
                                                        if ($remaining_amount >= 0) {
                                                            $icon = '<span style="color: green;">+</span>';
                                                            $status_message = " $remaining_amount";
                                                        } else {
                                                            $icon = '<span style="color: red;">-</span>';
                                                            $status_message = " " . abs($remaining_amount);
                                                        }

                                                        // Display the icon and message
                                                        echo $icon . ' ' . $status_message;
                                                        ?>
                                                    </h4>
                                                    <a href="" class="text-decoration-underline"></a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                        <i class="bx bx-wallet text-primary"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                            </div>
                        </div>
                        <div class="card">
                            <?php if (isset($_SESSION['success'])): ?>
                                <div class="alert alert-success" role="alert">
                                    <?php
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                                    ?>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title">Add Expense</h5>
                                <!-- Expense Form -->
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="expenseReason" name="expenseReason" placeholder="Enter the reason" required>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="card-title">Amount</h5>
                                        <input type="number" class="form-control" id="expenseAmount" name="expenseAmount" placeholder="Enter the amount" required>
                                    </div>
                                    <div class="d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
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