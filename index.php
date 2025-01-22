<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Dashboard')); ?>
    <!-- plugin css -->
    <link href="assets/libs/jsvectormap/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <?php include 'layouts/head-css.php'; ?>
    <style>
        /* Hover effect for donation columns */
        .donation-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .donation-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<!-- Begin page -->
    <div id="layout-wrapper">
    <?php include 'layouts/menu.php'; ?>
    <div class="main-content">
    <div class="page-content">
    <div class="container-fluid"> 
    <div class="row">
    <div class="col-xxl-5">
    <div class="d-flex flex-column ">
    <div class="row h-100">
    <div class="col-12">
    <div class="card">
    <div class="card-body p-0">
    <div class="row align-items-end">
    <div class="col-sm-8">
    <div class="p-4">
    <p class="fs-16 lh-base">Your free trial expired in <span class="fw-semibold">17 days.</span> <i class="mdi mdi-arrow-right"></i></p>
    <div class="mt-3"><a href="pages-pricing.php"class="btn btn-success">Upgrade Account!</a></div>
    </div>
    </div>
    <div class="col-sm-4">
    <div class="px-3">
    <img src="assets/images/user-illustarator-2.png"class="img-fluid" alt="">
    </div>
    </div>
    </div>
    </div>
    </div> <!-- end card-body-->
    </div>
    </div> <!-- end col-->
    </div> <!-- end row-->

    <!-- Donation Cards Section -->
    <div class="row">
        <!-- Card 1 -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate donation-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Today Donation <br>Collection</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹ 100</h4>
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

        <!-- Card 2 -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate donation-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">This Week's <br>Donations</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹ 500</h4>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle rounded fs-3">
                                <i class="fas fa-hand-holding-usd text-warning"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate donation-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">This Month's <br>Donations</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹ 2,000</h4>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                <i class="fas fa-coins text-info"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate donation-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Yearly <br>Donations</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹ 10,000</h4>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-danger-subtle rounded fs-3">
                                <i class="fas fa-wallet text-danger"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row -->
    
    

   
    <div class="row">
    <!-- First Column with 2 Cards -->
    <div class="col-xl-6">
        <!-- First Card in First Column -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate donation-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Today Donation <br>Collection</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹ 100</h4>
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

        <!-- Second Card in First Column -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate donation-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Today Donation <br>Collection</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">₹ 100</h4>
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
    </div><!-- end first column -->

    <!-- Second Column -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Profit & Loss Summary</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row">
                    <!-- Income Section -->
                    <div class="col-6">
                        <div class="d-flex justify-content-between">
                            <p class="mb-0">Income</p>
                            <h5 class="mb-0 text-primary">₹ 80,000</h5> <!-- Dummy value -->
                        </div>
                    </div>
                    <!-- Expenses Section -->
                    <div class="col-6">
                        <div class="d-flex justify-content-between">
                            <p class="mb-0">Expenses</p>
                            <h5 class="mb-0 text-danger">₹ 30,000</h5> <!-- Dummy value -->
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <p class="mb-0">Net Profit/Loss</p>
                    <h5 class="mb-0 text-success">₹ 50,000</h5> <!-- Dummy value (Income - Expenses) -->
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end second column -->
</div><!-- end row -->


<!-- Add the following CSS for styling -->
<style>
    .text-success {
        color: #28a745 !important;
    }
    .text-danger {
        color: #dc3545 !important;
    }
    .text-primary {
        color: #007bff !important;
    }
    .text-info {
        color: #17a2b8 !important;
    }
    .text-warning {
        color: #ffc107 !important;
    }
</style>








    </div><!-- container-fluid -->
    </div><!-- End Page-content -->
    </div><!-- end main content-->
    </div><!-- END layout-wrapper -->

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
</html>
