<?php
// Include the database connection file
include 'Config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign form data to variables
    $campaignName = mysqli_real_escape_string($link, $_POST['campaignName']);
    $campaignType = mysqli_real_escape_string($link, $_POST['campaignType']);
    $startDate = mysqli_real_escape_string($link, $_POST['startDate']);
    $endDate = mysqli_real_escape_string($link, $_POST['endDate']);
    $campaignDescription = mysqli_real_escape_string($link, $_POST['campaignDescription']);
    $targetGoal = mysqli_real_escape_string($link, $_POST['targetGoal']);
    $campaignStatus = mysqli_real_escape_string($link, $_POST['campaignStatus']);

    // Handle the file upload for the image
    $campaignImage = $_FILES['campaignImage']['name'];
    $imageTmpName = $_FILES['campaignImage']['tmp_name'];
    $imageSize = $_FILES['campaignImage']['size'];
    $imageError = $_FILES['campaignImage']['error'];
    $imageType = $_FILES['campaignImage']['type'];

    // Check for image upload errors
    if ($imageError === 0) {
        // Generate a unique name for the image file
        $imageNewName = time() . '_' . $campaignImage;
        $imageDestination = 'uploads/' . $imageNewName;

        // Check file type (only allow images)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($imageType, $allowedTypes)) {
            // Move the uploaded image to the specified directory
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                // Insert data into the database
                $query = "INSERT INTO campaigns (name, type, start_date, end_date, description, target_goal, image, status) 
                      VALUES ('$campaignName', '$campaignType', '$startDate', '$endDate', '$campaignDescription', '$targetGoal', '$imageNewName', '$campaignStatus')";

                // Debug: print query for debugging purposes
                // echo $query;

                // Execute the query and check for errors
                if (mysqli_query($link, $query)) {
                    $successMessage = "Campaign created successfully!";
                } else {
                    // Capture any error in the query execution
                    $errorMessage = "Error: " . mysqli_error($link);
                }
            } else {
                $errorMessage = "Failed to upload the image.";
            }
        } else {
            $errorMessage = "Error: Only image files are allowed.";
        }
    } else {
        $errorMessage = "Error: Failed to upload the image. Error code: " . $imageError;
    }
}
?>

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'New Donation')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <style>
        .form-group {
            margin-bottom: 20px;
            /* Adjust the value as needed */
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
                            <div class="col-md-12 mx-auto">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Create a New Campaign</h4>
                                    </div>
                                    <div class="card-body">


                                        <!-- The Campaign Form (same as before) -->

                                    </div>
                                </div>
                            </div>
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
    </div>
</body>