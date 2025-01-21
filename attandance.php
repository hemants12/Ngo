<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Staff Attendance')); ?>
    <?php include 'layouts/head-css.php'; ?>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="d-flex flex-column">
                        <div class="row h-100">
                            <!-- Current Date Display -->
                            <div class="mt-3 d-flex align-items-center">
                                <h5 class="me-2">Today's Date: <?php echo date('d-m-Y'); ?></h5>
                            </div>

                            <!-- Staff Records Table Card -->
                            <div class="card mt-3">
                                <div class="card-header text-center">
                                    <h3>Daily Attendance</h3>
                                </div>
                                <?php if (isset($_SESSION['success'])): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $_SESSION['success'];
                                        unset($_SESSION['success']); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="card-body">
                                    <?php
                                    // Include database connection
                                    include('Config.php');

                                    // Get current date
                                    $currentDate = date('Y-m-d');

                                    // Query to get staff records
                                    $sql = "SELECT s.*, a.status as today_status 
                                   FROM staff s 
                                   LEFT JOIN attendance a ON s.id = a.staff_id 
                                   AND a.date = '$currentDate'";
                                    $result = $link->query($sql);

                                    if ($result && $result->num_rows > 0) {
                                        echo "<div class='table-responsive'>
                                        <table id='staffTable' class='table table-bordered'>
                                            <thead>
                                                <tr>
                                                <th>ID</th>
                                                <th>Full Name</th>
                                                <th>Mobile</th>
                                                <th>Designation</th>
                                                <th>Today's Attendance</th>
                                                <th>Monthly Status</th>
                                                <th>Actual Salary</th>
                                                </tr>
                                            </thead>
                                            <tbody>";

                                        while ($row = $result->fetch_assoc()) {
                                            // Get attendance stats for current month
                                            $staffId = $row['id'];
                                            $month = date('m');
                                            $year = date('Y');

                                            // Query to get attendance count
                                            $attendanceQuery = "SELECT 
                                        SUM(CASE WHEN status = 'P' THEN 1 ELSE 0 END) as present_days,
                                        SUM(CASE WHEN status = 'A' THEN 1 ELSE 0 END) as absent_days,
                                        SUM(CASE WHEN status = 'L' THEN 1 ELSE 0 END) as leave_days
                                        FROM attendance 
                                        WHERE staff_id = $staffId 
                                        AND MONTH(date) = $month 
                                        AND YEAR(date) = $year";

                                            $attendanceResult = $link->query($attendanceQuery);
                                            $attendance = $attendanceResult->fetch_assoc();

                                            // Calculate actual salary based on attendance
                                            $workingDays = date('t'); // Total days in current month
                                            $perDaySalary = $row['salary'] / $workingDays;
                                            $actualSalary = $perDaySalary * ($attendance['present_days'] ?? 0);

                                            // Get button classes based on current status
                                            $pClass = ($row['today_status'] == 'P') ? 'btn-success active' : 'btn-outline-success';
                                            $aClass = ($row['today_status'] == 'A') ? 'btn-danger active' : 'btn-outline-danger';
                                            $lClass = ($row['today_status'] == 'L') ? 'btn-warning active' : 'btn-outline-warning';

                                            echo "<tr>
                                            <td>" . htmlspecialchars($row['id']) . "</td>
                                            <td>" . htmlspecialchars($row['fullname']) . "</td>
                                            <td>" . htmlspecialchars($row['mobile']) . "</td>
                                            <td>" . htmlspecialchars($row['designation']) . "</td>
                                            <td>
                                                <div class='btn-group' role='group'>
                                                    <button type='button' class='btn btn-sm attendance-btn $pClass' 
                                                            data-staff-id='" . $row['id'] . "' data-status='P'>P</button>
                                                    <button type='button' class='btn btn-sm attendance-btn $aClass' 
                                                            data-staff-id='" . $row['id'] . "' data-status='A'>A</button>
                                                    <button type='button' class='btn btn-sm attendance-btn $lClass' 
                                                            data-staff-id='" . $row['id'] . "' data-status='L'>L</button>
                                                </div>
                                            </td>
                                            <td>
                                                P: " . ($attendance['present_days'] ?? 0) . " | 
                                                A: " . ($attendance['absent_days'] ?? 0) . " | 
                                                L: " . ($attendance['leave_days'] ?? 0) . "
                                            </td>
                                            <td>₹" . number_format($actualSalary, 2) . "</td>
                                          </tr>";
                                        }

                                        echo "</tbody>
                                    </table>
                                  </div>";
                                    } else {
                                        echo "No records found.";
                                    }

                                    $link->close();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Initialize DataTables and Attendance Handling -->
        <script>
            $(document).ready(function() {
                const table = $('#staffTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                    "pageLength": 10,
                    "lengthMenu": [5, 10, 25, 50, 100]
                });

                // Handle attendance button clicks
                $('.attendance-btn').on('click', function() {
                    const staffId = $(this).data('staff-id');
                    const status = $(this).data('status');
                    const today = new Date().toISOString().split('T')[0];

                    // Send attendance data to server
                    $.ajax({
                        url: 'mark_attendance.php',
                        method: 'POST',
                        data: {
                            staff_id: staffId,
                            status: status,
                            date: today
                        },
                        success: function(response) {
                            // Reload page to update statistics
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            alert('Error marking attendance: ' + error);
                        }
                    });
                });
            });
        </script>

        <?php include 'layouts/vendor-scripts.php'; ?>
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
        <script src="assets/libs/jsvectormap/jsvectormap.min.js"></script>
        <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>
        <script src="assets/js/pages/dashboard-analytics.init.js"></script>
        <script src="assets/js/app.js"></script>
</body>