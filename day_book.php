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
    $query3 = "SELECT * FROM other WHERE DATE(other_date) = CURDATE()";
    $res3 = mysqli_query($link, $query3);
    $totalAmount3 = 0;
    while ($data3 = mysqli_fetch_assoc($res3)) {
        $totalAmount3 += $data3['otheramount'];
    }
    $total = $totalAmount + $totalAmount1 + $totalAmount2 + $totalAmount3;


    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Collect form data
        $expense_type = mysqli_real_escape_string($link, $_POST['expenseReason']);
        $other_expense = isset($_POST['otherExpenseName']) ? trim(mysqli_real_escape_string($link, $_POST['otherExpenseName'])) : '';
        $expense_amount = mysqli_real_escape_string($link, $_POST['expenseAmount']);
        $date = date('Y-m-d');
    
        // Handle "Other expenses"
        if ($expense_type === "Other expenses" && !empty($other_expense)) {
            $expense_type = "Other: " . $other_expense; // Concatenate "Other" with the provided input
        }
    
        // Calculate total amount collected today
        $query_total = "
            SELECT 
                (SELECT IFNULL(SUM(donationAmount), 0) FROM donations WHERE DATE(created_at) = CURDATE()) +
                (SELECT IFNULL(SUM(amount), 0) FROM memberships WHERE DATE(start_date) = CURDATE()) +
                (SELECT IFNULL(SUM(cam_amount), 0) FROM campaigns WHERE DATE(created_at) = CURDATE()) +
                (SELECT IFNULL(SUM(otheramount), 0) FROM other WHERE DATE(other_date) = CURDATE()) 
                AS total";
        $result = mysqli_query($link, $query_total);
        $row = mysqli_fetch_assoc($result);
        $total_collected_today = $row['total'];
    
        // Calculate total expenses for today
        $query_expenses = "SELECT IFNULL(SUM(expense_amount), 0) AS total_expenses FROM tbl_expense WHERE DATE(date) = CURDATE()";
        $result_expenses = mysqli_query($link, $query_expenses);
        $row_expenses = mysqli_fetch_assoc($result_expenses);
        $total_expenses_today = $row_expenses['total_expenses'];
    
        // Calculate remaining balance
        $remaining_amount = $total_collected_today - $total_expenses_today;
    
        // Check if the expense can be covered by the remaining balance
        if ($remaining_amount < $expense_amount) {
            $_SESSION['error'] = "Insufficient funds. Please add more funds to cover the expense amount.";
        } else {
            // Insert a new record
            $insertQuery = $link->prepare("INSERT INTO tbl_expense (expense_type, total_amount, expense_amount, date) VALUES (?, ?, ?, ?)");
            $insertQuery->bind_param("sdds", $expense_type, $total_collected_today, $expense_amount, $date);
    
            if ($insertQuery->execute()) {
                // Recalculate total expenses and remaining balance after insertion
                $query_expenses = "SELECT IFNULL(SUM(expense_amount), 0) AS total_expenses FROM tbl_expense WHERE DATE(date) = CURDATE()";
                $result_expenses = mysqli_query($link, $query_expenses);
                $row_expenses = mysqli_fetch_assoc($result_expenses);
                $total_expenses_today = $row_expenses['total_expenses'];
    
                // Update remaining balance
                $remaining_amount = $total_collected_today - $total_expenses_today;
    
                $_SESSION['success'] = "Your expense has been successfully submitted. Remaining balance updated.";
            } else {
                $_SESSION['error'] = "Error: " . $insertQuery->error;
            }
            $insertQuery->close();
        }
    
        mysqli_close($link);
    
        // Redirect to avoid resubmission
        header("Location: day_book.php");
        exit;
    }
    





    //   tbl_expense fetch 



    include('config.php');

    // Fetch data from the database

    $query = "SELECT  * FROM `tbl_expense` 
    WHERE `date` = CURDATE()";
    $result = mysqli_query($link, $query);

    $query = "SELECT * FROM tbl_expense 
    WHERE date = CURDATE()";
    $result = mysqli_query($link, $query);

    if ($result && $result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $total_amount = $row['total_amount'];
            $expense_amount = $row['expense_amount'];
            $remaining_amount = $total_amount - $expense_amount;
        }
    } else {
        echo '<p>No records found for today.</p>';
    }

    if ($result && $result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $total_amount = $row['total_amount'];
            $expense_amount = $row['expense_amount'];
            $remaining_amount = $total_amount - $expense_amount;
        }
    } else {
        echo '<p>No records found for today.</p>';
    }



    




    // total amount today 

    $totalexpence = "SELECT SUM(`expense_amount`) AS total_expense 
    FROM `tbl_expense` 
    WHERE DATE(`date`) = CURDATE();";
$res = mysqli_query($link, $totalexpence);

// Fetch the result
if ($res) {
    $row = mysqli_fetch_assoc($res);
    $totalExpense = $row['total_expense'] ?: 0;
   

    // Print the total expense
    
} else {
    // Print MySQL error for debugging
    echo "Query Error: " . mysqli_error($link);
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
                                    <h4>Total Expanse Today:
                                        <strong id="totalAmount">₹<?php echo number_format($totalExpense); ?> </strong>
                                    </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-6">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
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
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6">
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
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹<?php echo number_format($totalAmount); ?>
                                                    </h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                        <i class="bx bx-user-circle text-warning"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6">
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
                                                        if (isset($remaining_amount) && $remaining_amount >= 0) {
                                                            $icon = '<span style="color: green;">+</span>';
                                                            $status_message = " $remaining_amount";
                                                        } elseif (isset($remaining_amount)) {
                                                            $icon = '<span style="color: red;">-</span>';
                                                            $status_message = " " . abs($remaining_amount);
                                                        } else {
                                                            $icon = '<span style="color: gray;"></span>';
                                                            $status_message = " 0";
                                                        }

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
        <div class="form-group">
            <label for="expenseReason">Expense Reason</label>
            <select class="form-control" id="expenseReason" name="expenseReason" required onchange="toggleOtherInput()">
                <option value="">Select an expense</option>
                <option value="office rent">Office Rent</option>
                <option value="utilities">Utilities</option>
                <option value="Advertisement Expenses">Advertisement Expenses</option>
                <option value="Marketing Expenses">Marketing Expenses</option>
                <option value="Other expenses">Other Expenses</option>
            </select>
        </div>
        <div class="form-group" id="otherExpenseDiv" style="display: none;">
            <label for="otherExpenseName">Please specify:</label>
            <input type="text" class="form-control" id="otherExpenseName" name="otherExpenseName" placeholder="Enter other expense">
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



                        <!-- other   -->

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
                                <h5 class="card-title">Add Funds</h5>
                                <!-- Expense Form -->
                                <form action="other_amount_insert.php" method="POST">
                                    <div class="mb-3">

                                    </div>
                                    <div class="mb-3">
                                        <input type="number" class="form-control" id="Amount" name="otheramount" placeholder="Enter the amount" required>
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

    <script>
    function toggleOtherInput() {
        const expenseReason = document.getElementById('expenseReason').value;
        const otherExpenseDiv = document.getElementById('otherExpenseDiv');
        if (expenseReason === "Other expenses") {
            otherExpenseDiv.style.display = "block";
        } else {
            otherExpenseDiv.style.display = "none";
            document.getElementById('otherExpenseName').value = ''; // Clear other input
        }
    }
</script>
</body>

<!-- 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expenseReason = $_POST['expenseReason'];
    $otherExpenseName = isset($_POST['otherExpenseName']) ? $_POST['otherExpenseName'] : null;

    // Final expense reason to save in the database
    $finalExpenseReason = ($expenseReason === 'Other expenses' && !empty($otherExpenseName)) 
        ? $otherExpenseName 
        : $expenseReason;

    // Insert into database
    $query = "INSERT INTO tbl_expense (expense_type, expense_amount, date) VALUES (?, ?, NOW())";
    $stmt = $link->prepare($query);
    $stmt->bind_param("ss", $finalExpenseReason, $expenseAmount); // Assuming $expenseAmount is available
    if ($stmt->execute()) {
        echo "Expense saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} -->