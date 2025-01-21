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
        <?php
        include('config.php');

        // Get today's date
        $currentDate = date('Y-m-d');

        // SQL query to get donations for today
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

        $query2 = "SELECT * FROM campaigns WHERE DATE(created_at) = CURDATE()";
        $res2 = mysqli_query($link, $query2);
        $totalAmount2 = 0;
        while ($data2 = mysqli_fetch_assoc($res2)) {
            $totalAmount2 += $data2['cam_amount'];
        }


        $total = $totalAmount + $totalAmount1 + 
        +1065 
        ;
        // insert code 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get POST data
            $expense_type = mysqli_real_escape_string($link, $_POST['expense_type']);
            $expense_amount = mysqli_real_escape_string($link, $_POST['expense_amount']);
            $date = date('Y-m-d');

            // Prepare the SQL query using a prepared statement to prevent SQL injection
            $insertQuery = $link->prepare("INSERT INTO tbl_expense (expense_type, expense_amount, date) VALUES (?, ?, ?)");
            $insertQuery->bind_param("sds", $expense_type, $expense_amount, $date); // 's' for string, 'd' for decimal (float)
        
            // Execute the query
            if ($insertQuery->execute()) {
                echo "Expense added successfully!";
            } else {
                echo "Error: " . $insertQuery->error;
            }

            // Close the prepared statement
            $insertQuery->close();
        }

        ?>
    <script>
        $(document).ready(function () {
            // Initialize the date picker
            $("#datePicker").datepicker({
                dateFormat: 'yy-mm-dd', // Format for MySQL
                onSelect: function (selectedDate) {
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
                    success: function (response) {
                        // Update the total amount
                        $("#totalAmount").html(response);
                    },
                    error: function (xhr, status, error) {
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
                                        <strong id="totalAmount"><?php echo number_format($total, 2); ?></strong>
                                    </h4>
                                    <!-- Date Picker to the right of "Total Amount Today" -->
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
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹
                                                       <?php echo number_format($totalAmount); ?>
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
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹
                                                        <?php echo number_format($totalAmount1); ?>
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
                                                        Overall <br>Collection</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹<span
                                                            class="counter-value" data-target="1000000">0</span>
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
                        <div class="card-body">
            <h5 class="card-title">Add Expense</h5>
            <!-- Expense Form -->
            <form action="submit_expense.php" method="POST">
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

</body>