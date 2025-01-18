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
    <!-- jQuery UI CSS and JS for Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
            border-bottom: 1px solid #ddd;
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

        .status-toggle-btn {
    padding: 8px 16px;
    font-size: 14px;
    font-weight: bold;
    color: #fff;
    background-color: #5865F2; /* Active state color */
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.status-toggle-btn.inactive {
    background-color: #FF4B4B; /* Inactive state color */
}

.status-toggle-btn:hover {
    opacity: 0.9; /* Slight opacity effect on hover */
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
                    <!-- Donation Records Table Card -->
                    <div class="card mt-5">       
                    <!-- Campaigns Section -->
                    <div class="campaign-section">
                        <div class="campaign-header">
                            <h3>Campaigns</h3>
                            <button class="create-campaign-btn">Update Campaign</button>
                        </div>
                    </div>
                    
                    <!-- Tabs Section -->
                    <div class="tabs">
                        <ul>
                            <li class="active">Active 24</li>
                            <li>Completed 179</li>
                        </ul>
                    </div>

                    <!-- New Campaign Count and Datepicker Section -->
                    <div class="campaign-count-section">
                        <span class="campaign-count">24 Campaigns</span>
                        <div class="datepicker-container">
                            <span>Select Date Range:</span>
                            <input type="text" id="datepicker" placeholder="Select Date" />
                        </div>
                    </div>

                    <!-- New Campaign Metrics Section -->
                    <div class="campaign-list">
                        <div class="campaign-item">
                        <div class="campaign-tag">
        W
    </div>
                            <!-- Campaign Details on First Row -->
                            <div class="campaign-details">
                                <h4>Special Offers for Loyal Customers</h4>
                                <p>Thank you for being our loyal customer! As a token of our appreciation...</p>
                            </div>
                            <!-- Campaign Actions on First Row -->
                            <div class="campaign-actions">
                            <button class="status-toggle-btn" onclick="toggleStatus(this)">Active</button>
                            </div>
                        </div>

                        <!-- Metrics Section on Second Row -->
                        <div class="metrics">
                            <p><strong>5.72K</strong><br>Delivered</p>
                            <p><strong>60.5%</strong><br>Opened</p>
                            <p><strong>17.7%</strong><br>Clicked</p>
                            <p><strong>1.2%</strong><br>Converted</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Initialize Datepicker -->
<script>
    $(document).ready(function() {
        // Initialize Datepicker for selecting range
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd MM yy",
            onSelect: function(selectedDate) {
                // You can handle the selected date here if needed
                console.log("Selected date: " + selectedDate);
            }
        });
    });
</script>

<script>
    function toggleStatus(button) {
    if (button.textContent === "Active") {
        button.textContent = "Inactive";
        button.classList.add("inactive");
    } else {
        button.textContent = "Active";
        button.classList.remove("inactive");
    }
}

</script>
<?php include 'layouts/vendor-scripts.php'; ?>
<!-- App js -->
<script src="assets/js/app.js"></script>
</body>
