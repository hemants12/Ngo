<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php
$name = $email = $phonenumber = $address = $membership_type = $start_date = $end_date = $description = $amount = $method = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $membership_type = $_POST['membership_type'];
    $amount  = $_POST['amount'];
    $method  = $_POST['method'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $start_date  = $_POST['start_date'];
    $end_date   = $_POST['end_date'];
    $address    = $_POST['address'];
    $description  = $_POST['description'];

    // Include database configuration
    include 'config.php';

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM memberships WHERE email = '$email'";
    $result = mysqli_query($link, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        // If email exists, set a session variable for the error
        $_SESSION['email_error'] = "Email already exists. Please use a different email.";
    } else {
        // Insert data into the table
        $query = "INSERT INTO memberships (membership_type, amount, method, name, email, phonenumber, start_date, end_date, address, description)
                  VALUES ('$membership_type', '$amount', '$method', '$name', '$email', '$phonenumber', '$start_date', '$end_date', '$address', '$description')";

        if (mysqli_query($link, $query)) {
            $_SESSION['success'] = "Your Membership has been successfully Added.";
            header("Location: " . $_SERVER["PHP_SELF"]);
            exit;
        } else {
            $_SESSION['error'] = "There was an error submitting your donation. Please try again.";
        }
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
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" placeholder="Enter your full name" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control <?php echo isset($_SESSION['email_error']) ? 'is-invalid' : ''; ?>"
                                                        id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter your email" required>
                                                    <?php if (isset($_SESSION['email_error'])): ?>
                                                        <div class="invalid-feedback">
                                                            <?php
                                                            echo $_SESSION['email_error'];
                                                            unset($_SESSION['email_error']);
                                                            ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="tel" class="form-control" id="phone" name="phonenumber" value="<?php echo htmlspecialchars($phonenumber); ?>" placeholder="Enter your phone number" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="membership_type" class="form-label">Select Membership Plan</label>
                                                    <select class="form-select" id="membership_type" name="membership_type" required>
                                                        <option value="" disabled selected>Select a plan</option>
                                                        <option value="Silver" <?php echo $membership_type == "Silver" ? "selected" : ""; ?>>Silver Plan</option>
                                                        <option value="Gold" <?php echo $membership_type == "Gold" ? "selected" : ""; ?>>Gold Plan</option>
                                                        <option value="Platinum" <?php echo $membership_type == "Platinum" ? "selected" : ""; ?>>Platinum Plan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="start_date" class="form-label">Membership Start Date</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="end_date" class="form-label">Membership End Date</label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="reason" class="form-label">Why do you want to join the NGO?</label>
                                                    <textarea class="form-control" id="reason" name="description" rows="4" required><?php echo htmlspecialchars($description); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="Donation-amount" class="form-label"> Membership Fees</label>
                                                    <input type="number" class="form-control" id="Donation-amount" name="amount" value="<?php echo htmlspecialchars($amount); ?>" placeholder="Enter Your Membership Fees" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="donationType" class="form-label">Payment Methods </label>
                                                    <select class="form-select" id="donationType" name="method" required>
                                                        <option value="" disabled selected>Select Payment Methods </option>
                                                        <option value="Online" <?php echo $method == "Online" ? "selected" : ""; ?>>Online</option>
                                                        <option value="Cash" <?php echo $method == "Cash" ? "selected" : ""; ?>>Cash</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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