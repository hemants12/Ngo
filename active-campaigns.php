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
    <style>

        .new-features-btn {
            padding: 10px 20px;
            background-color: #5865F2;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .campaign-section {
            background-color: #fff;
            padding: 5px 0 0 0;
            border-radius: 10px;
        }

        .campaign-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            margin-top: 20px;
        }
        .campaign-tag {
            background-color: #5865F2; /* Background color */
            color: #fff; /* Text color */
            padding: 8px 12px; /* Padding inside the box */
            border-radius: 8px; /* Rounded corners for the box */
            font-size: 14px; /* Font size */
            font-weight: bold; /* Bold text */
            display: inline-block; /* Ensures the box adjusts to the text size */
            margin-right: 15px; /* Space between the box and the campaign details */
            text-align: center; /* Centers the text inside */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional shadow for depth */
            border: 1px solid #4752C4; /* Optional border */
            }
            .create-campaign-btn {
                padding: 10px 20px;
                background-color: #5865F2;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .dropdown select {
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            .tabs ul {
                display: flex;
                list-style: none;
                margin-bottom: 20px;
                padding-left: 0;
            }

            .tabs li {
                padding: 10px 10px;
                cursor: pointer;
            }

            .tabs .active {
                border-bottom: 3px solid #5865F2;
            }

            .campaign-list {
                background-color: #fff;
                border-radius: 10px;
                overflow: hidden;
                margin-bottom: 20px;

            }

            .campaign-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
                border-top: 2px solid;
                flex-wrap: wrap; /* Allow wrapping to move the metrics to a new row */
            }

            .campaign-item:last-child {
                border-bottom: none;
            }

            .campaign-details {
                flex: 3;
            }

            .campaign-details h4 {
                font-size: 18px;
                margin: 0 0 5px;
                color: #333;
            }

            .campaign-details p {
                margin: 0;
                color: #666;
                font-size: 14px;
            }

            .metrics {
                flex: 1;
                display: flex;
                justify-content: space-around;
                width: 100%; /* Ensure metrics take up the full width */
                margin-top: 10px; /* Add spacing between rows */
                text-align: center;
             
                padding-bottom:20px;
            }

            .metrics p {
                margin: 0;
            }

            .metrics p strong {
                display: block;
                font-size: 16px;
                color: #333;
            }

            .campaign-actions {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                font-size: 14px;
                color: #666;
            }

  
            .campaign-date {
                color: #888;
                font-size: 12px;
            }
            .campaign-count-section {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                padding: 10px;
                border-radius: 8px;
            }

            .campaign-count {
                font-size: 18px;
                font-weight: bold;
            }

            .datepicker-container {
                display: flex;
                align-items: center;
            }

            .datepicker-container input {
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 5px;
                margin-left: 10px;
            }
           .status{
                 background-color: red;
                font-size: 16px;
                padding: 7px;
                border-radius: 5px;
                color: white;

           }
            @media (max-width: 768px) {
                .campaign-item {
                    flex-direction: column; /* Stack items for smaller screens */
                    align-items: flex-start;
                }

                .metrics {
                    flex-direction: column; /* Stack metrics vertically on smaller screens */
                }
                .campaign-count-section {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .datepicker-container {
                    margin-top: 10px;
                    width: 100%;
                }

                .datepicker-container input {
                    width: 100%;
                }
                .metrics {
                    display: grid; /* Change to grid layout for mobile screens */
            grid-template-columns: repeat(2, 1fr); /* Two metrics per row */
            gap: 10px; /* Add spacing between items */
            }
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
                        <div class="card mt-5">       
                            <div class="campaign-section">
                                <div class="card-header text-center">
                                    <h3>Campaigns</h3>
                                </div>
                            </div>
                            <div class="tabs">
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#active" role="tab" aria-selected="false">
                                                Active
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-bs-toggle="tab" href="#inactive" role="tab" aria-selected="false">
                                                Inactive
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#complete" role="tab" aria-selected="false">
                                            Complete
                                            </a>
                                        </li>
                                    </ul>
                                    <!--- Yeh Active Hai --->
                                    <div class="tab-content  text-muted">
                                        <div class="tab-pane active" id="active" role="tabpanel">

                                        <?php 
                            // Default to 'active' status if no filter is selected
                            $filterType = isset($_POST['filter']) ? $_POST['filter'] : 'active';

                            // Query to count the campaigns based on the selected filter (active/inactive)
                            $sql_count = "SELECT COUNT(*) AS campaign_count FROM campaigns WHERE status = '$filterType'";
                            $result_count = $link->query($sql_count);
                            $row_count = $result_count->fetch_assoc();
                            $campaignCount = $row_count['campaign_count'];
                            ?>

                            <div class="campaign-count-section">
                                <span class="campaign-count">Total <?php echo $campaignCount ?> <?php echo ucfirst($filterType) ?> Campaigns</span>
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
                                                <?php $type = $row['type']; echo strtoupper(substr($type, 0, 1)); ?>
                                            </div>
                                            <div class="campaign-details">
                                                <h4><?php echo htmlspecialchars($row['name']); ?></h4> 
                                                <p><?php echo htmlspecialchars($row['description']); ?></p> 
                                            </div>
                                            <div class="status"><?php echo $row['status']; ?></div>
                                        </div>
                                        <div class="metrics">
                                            <p><strong><?php echo htmlspecialchars($row['start_date']) ?></strong><br>Campaign Start</p>  
                                            <p><strong><?php echo htmlspecialchars($row['target_goal']) ?></strong><br>Target Goal</p>   
                                            
                                            <p><strong>
                                            <p><strong>
    <?php 
    // Fetching target goal and cam_amount from the database
    $targetGoal = (float) $row['target_goal']; // Cast to float
    $camAmount = (float) $row['cam_amount']; // Cast to float
    
    // Calculate the percentage of the goal achieved
    $percentageComplete = 0;
    if ($targetGoal > 0) {
        $percentageComplete = ($camAmount / $targetGoal) * 100;
    }
    
    // Display the percentage completed
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
        <span class="campaign-count">Total <?php echo $campaignCount ?> <?php echo ucfirst($filterType) ?> Campaigns</span>
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
                        <?php $type = $row['type']; echo strtoupper(substr($type, 0, 1)); ?>
                    </div>
                    <div class="campaign-details">
                        <h4><?php echo htmlspecialchars($row['name']); ?></h4> 
                        <p><?php echo htmlspecialchars($row['description']); ?></p> 
                    </div>
                    <div class="status"><?php echo $row['status']; ?></div>
                </div>
                <div class="metrics">
                    <p><strong><?php echo htmlspecialchars($row['start_date']) ?></strong><br>Campaign Start</p>  
                    <p><strong><?php echo htmlspecialchars($row['target_goal']) ?></strong><br>Target Goal</p>   
                    <p><strong>17.7%</strong><br>Complete</p>  

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
<!--- Yeh Complete Hai --->

<div class="tab-content text-muted">
    <div class="tab-pane" id="complete" role="tabpanel">

    <?php 
        // Query to count the campaigns where target_goal = cam_amount
        $sql_count = "SELECT COUNT(*) AS campaign_count FROM campaigns WHERE target_goal = cam_amount";
        $result_count = $link->query($sql_count);
        $row_count = $result_count->fetch_assoc();
        $campaignCount = $row_count['campaign_count'];
    ?>

    <div class="campaign-count-section">
        <span class="campaign-count">Total <?php echo $campaignCount ?> Complete Campaigns </span>
    </div>
    <div class="campaign-list" id="campaign-list-container">
        <?php
        // Query to fetch campaigns where target_goal = cam_amount
        $sql = "SELECT * FROM campaigns WHERE target_goal = cam_amount";
        $result = $link->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="campaign-item">
                    <div class="campaign-tag">
                        <?php $type = $row['type']; echo strtoupper(substr($type, 0, 1)); ?>
                    </div>
                    <div class="campaign-details">
                        <h4><?php echo htmlspecialchars($row['name']); ?></h4> 
                        <p><?php echo htmlspecialchars($row['description']); ?></p> 
                    </div>
                    <div class="status"><?php echo $row['status']; ?></div>
                </div>
                <div class="metrics">
                    <p><strong><?php echo htmlspecialchars($row['start_date']) ?></strong><br>Campaign Start</p>  
                    <p><strong><?php echo htmlspecialchars($row['target_goal']) ?></strong><br>Target Goal</p>   
                    <p><strong>17.7%</strong><br>Complete</p>  

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
            echo "<p>No campaigns found with matching target goal and cam amount.</p>";
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
        success: function(response) {
            // Update the campaign list container with the filtered content
            $('#campaign-list-container').html(response);
            
            // Update the active tab style
            $('.tabs ul li').removeClass('active');
            $('.tabs ul li').each(function() {
                if ($(this).text().toLowerCase() === filterType) {
                    $(this).addClass('active');
                }
            });
        },
        error: function() {
            console.error('Error filtering campaigns.');
        }
    });
}
</script>

<?php include 'layouts/vendor-scripts.php'; ?>
<!-- App js -->
<script src="assets/js/app.js"></script>
</body>
