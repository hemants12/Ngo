<style>
/* Define the keyframes for the pop-up effect */
@keyframes slideInFromBack {
    0% {
        transform: scale(0.5); /* Start small and far away */
        opacity: 0; /* Initially transparent */
    }
    100% {
        transform: scale(1); /* Full size in center */
        opacity: 1; /* Fully visible */
    }
}

/* Apply the animation to the modal */
.modal.custom-popup .modal-dialog {
    animation: slideInFromBack 0.5s ease forwards; /* Control duration and easing */
    transform-origin: center center; /* Animation originates from the center */
}
</style>

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php include('config.php');

$query = "SELECT * FROM users";
$stmt = $link->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Update logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $number = $_POST['number'];
    $useremail = $_POST['useremail'];
    $designation = $_POST['designation'];
    $websiteurl = $_POST['websiteurl'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $zipcode = $_POST['zipcode'];

    $updateQuery = "UPDATE users SET 
        username = ?, 
        number = ?, 
        useremail = ?, 
        designation = ?, 
        websiteurl = ?, 
        city = ?, 
        country = ?, 
        zipcode = ? 
        WHERE id = ?";

    $updateStmt = $link->prepare($updateQuery);
    $updateStmt->bind_param("ssssssssi", $username, $number, $useremail, $designation, $websiteurl, $city, $country, $zipcode, $user['id']);

    if ($updateStmt->execute()) {
        echo "<script>
            window.onload = function() {
                var updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
                updateModal.show();
            };
        </script>";
    } else {
        echo "<script>alert('Profile update failed. Please try again.');</script>";
    }
    
}
?>
<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Profile Settings')); ?>
    <?php include 'layouts/head-css.php'; ?>
</head>
<body>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>

        <form action="" method="POST">
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xxl-3">
                                <div class="card mt-1">
                                    <div class="card-body m-4">
                                        <div class="text-center">
                                            <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                                <img src="assets/images/users/download.png" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">
                                            </div>
                                            <h5 class="fs-16 mb-1"><?php echo $user['username'] ?? 'Guest'; ?></h5>
                                            <p class="text-muted mb-0">Ngo King Software</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-9">
                                <div class="card mt-xxl-n5">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                                    <i class="fas fa-home"></i> Personal Details
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Full Name</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="username" value="<?php echo $user['username'] ?? 'Guest'; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                            <input type="text" class="form-control" id="phonenumberInput" name="number" value="<?php echo $user['number']; ?>" placeholder="Enter your phone number">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Email Address</label>
                                                            <input type="email" class="form-control" id="emailInput" name="useremail" value="<?php echo $user['useremail']; ?>" placeholder="Enter your email">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="designationInput" class="form-label">Designation</label>
                                                            <input type="text" class="form-control" id="designationInput" name="designation" value="<?php echo $user['designation']; ?>" placeholder="Designation">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="websiteInput1" class="form-label">Website</label>
                                                            <input type="text" class="form-control" id="websiteInput1" name="websiteurl" value="<?php echo $user['websiteurl']; ?>" placeholder="www.example.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="cityInput" class="form-label">City</label>
                                                            <input type="text" class="form-control" id="cityInput" name="city" value="<?php echo $user['city']; ?>" placeholder="City">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="countryInput" class="form-label">Country</label>
                                                            <input type="text" class="form-control" id="countryInput" name="country" value="<?php echo $user['country']; ?>" placeholder="Country">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="zipcodeInput" class="form-label">Zip Code</label>
                                                            <input type="text" class="form-control" id="zipcodeInput" name="zipcode" value="<?php echo $user['zipcode']; ?>" placeholder="Enter zipcode">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                            <button type="button" class="btn btn-soft-success">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- Success Modal -->
<!-- Success Modal with Custom Popup Effect -->
<div class="modal fade custom-popup" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Profile updated successfully!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

            </div>
    </div>
                <?php include 'layouts/footer.php'; ?>
            </div>
        </form>
    </div>
    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/pages/profile-setting.init.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>