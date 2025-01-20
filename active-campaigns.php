    <?php include 'layouts/session.php'; ?>
    <?php include 'layouts/main.php'; ?>
    <head>
        <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'New Donation')); ?>
        <?php include 'layouts/head-css.php'; ?>
        <link rel="stylesheet" href="assets/css/custom.css">
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
                                <div class="card mt-5" id="">
                                    <div class="campaign-section">
                                        <div class="card-header text-center">
                                            <h3>Campaigns</h3>
                                        </div>
                                    </div>
                                    <div class="tabs">
                                        <ul class="nav nav-tabs mb-3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#active" role="tab"
                                                    aria-selected="false">
                                                    Active
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " data-bs-toggle="tab" href="#inactive" role="tab"
                                                    aria-selected="false">
                                                    Inactive
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#complete" role="tab"
                                                    aria-selected="false">
                                                    Complete
                                                </a>
                                            </li>
                                        </ul>
                                        <!--- Yeh Active Hai --->
                                        <div class="tab-content text-muted">
                                            <div class="tab-pane active" id="active" role="tabpanel">
                                                <?php
                                                // Update expired campaigns to 'inactive'
                                                $updateExpiredCampaigns = "UPDATE campaigns SET status = 'inactive' WHERE end_date < CURDATE() AND status = 'active'";
                                                $link->query($updateExpiredCampaigns);
                                                // Update campaigns to 'complete' if cam_amount >= target_goal
                                                $updateCompletedCampaigns = "UPDATE campaigns SET status = 'complete' WHERE cam_amount >= target_goal AND status != 'complete'";
                                                $link->query($updateCompletedCampaigns);
                                                // Default to 'active' status if no filter is selected
                                                $filterType = isset($_POST['filter']) ? $_POST['filter'] : 'active';
                                                // Query to count the campaigns based on the selected filter (active/inactive/complete)
                                                $sql_count = "SELECT COUNT(*) AS campaign_count FROM campaigns WHERE status = '$filterType'";
                                                $result_count = $link->query($sql_count);
                                                $row_count = $result_count->fetch_assoc();
                                                $campaignCount = $row_count['campaign_count'];
                                                ?>
                                                <div class="campaign-count-section">
                                                    <span class="campaign-count">Total
                                                        <?php echo $campaignCount ?>
                                                        <?php echo ucfirst($filterType) ?> Campaigns
                                                    </span>
                                                </div>
                                                <div class="campaign-list" id="campaign-list-container">
                                                    <?php
                                                    // Query to fetch campaigns based on selected filter status
                                                    $sql = "SELECT * FROM campaigns WHERE status = '$filterType'";
                                                    $result = $link->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                    <div class="campaign-item">
                                                        <div class="campaign-tag">
                                                            <?php $type = $row['type'];
                                                            echo strtoupper(substr($type, 0, 1)); ?>
                                                        </div>
                                                        <div class="campaign-details">
                                                            <h4>
                                                                <?php echo htmlspecialchars($row['name']); ?>
                                                            </h4>
                                                            <p>
                                                                <?php echo htmlspecialchars(ucfirst($row['type'])); ?>
                                                            </p>
                                                        </div>
                                                        <div class="status">
                                                            <?php echo $row['status']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="metrics">
                                                        <p><strong>
                                                                <?php echo htmlspecialchars($row['start_date']) ?>
                                                            </strong><br>Campaign Start</p>
                                                        <p><strong>
                                                                <?php echo htmlspecialchars($row['target_goal']); ?>
                                                            </strong><br>Target Goal</p>
                                                        <p><strong>
                                                                <?php
                                                                $targetGoal = (float) $row['target_goal']; // Cast to float
                                                                $camAmount = (float) $row['cam_amount']; // Cast to float
                                                                $percentageComplete = 0;
                                                                if ($targetGoal > 0) {
                                                                    $percentageComplete = ($camAmount / $targetGoal) * 100;
                                                                }
                                                                echo number_format($percentageComplete, 2) . "%";
                                                                ?>
                                                            </strong><br>Complete</p>
                                                        <?php
                                                        $endDate = $row['end_date'];
                                                        $endDateTime = new DateTime($endDate);
                                                        $currentDate = new DateTime();
                                                        $interval = $currentDate->diff($endDateTime);
                                                        if ($currentDate < $endDateTime) {
                                                            echo "<p><strong>" . htmlspecialchars($endDate) . "</strong><br>";
                                                            echo "Expires in " . $interval->days . " days</p>";
                                                        } else {
                                                            echo "<p><strong>" . htmlspecialchars($endDate) . "</strong><br>";
                                                            echo "Expired " . $interval->days . " days ago</p>";
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "<p>No campaigns found.</p>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!--- Yeh Inactive Hai --->
                                        <div class="tab-content text-muted">
                                            <div class="tab-pane" id="inactive" role="tabpanel">
                                                <?php
                                                // Check if 'filter' is set in POST data, default to 'inactive'
                                                $filterType = isset($_POST['filter']) ? $_POST['filter'] : 'inactive';
                                                // Query to count the campaigns based on the selected filter (active/inactive)
                                                $sql_count = "SELECT COUNT(*) AS campaign_count FROM campaigns WHERE status = '$filterType'";
                                                $result_count = $link->query($sql_count);
                                                $row_count = $result_count->fetch_assoc();
                                                $campaignCount = $row_count['campaign_count'];
                                                ?>
                                                <div class="campaign-count-section">
                                                    <span class="campaign-count">Total
                                                        <?php echo $campaignCount ?>
                                                        <?php echo ucfirst($filterType) ?> Campaigns
                                                    </span>
                                                </div>
                                                <div class="campaign-list" id="campaign-list-container">
                                                    <?php
                                                    // Query to fetch campaigns based on selected filter status
                                                    $sql = "SELECT * FROM campaigns WHERE status = '$filterType'";
                                                    $result = $link->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                    <div class="campaign-item">
                                                        <div class="campaign-tag">
                                                            <?php $type = $row['type'];
                                                            echo strtoupper(substr($type, 0, 1)); ?>
                                                        </div>
                                                        <div class="campaign-details">
                                                            <h4>
                                                                <?php echo htmlspecialchars($row['name']); ?>
                                                            </h4>
                                                            <p>
                                                                <?php echo htmlspecialchars(ucfirst($row['type'])); ?>
                                                            </p>
                                                        </div>
                                                        <!-- <div class="status"><?php echo $row['status']; ?></div> -->
                                                                <div class="status">
                                                                    <!-- Link to the edit page, passing campaign ID as a query parameter -->
                                                                    <a href="edit_campaign.php?id=<?php echo $row['id']; ?>"
                                                                        class="status">
                                                                        <?php echo htmlspecialchars($row['status']); ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="metrics">
                                                                <p><strong><?php echo htmlspecialchars($row['start_date']) ?></strong><br>Campaign
                                                                    Start</p>
                                                                <p><strong><?php echo htmlspecialchars($row['target_goal']) ?></strong><br>Target
                                                                    Goal</p>
                                                                <p><strong>
                                                                        <?php
                                                                        $targetGoal = (float) $row['target_goal']; // Cast to float
                                                                        $camAmount = (float) $row['cam_amount']; // Cast to float
                                                                        $percentageComplete = 0;
                                                                        if ($targetGoal > 0) {
                                                                            $percentageComplete = ($camAmount / $targetGoal) * 100;
                                                                        }
                                                                        echo number_format($percentageComplete, 2) . "%";
                                                                        ?>
                                                                    </strong><br>Complete</p>
                                                                <?php
                                                                $endDate = $row['end_date'];
                                                                $endDateTime = new DateTime($endDate);
                                                                $currentDate = new DateTime();
                                                                $interval = $currentDate->diff($endDateTime);
                                                                if ($currentDate < $endDateTime) {
                                                                    echo "<p><strong>" . htmlspecialchars($endDate) . "</strong><br>";
                                                                    echo "Expires in " . $interval->days . " days</p>";
                                                                } else {
                                                                    echo "<p><strong>" . htmlspecialchars($endDate) . "</strong><br>";
                                                                    // echo "Expired " . $interval->days . " days ago</p>";
                                                                }
                                                                ?>
                                                            </div>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo "<p>No campaigns found.</p>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!--- Yeh Complete Hai --->
                                        <div class="tab-content text-muted">
                                            <div class="tab-pane" id="complete" role="tabpanel">
                                                <?php
                                                // Query to count the campaigns where cam_amount >= target_goal
                                                $sql_count = "SELECT COUNT(*) AS campaign_count FROM campaigns WHERE cam_amount >= target_goal";
                                                $result_count = $link->query($sql_count);
                                                $row_count = $result_count->fetch_assoc();
                                                $campaignCount = $row_count['campaign_count'];
                                                ?>
                                                <div class="campaign-count-section">
                                                    <span class="campaign-count">Total
                                                        <?php echo $campaignCount ?> Complete Campaigns
                                                    </span>
                                                </div>
                                                <div class="campaign-list" id="campaign-list-container">
                                                    <?php
                                                    // Query to fetch campaigns where cam_amount >= target_goal
                                                    $sql = "SELECT * FROM campaigns WHERE cam_amount >= target_goal";
                                                    $result = $link->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                    <div class="campaign-item">
                                                        <div class="campaign-tag">
                                                            <?php $type = $row['type'];
                                                            echo strtoupper(substr($type, 0, 1)); ?>
                                                        </div>
                                                        <div class="campaign-details">
                                                            <h4>
                                                                <?php echo htmlspecialchars($row['name']); ?>
                                                            </h4>
                                                            <p>
                                                                <?php echo htmlspecialchars(ucfirst($row['type'])); ?>
                                                            </p>
                                                        </div>
                                                        <div class="status">
                                                            <?php echo htmlspecialchars($row['status']); ?>
                                                        </div>
                                                    </div>
                                                    <div class="metrics">
                                                        <p><strong>
                                                                <?php echo htmlspecialchars($row['start_date']) ?>
                                                            </strong><br>Campaign Start</p>
                                                        <p><strong>
                                                                <?php echo htmlspecialchars($row['target_goal']); ?>
                                                            </strong><br>Target Goal</p>
                                                        <p><strong>
                                                                <?php echo htmlspecialchars($row['cam_amount']); ?>
                                                            </strong><br>Amount Received</p>
                                                        <p><strong>
                                                                <?php
                                                                $targetGoal = (float) $row['target_goal']; // Cast to float
                                                                $camAmount = (float) $row['cam_amount']; // Cast to float
                                                                $percentageComplete = 0;
                                                                if ($targetGoal > 0) {
                                                                    $percentageComplete = ($camAmount / $targetGoal) * 100;
                                                                }
                                                                echo number_format($percentageComplete, 2) . "%";
                                                                ?>
                                                            </strong><br>Complete</p>
                                                        <?php
                                                        $endDate = $row['end_date'];
                                                        $endDateTime = new DateTime($endDate);
                                                        $currentDate = new DateTime();
                                                        $interval = $currentDate->diff($endDateTime);
                                                        if ($currentDate < $endDateTime) {
                                                            echo "<p><strong>" . htmlspecialchars($endDate) . "</strong><br>";
                                                            echo "Expires in " . $interval->days . " days</p>";
                                                        } else {
                                                            echo "<p><strong>" . htmlspecialchars($endDate) . "</strong><br>";
                                                            echo "Expired " . $interval->days . " days ago</p>";
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "<p>No campaigns found with matching or exceeding target goal and cam amount.</p>";
                                                    }
                                                    ?>
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
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <script>
            // Function to filter campaigns based on the selected status
            function filterCampaigns(filterType) {
                // Send the selected filter type via POST to reload the page with the filtered data
                $.ajax({
                    url: '', // Same page
                    type: 'POST',
                    data: { filter: filterType },
                    success: function (response) {
                        // Update the campaign list container with the filtered content
                        $('#campaign-list-container').html(response);
                        // Update the active tab style
                        $('.tabs ul li').removeClass('active');
                        $('.tabs ul li').each(function () {
                            if ($(this).text().toLowerCase() === filterType) {
                                $(this).addClass('active');
                            }
                        });
                    },
                    error: function () {
                        console.error('Error filtering campaigns.');
                    }
                });
            }
        </script>
      
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