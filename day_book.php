<?php
include('config.php');

// Get today's date
$currentDate = date('Y-m-d');

// SQL query to get donations for today
$query = "SELECT * FROM donations WHERE DATE(created_at) = CURDATE()";
$res = mysqli_query($link, $query);

// Initialize total amount variable for donations
$totalAmount = 0;

// Fetch the donations and calculate the total amount
while ($data = mysqli_fetch_assoc($res)) {
    $totalAmount += $data['donationAmount'];
}

// SQL query to get memberships for today
$query1 = "SELECT * FROM memberships WHERE DATE(start_date) = CURDATE()";
$res1 = mysqli_query($link, $query1);

// Initialize total amount variable for memberships
$totalAmount1 = 0;

// Fetch the memberships and calculate the total amount
while ($data1 = mysqli_fetch_assoc($res1)) {
    $totalAmount1 += $data1['amount'];
}

$query2 = "SELECT * FROM campaigns WHERE DATE(created_at) = CURDATE()";
$res2   = mysqli_query($link,$query2);
$totalAmount2 = 0;
while($data2 = mysqli_fetch_assoc($res2)){
    $totalAmount2 += $data2['cam_amount'];
}


$total = $totalAmount + $totalAmount1 + $totalAmount2 ;





// insert code 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get POST data
    $expense_type = mysqli_real_escape_string($link, $_POST['expense_type']);
    $expense_amount = mysqli_real_escape_string($link, $_POST['expense_amount']);
    $date = date('Y-m-d');

    // Prepare the SQL query using a prepared statement to prevent SQL injection
    $insertQuery = $link->prepare("INSERT INTO tbl_expense (expense_type, expense_amount, date) VALUES (?, ?, ?)");
    $insertQuery->bind_param("sds", $expense_type, $expense_amount, $date); // 's' for string, 'd' for decimal (float)

    // Execute the query
    if ($insertQuery->execute()) {
        echo "Expense added successfully!";
    } else {
        echo "Error: " . $insertQuery->error;
    }

    // Close the prepared statement
    $insertQuery->close();
}

?>

<div class="main-content">
    <!-- Display total donation amount for today -->
    <div class="alert alert-info">
    
    <h4>Total Amount Today: <strong><?php echo number_format($total, 2); ?> </strong></h4>

        <h4>Total Donations Today: <strong><?php echo number_format($totalAmount, 2); ?> </strong></h4>
    </div>

    <!-- Donation Table -->
    <table id="reminderTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Donor Name</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display donation records for today
            mysqli_data_seek($res, 0); // Reset the result pointer
            while ($data = mysqli_fetch_assoc($res)) {
                echo "
                <tr>
                    <td>" . $data['id'] . "</td>
                    <td>" . $data['fullName'] . "</td>
                    <td>" . $data['donationAmount']. "</td>
                    <td>" . $data['created_at'] . "</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Memberships Table -->
<div class="main-content">
    <!-- Display total membership amount for today -->
    <div class="alert alert-info">
        <h4>Total Membership Amount Today: <strong><?php echo number_format($totalAmount1, 2); ?> </strong></h4>
    </div>

    <!-- Memberships Table -->
    <table id="membershipTable" class="display">
        <thead>
            <tr>
                <th>Membership ID</th>
                <th>Member Name</th>
                <th>Amount</th>
                <th>Start Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display membership records for today
            mysqli_data_seek($res1, 0); // Reset the result pointer
            while ($data1 = mysqli_fetch_assoc($res1)) {
                echo "
                <tr>
                    <td>" . $data1['membership_id'] . "</td>
                    <td>" . $data1['name'] . "</td>
                    <td>" . $data1['amount']. "</td>
                    <td>" . $data1['start_date'] . "</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<div class="main-content">
    <!-- Display total membership amount for today -->
    <div class="alert alert-info">
        <h4>Total Cam Amount Today: <strong><?php echo number_format($totalAmount2, 2); ?> </strong></h4>
    </div>

    <!-- Memberships Table -->
    <table id="membershipTable" class="display">
        <thead>
            <tr>
                <th>Membership ID</th>
                <th>Member Name</th>
                <th>Amount</th>
                <th>Start Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display membership records for today
            mysqli_data_seek($res2, 0); // Reset the result pointer
            while ($data2 = mysqli_fetch_assoc($res2)) {
                echo "
                <tr>
                    <td>" . $data2['id'] . "</td>
                    <td>" . $data2['name'] . "</td>
                    <td>" . $data2['cam_amount']. "</td>
                    <td>" . $data2['start_date'] . "</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Form</title>
</head>
<body>
    <!-- Form to submit expense details -->
    <form action="" method="POST">
        <label for="expense_type">Expense Type:</label>
        <input type="text" id="expense_type" name="expense_type" placeholder="Please Enter Title" required><br><br>

        <label for="expense_amount">Expense Amount:</label>
        <input type="text" id="expense_amount" name="expense_amount" placeholder="Please Enter Your Expense" required><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>

<script>    
    $(document).ready(function() {
        // Initialize DataTables for donation and membership tables
        $('#reminderTable').DataTable({
            "paging": true,
            "searching": true,
            "lengthChange": true,
            "info": true,
            "ordering": true,
            "responsive": true,
            "pageLength": 10,
            "lengthMenu": [5, 10, 25, 50, 100]
        });
        $('#membershipTable').DataTable({
            "paging": true,
            "searching": true,
            "lengthChange": true,
            "info": true,
            "ordering": true,
            "responsive": true,
            "pageLength": 10,
            "lengthMenu": [5, 10, 25, 50, 100]
        });
    });
</script>
