<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data here
    $donorType = $_POST['donorType'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $areaStreet = $_POST['areaStreet'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $idProof = $_POST['idProof'];
    $donationAmount = $_POST['Donation-amount'];
    $donationType = $_POST['donationType'];
    $donationFor = $_POST['Donationfor'];

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
                                    <h1 class="card-title text-center">Donor Registration</h1>
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
                                            <h4 class="card-title">General Information</h4>
                                            <hr class="custom-hr"> <!-- Line below General Information -->
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="donorType" class="form-label">Donor Type</label>
                                                    <select class="form-select" id="donorType" name="donorType"
                                                        required>
                                                        <option value="" disabled selected>Select Donor Type</option>
                                                        <option value="individual">Individual</option>
                                                        <option value="organization">Organization</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="fullName" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="fullName"
                                                        name="fullName" placeholder="Enter your full name" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Enter your email" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="tel" class="form-control" id="phone" name="phone"
                                                        placeholder="Enter your phone number" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Address info Fields -->
                                        <div class="mb-3">
                                            <h4 class="card-title">Address Information</h4>
                                            <hr class="custom-hr"> <!-- Line below Address Information -->
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="country" class="form-label">Country</label>
                                                    <input type="text" class="form-control" id="country" name="country"
                                                        placeholder="Enter your country" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="areaStreet" class="form-label">Area/Street</label>
                                                    <input type="text" class="form-control" id="areaStreet"
                                                        name="areaStreet" placeholder="Enter your area/street" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="state" class="form-label">State</label>
                                                    <input type="text" class="form-control" id="state" name="state"
                                                        placeholder="Enter your state" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="city" name="city"
                                                        placeholder="Enter your city" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="pincode" class="form-label">PIN Code</label>
                                                    <input type="text" class="form-control" id="pincode" name="pincode"
                                                        placeholder="Enter your PIN code" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- User Identification Details Fields -->
                                        <div class="mb-3">
                                            <h4 class="card-title">User Identification Details</h4>
                                            <hr class="custom-hr"> <!-- Line below User Identification Details -->
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="idProof" class="form-label">ID Proof (PAN Card)</label>
                                                    <input type="text" class="form-control" id="idProof" name="idProof"
                                                        placeholder="Enter Your PAN Card Number"
                                                        pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}"
                                                        title="PAN number should be in the format AAAAA9999A" required>
                                                </div>
                                                <php
                                                if (!preg_match("/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/", $idProof)) {
    $_SESSION['error'] = "Invalid PAN card number format.";
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}
                                                ?>
                                            </div>
                                        </div>
                                        <!-- Payment Details Fields -->
                                        <div class="mb-3">
                                            <h4 class="card-title">Payment Details</h4>
                                            <hr class="custom-hr"> <!-- Line below Payment Details -->
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="Donation-amount" class="form-label">Donation
                                                        Amount</label>
                                                    <input type="number" class="form-control" id="Donation-amount"
                                                        name="Donation-amount" placeholder="Enter Your Donation Amount"
                                                        required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="donationType" class="form-label">Donation Type</label>
                                                    <select class="form-select" id="donationType" name="donationType"
                                                        required>
                                                        <option value="" disabled selected>Select Donation Type</option>
                                                        <option value="Online">Online</option>
                                                        <option value="Cash">Cash</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="Donationfor" class="form-label">Donation For</label>
                                                    <input type="text" class="form-control" id="Donationfor"
                                                        name="Donationfor"
                                                        placeholder="Donation For Like ( Poor Children, For Animal, etc. )"
                                                        required>
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