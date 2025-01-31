<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Reminder')); ?>
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
                    <!-- Reminder Table Card -->
                    <div class="card mt-3">
                        <div class="card-header text-center">
                            <h3>Upcoming Expirations (Next 30 Days)</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            include('Config.php');
                            $currentDate = date('Y-m-d');
                            $sql = "SELECT * FROM memberships 
                                    WHERE end_date BETWEEN '$currentDate' AND DATE_ADD('$currentDate', INTERVAL 30 DAY)";
                            $result = $link->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<div class='table-responsive'>
                                        <table id='reminderTable' class='table table-bordered'>
                                            <thead>
                                                <tr>
                                                <th>Name</th>
                                                <th>Membership Type</th>
                                                <th>Mobile</th>
                                                <th>Amount</th>
                                                <th>End Date</th>
                                                <th>Send</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['membership_type'] . "</td>
                                            <td>" . $row['phonenumber'] . "</td>
                                            <td>" . $row['amount'] . "</td>
                                            <td>" . $row['end_date'] . "</td>
                                            <td>
                                                <button class='btn btn-primary send-btn' 
                                                        data-phonenumber='" . $row['phonenumber'] . "' 
                                                        data-name='" . $row['name'] . "' 
                                                        data-enddate='" . $row['end_date'] . "'>
                                                    Send
                                                </button>
                                            </td>
                                          </tr>";
                                }

                                echo "</tbody>
                                    </table>
                                  </div>";
                            } else {
                                echo "<p class='text-center'>No upcoming expirations within the next 30 days.</p>";
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

<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
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

        // Handle SMS sending
        $(document).on('click', '.send-btn', function() {
            var phoneNumber = $(this).data('phonenumber');
            var name = $(this).data('name');
            var endDate = $(this).data('enddate');

            if (confirm('Are you sure you want to send an SMS to ' + name + ' (' + phoneNumber + ')?')) {
                $.ajax({
                    url: 'send_sms.php',
                    type: 'POST',
                    data: {
                        phonenumber: phoneNumber,
                        name: name,
                        enddate: endDate
                    },
                    success: function(response) {
                        alert(response);
                    },
                    error: function() {
                        alert('Failed to send SMS. Please try again.');
                    }
                });
            }
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





<!-- <script>
$(document).on('click', '.send-btn', function() {
    var phoneNumber = $(this).data('phonenumber');
    var name = $(this).data('name');
    var endDate = $(this).data('enddate');
    var message = "Dear " + name + ", your membership is set to expire on " + endDate + ". Please renew to avoid interruption.";

    // AJAX call to send the message
    $.ajax({
        url: 'send_sms.php',  // PHP file to handle the SMS sending
        type: 'POST',
        data: {
            phoneNumber: phoneNumber,
            message: message
        },
        success: function(response) {
            alert('Message sent successfully!');
        },
        error: function() {
            alert('Failed to send the message. Please try again later.');
        }
    });
});
</script> -->
<?php

// $apiUrl = "https://api.whatsapp.com/send";
// $authToken = "YOUR_AUTH_TOKEN"; 

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $phoneNumber = $_POST['phonenumber'];
//     $message = $_POST['message'];

    
//     $data = [
//         'phone' => $phoneNumber,
//         'body' => $message,
//     ];

//     $ch = curl_init($apiUrl);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, [
//         "Authorization: Bearer $authToken",
//         "Content-Type: application/json"
//     ]);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

//     $response = curl_exec($ch);
//     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     curl_close($ch);

//     if ($httpCode == 200) {
//         echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!']);
//     } else {
//         echo json_encode(['status' => 'error', 'message' => 'Failed to send message.']);
//     }
// }




// Updated Code:
// Back-End (sendMessage.php)
// php
// Copy
// Edit
// <?php
// // WhatsApp API credentials
// $apiUrl = "https://api.whatsapp.com/send";
// $authToken = "YOUR_AUTH_TOKEN"; // Replace with your API token or credentials

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $phoneNumber = $_POST['phonenumber'];
//     $message = $_POST['message'];

//     // Prepare the API request
//     $data = [
//         'phone' => $phoneNumber,
//         'body' => $message,
//     ];

//     $ch = curl_init($apiUrl);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, [
//         "Authorization: Bearer $authToken",
//         "Content-Type: application/json"
//     ]);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

//     $response = curl_exec($ch);
//     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     curl_close($ch);

//     if ($httpCode == 200) {
//         echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!']);
//     } else {
//         echo json_encode(['status' => 'error', 'message' => 'Failed to send message.']);
//     }
// }
// Front-End (Modified HTML with JavaScript)

// <div class="card-body">
//     <?php
//     include('Config.php');
//     $currentDate = date('Y-m-d');
//     $sql = "SELECT * FROM memberships WHERE end_date BETWEEN '$currentDate' AND DATE_ADD('$currentDate', INTERVAL 30 DAY)";
//     $result = $link->query($sql);

//     if ($result->num_rows > 0) {
//         echo "<div class='table-responsive'>
//                 <table id='reminderTable' class='table table-bordered'>
//                     <thead>
//                         <tr>
//                             <th>Name</th>
//                             <th>Membership Type</th>
//                             <th>Mobile</th>
//                             <th>Amount</th>
//                             <th>End Date</th>
//                             <th>Send</th>
//                         </tr>
//                     </thead>
//                     <tbody>";

//         while ($row = $result->fetch_assoc()) {
//             echo "<tr>
//                     <td>" . $row['name'] . "</td>
//                     <td>" . $row['membership_type'] . "</td>
//                     <td>" . $row['phonenumber'] . "</td>
//                     <td>" . $row['amount'] . "</td>
//                     <td>" . $row['end_date'] . "</td>
//                     <td>
//                         <button class='btn btn-primary send-btn' data-phonenumber='" . $row['phonenumber'] . "' data-name='" . $row['name'] . "' data-enddate='" . $row['end_date'] . "'>
//                             Send
//                         </button>
//                     </td>
//                   </tr>";
//         }

//         echo "</tbody>
//             </table>
//           </div>";
//     } else {
//         echo "<p class='text-center'>No upcoming expirations within the next 30 days.</p>";
//     }

//     $link->close();
//     ?>
// </div>

// <script>
//     $(document).ready(function () {
//         $('#reminderTable').DataTable({
//             paging: true,
//             searching: true,
//             lengthChange: true,
//             info: true,
//             ordering: true,
//             responsive: true,
//             pageLength: 10,
//             lengthMenu: [5, 10, 25, 50, 100]
//         });

//         // Handle the send button click
//         $('.send-btn').on('click', function () {
//             const phoneNumber = $(this).data('phonenumber');
//             const name = $(this).data('name');
//             const endDate = $(this).data('enddate');
//             const message = `Dear ${name}, your membership is ending on ${endDate}. Please renew it soon!`;

//             $.ajax({
//                 url: 'sendMessage.php',
//                 type: 'POST',
//                 data: { phonenumber: phoneNumber, message: message },
//                 success: function (response) {
//                     const res = JSON.parse(response);
//                     if (res.status === 'success') {
//                         alert(res.message);
//                     } else {
//                         alert('Error: ' + res.message);
//                     }
//                 },
//                 error: function () {
//                     alert('Failed to send message. Please try again later.');
//                 }
//             });
//         });
//     });
// </script>

