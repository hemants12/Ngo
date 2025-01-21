<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection and insertion logic
    // Assuming your database connection is in `config.php`
    include 'config.php';

    $donorType = $_POST['donorType'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $areaStreet = $_POST['areaStreet'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $idProof = $_POST['idProof'];
    $donationAmount = $_POST['Donation-amount'];
    $donationType = $_POST['donationType'];
    $donationFor = $_POST['Donationfor'];

    $query = "INSERT INTO donations (donorType, fullName, email, phone, country, areaStreet, state, city, pincode, idProof, donationAmount, donationType, donationFor)
              VALUES ('$donorType', '$fullName', '$email', '$phone', '$country', '$areaStreet', '$state', '$city', '$pincode', '$idProof', '$donationAmount', '$donationType', '$donationFor')";

    if (mysqli_query($link, $query)) {

        echo json_encode(['status' => 'success', 'message' => 'Donation successfully recorded.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to record donation.']);
    }
}
