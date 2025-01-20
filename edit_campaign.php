<?php
include 'layouts/session.php';
include 'layouts/main.php';

// Database connection
include 'config.php';

// Initialize variables
$campaignData = null;
$errorMessage = '';
$successMessage = '';

// Check if `id` is passed in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch campaign data from the database
    $sql = "SELECT * FROM campaigns WHERE id = $id";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        $campaignData = $result->fetch_assoc();
    } else {
        $errorMessage = "Campaign not found.";
    }
}

// Handle form submission for updating the campaign
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campaignName = $_POST['campaignName'];
    $campaignType = $_POST['campaignType'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $campaignDescription = $_POST['campaignDescription'];
    $targetGoal = $_POST['targetGoal'];
    $campaignStatus = $_POST['campaignStatus'];

    // Handle image upload
    if (isset($_FILES['campaignImage']) && $_FILES['campaignImage']['error'] == 0) {
        $imageName = $_FILES['campaignImage']['name'];
        $imageTempPath = $_FILES['campaignImage']['tmp_name'];
        $imagePath = "uploads/" . $imageName;
        move_uploaded_file($imageTempPath, $imagePath);
    } else {
        $imagePath = $campaignData['image'] ?? ''; // Keep the old image if not updated
    }

    // Update the campaign in the database
    $sqlUpdate = "UPDATE campaigns SET 
                  name = '$campaignName', 
                  type = '$campaignType', 
                  start_date = '$startDate', 
                  end_date = '$endDate', 
                  description = '$campaignDescription', 
                  target_goal = $targetGoal, 
                  status = '$campaignStatus',
                  image = '$imagePath'
                  WHERE id = $id";

    if ($link->query($sqlUpdate)) {
        $successMessage = "Campaign updated successfully.";
        header('Location: active-campaigns.php');
    } else {
        $errorMessage = "Error updating campaign: " . $link->error;
    }
}
?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Edit Campaign')); ?>
    <?php include 'layouts/head-css.php'; ?>
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
                                        <h4>Edit Campaign</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        // Display success or error message
                                        if (!empty($successMessage)) {
                                            echo "<div class='alert alert-success'>$successMessage</div>";
                                        } elseif (!empty($errorMessage)) {
                                            echo "<div class='alert alert-danger'>$errorMessage</div>";
                                        }

                                        if ($campaignData) {
                                        ?>
                                            <!-- Edit Campaign Form -->
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="campaignName">Campaign Name</label>
                                                    <input type="text" class="form-control" id="campaignName"
                                                        name="campaignName"
                                                        value="<?php echo htmlspecialchars($campaignData['name']); ?>"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="campaignType">Campaign Type</label>
                                                    <select class="form-control" id="campaignType" name="campaignType"
                                                        required>
                                                        <option value="fundraiser" <?php if ($campaignData['type'] == 'fundraiser')
                                                                                        echo 'selected'; ?>>
                                                            Fundraiser</option>
                                                        <option value="petition" <?php if ($campaignData['type'] == 'petition')
                                                                                        echo 'selected'; ?>>Petition
                                                        </option>
                                                        <option value="awareness" <?php if ($campaignData['type'] == 'awareness')
                                                                                        echo 'selected'; ?>>
                                                            Awareness</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="startDate">Start Date</label>
                                                    <input type="date" class="form-control" id="startDate" name="startDate"
                                                        value="<?php echo htmlspecialchars($campaignData['start_date']); ?>"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="endDate">End Date</label>
                                                    <input type="date" class="form-control" id="endDate" name="endDate"
                                                        value="<?php echo htmlspecialchars($campaignData['end_date']); ?>"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="campaignDescription">Campaign Description</label>
                                                    <textarea class="form-control" id="campaignDescription"
                                                        name="campaignDescription" rows="4"
                                                        required><?php echo htmlspecialchars($campaignData['description']); ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="targetGoal">Target Goal</label>
                                                    <input type="number" class="form-control" id="targetGoal"
                                                        name="targetGoal"
                                                        value="<?php echo htmlspecialchars($campaignData['target_goal']); ?>"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="campaignImage">Upload Campaign Image</label>
                                                    <input type="file" class="form-control" id="campaignImage"
                                                        name="campaignImage" accept="image/*">
                                                    <p>Current Image: <a href="<?php echo $campaignData['image']; ?>"
                                                            target="_blank">View</a></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="campaignStatus">Status</label>
                                                    <select class="form-control" id="campaignStatus" name="campaignStatus"
                                                        required>
                                                        <option value="active" <?php if ($campaignData['status'] == 'active')
                                                                                    echo 'selected'; ?>>Active</option>
                                                        <option value="inactive" <?php if ($campaignData['status'] == 'inactive')
                                                                                        echo 'selected'; ?>>
                                                            Inactive</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Update Campaign</button>
                                            </form>
                                        <?php
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
        <?php include 'layouts/vendor-scripts.php'; ?>
</body>