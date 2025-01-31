<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apiKey = "ef840d30-dadb-11ef-8b17-0200cd936042"; // Replace with your API key
    $phoneNumber = $_POST['phonenumber'];
    $name = $_POST['name'];
    $endDate = $_POST['enddate'];

    // Static values for renewal link and contact info
    $renewalLink = "https://example.com/renew"; // Replace with your static renewal link
    $contactInfo = "+1-800-123-4567"; // Replace with your static contact info

    // Approved sender ID and template name
    $senderId = "NgoKng"; // Replace with your approved Sender ID
    $templateName = "Msg1"; // Replace with the exact TemplateName from 2Factor

    // 2Factor API Endpoint
    $url = "https://2factor.in/API/V1/$apiKey/ADDON_SERVICES/SEND/TSMS";

    // POST data
    $postData = array(
        "From" => $senderId,
        "To" => $phoneNumber,
        "TemplateName" => $templateName,
        "VAR1" => $name,         // Dynamic Name
        "VAR2" => $endDate,      // Renewal Date
        "VAR3" => $renewalLink,  // Static Renewal Link
        "VAR4" => $contactInfo   // Static Contact Info
    );

    // cURL initialization
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo "CURL Error: " . curl_error($ch);
    } else {
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode === 200) {
            echo "SMS sent successfully to $name ($phoneNumber). Response: $response";
        } else {
            echo "Failed to send SMS. HTTP Response Code: $httpCode. Response: $response";
        }
    }
    curl_close($ch);
} else {
    echo "Invalid request method.";
}
?>
