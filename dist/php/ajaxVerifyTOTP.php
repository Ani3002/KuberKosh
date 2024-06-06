<?php
session_start();
include 'database.php';
require '../vendor/autoload.php';
use PragmaRX\Google2FA\Google2FA;

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    exit(json_encode(['error' => 'User is not logged in']));
}

// Get user ID from session
$userId = $_SESSION['user_id'];

function fetchSecretKey($connect_kuberkosh_db, $userId)
{
    $query = "SELECT secret_key FROM users WHERE user_id = '$userId'";
    $result = $connect_kuberkosh_db->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['secret_key'];
    } else {
        return null;
    }
}

// Retrieve One Time Password from request
$otp = isset($_POST['otp']) ? $_POST['otp'] : null;

if (!$otp) {
    exit(json_encode(['error' => 'OTP is missing']));
}

// Initiate Google2FA object
$g2fa = new Google2FA();

// Verify provided OTP
$secretKey = fetchSecretKey($connect_kuberkosh_db, $userId);
$valid = $g2fa->verifyKey($secretKey, $otp);

// Check if OTP is valid
$response = new stdClass();
if ($valid) {
    $_SESSION['mfa_ok'] = true;
    $response->message = "valid OTP";
} else {
    $_SESSION['mfa_ok'] = false;
    $response->message = "invalid OTP";
}

echo json_encode($response);
?>
