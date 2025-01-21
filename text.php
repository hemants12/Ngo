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
        $res2 = mysqli_query($link, $query2);
        $totalAmount2 = 0;
        while ($data2 = mysqli_fetch_assoc($res2)) {
            $totalAmount2 += $data2['cam_amount'];
        }


        $total = $totalAmount + $totalAmount1 + 
        +1065 
        ;
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
        </head>
        <body>
            <div class="main-content"><!-- Display total donation amount for today -->
            <div class="alert alert-info"><h4>Total Amount Today: <strong>
                <?php echo number_format($total, 2); ?> </strong></h4><h4>Total Donations Today: <strong>
                    <?php echo number_format($totalAmount, 2); ?> </strong></h4></div><!-- Donation Table -->
                    <table id="reminderTable" class="display"><tbody>
  
        </tbody></table></div><!-- Memberships Table --><div class="main-content">
            <!-- Display total membership amount for today -->
             <div class="alert alert-info"><h4>Total Membership Amount Today: <strong>
                <?php echo number_format($totalAmount1, 2); ?> 
            </strong></h4></div><!-- Memberships Table --><table id="membershipTable" class="display">
               <tbody>
     
        </tbody></table></div><div class="main-content"><!-- Display total membership amount for today -->
            <div class="alert alert-info"><h4>Total Cam Amount Today: <strong>
                <?php echo number_format($totalAmount2, 2); ?> </strong></h4>
</div>
             <tbody>

    
        </tbody>
        </table>
        </div>
      </body>
      </html>