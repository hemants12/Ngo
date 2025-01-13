<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Dashboard')); ?>
    <!-- plugin css -->
    <link href="assets/libs/jsvectormap/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <?php include 'layouts/head-css.php'; ?>
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
    <div class="d-flex flex-column h-50">
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
    </div> <!-- end card-body-->
    </div>
    </div> <!-- end col-->
    </div> <!-- end row-->
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