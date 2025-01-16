<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
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
                                <form method="post" action="">
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
