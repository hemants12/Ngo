<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php

include('config.php');
if (isset($_GET['membership_id'])) {
    $membership_id = intval($_GET['membership_id']);

    $res = "SELECT * FROM memberships WHERE membership_id = ?";
    $stmt = $link->prepare($res);
    $stmt->bind_param("i", $membership_id);
    $stmt->execute();
    $data = $stmt->get_result();

    if ($data->num_rows > 0) {
        $row = $data->fetch_assoc();
    } else {
        echo "No Record Found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] ===  'POST') {
    $membership_type = $_POST['membership_type'];
    $amount = $_POST['amount'];
    $method = $_POST['method'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];

    $start_date = $_POST['start_date'];
    $end_date   = $_POST['end_date'];

    $updatequery = "UPDATE  memberships  SET  membership_type = ? , amount = ? , method = ? ,  name = ?, email = ?, phonenumber = ? , address = ? ,start_date = ? , end_date = ? WHERE membership_id  = ? ";
    $update_stmt = $link->prepare($updatequery);
    $update_stmt->bind_param("sdsssssssi", $membership_type, $amount, $method, $name, $email, $phonenumber,  $address, $start_date, $end_date, $membership_id);

    if ($update_stmt->execute()) {
        $_SESSION['success'] = 'Membership updated successfully.';
        header('Location: member_list.php');
        exit(); // Ensure the script stops after the header redirection
    } else {
        // Store the error message in the session and redirect to the same page
        $_SESSION['error'] = 'Error updating record: ' . $link->error;
        header('Location: edit_membership.php?membership_id=' . $membership_id);
        exit(); // Ensure the script stops after the header redirection
    }
}
?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'New Donation')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <style>
        .card {
            color: black;
        }

        .custom-hr {
            border: 0;
            height: 1px;
            background-color: black;
            margin: 20px 0;
        }

        .form-control,
        .form-select {
            border-color: black;
            height: 50px;
            /* Increased input height */
        }

        .card-title.text-center {
            font-size: 2.5rem;
            /* Increased Donor Registration size */
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
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="card-title text-center">NGO Membership Form</h1>
                                    <hr class="custom-hr">
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
                                    <form method="post" action="">
                                        <!-- General Info Fields -->


                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" placeholder="Enter your full name" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($row['email']) ?>" name="email" placeholder="Enter your email" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="number" class="form-control" id="phone" value="<?php echo htmlspecialchars($row['phonenumber']) ?>" name="phonenumber" placeholder="Enter your phone number" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['address']) ?>" id="address" name="address" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="membership_type" class="form-label">Select Membership Plan</label>
                                                    <select class="form-select" id="membership_type" name="membership_type" required>
                                                        <option value="" disabled selected>Select a plan</option>
                                                        <option value="Silver">Silver Plan</option>
                                                        <option value="Gold">Gold Plan</option>
                                                        <option value="Platinum">Platinum Plan</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="start_date" class="form-label">Membership Start Date</label>
                                                    <input type="date" class="form-control" id="start_date" value=<?php echo htmlspecialchars($row['start_date']) ?> name="start_date" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="end_date" class="form-label">Membership End Date</label>
                                                    <input type="date" class="form-control" id="end_date" value=<?php echo htmlspecialchars($row['end_date']) ?> name="end_date" required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="Donation-amount" class="form-label">Donation Amount</label>
                                                    <input type="number" class="form-control" id="Donation-amount" value=<?php echo htmlspecialchars($row['amount']) ?> name="amount" placeholder="Enter Your Donation Amount" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="donationType" class="form-label">Donation Type</label>
                                                    <select class="form-select" id="donationType" name="method" required>
                                                        <option value="" disabled selected>Select Donation Type</option>
                                                        <option value="Online">Online</option>
                                                        <option value="Cash">Cash</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div> <!-- end card -->
                        </div> <!-- end row -->
                    </div>
                </div> <!-- container-fluid -->
            </div> <!-- page-content -->
        </div> <!-- main-content -->
    </div>

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