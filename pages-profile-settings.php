<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php 
include('config.php');



// $res = mysqli_query($link, 'SELECT * FROM users');


// while ($row = mysqli_fetch_assoc($res)) {
//     $data[] = $row;
// }

// print_r($data);
// die();


$query = "SELECT * FROM users";
$stmt = $link->prepare($query);

$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Profile Settings')); ?>

    <?php include 'layouts/head-css.php'; ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include 'layouts/menu.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <form action="update_user.php" method="POST">
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-3">
                            <div class="card mt-1">
                                <div class="card-body m-4">
                                    <div class="text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                            <img src="assets/images/users/download.png" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <h5 class="fs-16 mb-1"><?php echo $user['username'] ?? 'Guest'; ?></h5>
                                        <p class="text-muted mb-0">Ngo King Software</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
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
                                            <form action="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                    <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Full Name</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name='username' value="<?php echo $user['username'] ?? 'Guest'; ?>">
                                                        </div>

                                                    </div>
                                                    <!--end col-->
                                                
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                            <input type="text" class="form-control" id="phonenumberInput" name='number' value = "<?php echo $user['number']; ?>" placeholder="Enter your phone number" >
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Email Address</label>
                                                            <input type="email" class="form-control" id="emailInput"value = "<?php echo $user['useremail']; ?>"   placeholder="Enter your email" >
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                    <!-- <div class="mb-3">
                                                            <label for="JoiningdatInput" class="form-label">Joining Date</label>
                                                            <input type="text" class="form-control" data-provider="flatpickr" id="JoiningdatInput" data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
                                                        </div> -->
                                                    </div>
                                                    
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="designationInput" class="form-label">Designation</label>
                                                            <input type="text" class="form-control" id="designationInput" value = "<?php echo $user['designation']; ?>"  placeholder="Designation" >
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="websiteInput1" class="form-label">Website</label>
                                                            <input type="text" class="form-control" id="websiteInput1" value = "<?php echo $user['websiteurl']; ?>" placeholder="www.example.com" />
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="cityInput" class="form-label">City</label>
                                                            <input type="text" class="form-control" id="cityInput" value = "<?php echo $user['city']; ?>" placeholder="City" value="California" />
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="countryInput" class="form-label">Country</label>
                                                            <input type="text" class="form-control" id="countryInput" value = "<?php echo $user['country']; ?>" placeholder="Country" />
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="zipcodeInput" class="form-label">Zip Code</label>
                                                            <input type="text" class="form-control" minlength="5" maxlength="6" id="zipcodeInput" value = "<?php echo $user['zipcode']; ?>" placeholder="Enter zipcode" >
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                            <button type="button" class="btn btn-soft-success">Cancel</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                        <!--end tab-pane-->
                                     
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
            </div><!-- End Page-content -->

            <?php include 'layouts/footer.php'; ?>
        </div>
        </form>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <?php include 'layouts/customizer.php'; ?>

    <?php include 'layouts/vendor-scripts.php'; ?>

    <!-- profile-setting init js -->
    <script src="assets/js/pages/profile-setting.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>