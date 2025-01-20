<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php
$id = $fullname = $mobile = $email = $address = $designation = $salary = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $designation = $_POST['designation'];
    $salary = $_POST['salary'];

    // Include database configuration
    include 'config.php';

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM Staff WHERE email = '$email'";
    $result = mysqli_query($link, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        // If email exists, set a session variable for the error
        $_SESSION['email_error'] = "Email already exists. Please use a different email.";
    } else {
        // Insert data into the table
        $query = "INSERT INTO Staff (id, fullname, mobile, email, address, designation, salary)
                  VALUES ('$id', '$fullname', '$mobile', '$email', '$address', '$designation', '$salary')";

        if (mysqli_query($link, $query)) {
            $_SESSION['success'] = "Staff Added Successfully.";
            header("Location: " . $_SERVER["PHP_SELF"]);
            exit;
        } else {
            $_SESSION['error'] = "There was an error adding the staff. Please try again.";
        }
    }
}
?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'New Staff')); ?>
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
        .form-control, .form-select {
            border-color: black;
            height: 50px;
        }
        .card-title.text-center {
            font-size: 2.5rem;
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
                                <h1 class="card-title text-center">Staff Registration Form</h1>
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
                <label for="id" class="form-label">Staff ID</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($id); ?>" placeholder="Enter Staff ID" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" placeholder="Enter Full Name" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>" placeholder="Enter Mobile Number" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control <?php echo isset($_SESSION['email_error']) ? 'is-invalid' : ''; ?>" 
                       id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter Email" required>
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
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" value="<?php echo htmlspecialchars($designation); ?>" placeholder="Enter Designation" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" class="form-control" id="salary" name="salary" value="<?php echo htmlspecialchars($salary); ?>" placeholder="Enter Salary" required>
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