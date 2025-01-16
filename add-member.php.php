<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data here
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];


    // Assuming you have a connection to your database called $conn
    include 'config.php';
    // Insert data into the table
    $query = "INSERT INTO donations (donorType, fullName, email, phone, country, areaStreet, state, city, pincode, idProof, donationAmount, donationType, donationFor)
              VALUES ('$donorType', '$fullName', '$email', '$phone', '$country', '$areaStreet', '$state', '$city', '$pincode', '$idProof', '$donationAmount', '$donationType', '$donationFor')";


    if (mysqli_query($link, $query)) {
        // After successful insertion, set a session variable
        $_SESSION['success'] = "Your donation has been successfully submitted.";
        // Redirect to the same page to prevent form resubmission
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit;
    } else {
        // If insertion fails, show an error message
        $_SESSION['error'] = "There was an error submitting your donation. Please try again.";
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit;
    }
}
?>
<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'New Donation')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <style>
        .card {
            color:black;
        }
        .custom-hr {
            border: 0;
            height: 1px;
            background-color: black;
            margin: 20px 0;
        }
        .form-control, .form-select {
            border-color: black;
            height: 50px; /* Increased input height */
        }
        .card-title.text-center {
            font-size: 2.5rem; /* Increased Donor Registration size */
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
                                                <label for="fullName" class="form-label">Full Name</label>
                                                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                                            </div>
                                           
                                            <div class="col-md-6 mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" required>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <label for="membership_plan" class="form-label">Select Membership Plan</label>
                                            <select class="form-select" id="membership_plan" name="membership_plan" required>
                                                <option value="" disabled selected>Select a plan</option>
                                                <option value="basic">Gold Plan</option>
                                                <option value="standard">Silver Plan</option>
                                                <option value="premium">Platinum Plan</option>
                                            </select>
                                        </div>
                                        </div>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                        <div class="col-md-6 mb-3">
                                                <label for="startdate" class="form-label">Membership Start Date</label>
                                                <input type="date" class="form-control" id="startdate" name="startdate" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="enddate" class="form-label">Membership End Date</label>
                                                <input type="date" class="form-control" id="enddate" name="enddate" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <label for="reason" class="form-label">Why do you want to join the NGO?</label>
                                            <textarea class="form-control" id="reason" name="reason" rows="4" required></textarea>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                    <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="Donation-amount" class="form-label">Donation Amount</label>
                                                <input type="number" class="form-control" id="Donation-amount" name="Donation-amount" placeholder="Enter Your Donation Amount" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="donationType" class="form-label">Donation Type</label>
                                                <select class="form-select" id="donationType" name="donationType" required>
                                                    <option value="" disabled selected>Select Donation Type</option>
                                                    <option value="Online">Online</option>
                                                    <option value="Cash">Cash</option>
                                                </select>
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
