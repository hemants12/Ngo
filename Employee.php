<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'New Donation')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <div class="row h-100">
                    <div class="card">
                        <div class="Employee-section">
                            <div class="card-header text-center">
                                <h3>Employee Management</h3>
                            </div>
                            <div class="mt-3">
                                <div class="row g-3">
                                    <!-- Filter Section -->
                                    <div class="col-12 col-md-8 d-flex align-items-center">
                                        <label for="EmployeeFilter" class="me-2">Employee Status:</label>
                                        <select id="EmployeeFilter" class="form-select me-2" style="width: 30%;">
                                            <option value="">All</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                        <button id="filterButton" class="btn btn-primary me-2">Filter</button>
                                    </div>
                                    <!-- Add Employee Button -->
                                    <div class="col-12 col-md-4 d-flex justify-content-md-end">
                                        <button id="addEmployeeButton" class="btn btn-success w-60 w-md-auto" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add Employee</button>
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

<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add Employee Form -->
                <form id="addEmployeeForm">
                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="employeeName" required>
                    </div>
                    <div class="mb-3">
                        <label for="employeeEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="employeeEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="employeeAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="employeeAddress" required>
                    </div>
                    <div class="mb-3">
                        <label for="employeeDesignation" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="employeeDesignation" required>
                    </div>
                    <div class="mb-3">
                        <label for="Joiningdate" class="form-label">Joining Date</label>
                        <input type="date" class="form-control" id="Joiningdate" required>
                    </div>
                    <div class="mb-3">
                        <label for="employeeSalary" class="form-label">Salary</label>
                        <input type="number" class="form-control" id="employeeSalary" required>
                    </div>
                    <div class="mb-3">
                        <label for="employeeImage" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="employeeImage" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
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