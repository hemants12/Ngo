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
    <p class="fs-16 lh-base">Your free trial expired in <span class="fw-semibold">17  days.</span> <i class="mdi mdi-arrow-right"></i></p>
    <div class="mt-3"><a href="pages-pricing.php"class="btn btn-success">Upgrade Account!</a>
    </div>
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

    <!-- Total Donations Section -->
    <div class="row" style="margin-top:30px;">
        <div class="col-md-3">
            <div class="card donation-card">
                <div class="card-body">
                    <h5 class="card-title">Daily Donations</h5>
                    <h6 class="card-subtitle mb-2 text-muted">$500</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card donation-card">
                <div class="card-body">
                    <h5 class="card-title">Monthly Donations</h5>
                    <h6 class="card-subtitle mb-2 text-muted">$3,500</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card donation-card">
                <div class="card-body">
                    <h5 class="card-title">Yearly Donations</h5>
                    <h6 class="card-subtitle mb-2 text-muted">$12,000</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card donation-card">
                <div class="card-body">
                    <h5 class="card-title">Total Donations</h5>
                    <h6 class="card-subtitle mb-2 text-muted">$150,000</h6>
                </div>
            </div>
        </div>
    </div> <!-- End Total Donations Section -->
    <!-- Table Dark -->
<!-- <table class="table table-striped table-nowrap">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Customer</th>
            <th scope="col">Date</th>
            <th scope="col">Invoice</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Bobby Davis</td>
            <td>Nov 14, 2021</td>
            <td>$2,410</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Christopher Neal</td>
            <td>Nov 21, 2021</td>
            <td>$1,450</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Monkey Karry</td>
            <td>Nov 24, 2021</td>
            <td>$3,500</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>Aaron James</td>
            <td>Nov 25, 2021</td>
            <td>$6,875</td>
        </tr>
    </tbody>
</table> -->
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
