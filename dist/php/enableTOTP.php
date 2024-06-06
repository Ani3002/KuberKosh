<?php
include_once 'database.php';
include_once 'functions.php';

// Display All Errors (For Easier Development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start Server Session

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    exit(json_encode(['error' => 'User is not logged in']));
}

// Get user ID from session
$userId = $_SESSION['user_id'];

// Include composer packages
require '../vendor/autoload.php';
use PragmaRX\Google2FA\Google2FA;

// Initiate Google2FA object
$_g2fa = new Google2FA();

// Retrieve user data
$user = $_SESSION['g2fa_user'];

// Get the raw POST data
$postData = file_get_contents('php://input');

// Decode JSON data
$request = json_decode($postData, true);

// Check if the OTP key exists in the request
if (!isset($request['otp'])) {
    exit(json_encode(['error' => 'OTP is missing']));
}

// Retrieve One Time Password from request
$otp = $request['otp'];

// Verify provided OTP
$valid = $_g2fa->verifyKey($user->google2fa_secret, $otp);

// Check if OTP is valid
$response = new stdClass();
if ($valid) {
    // Get the secret key
    $secretKey = $user->google2fa_secret;

    // Check if TOTP is already enabled
    $query = "SELECT `secret_key` FROM `users` WHERE `user_id` = ?";
    if ($stmt = $connect_kuberkosh_db->prepare($query)) {
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($existingSecretKey);
            $stmt->fetch();

            if (!empty($existingSecretKey)) {
                $response->result = false;
                $response->message = "TOTP already exists, cannot setup new TOTP";
            } else {
                // Insert the secret key in the database
                $dbResponse = insertSecretKeyInDb($userId, $secretKey, $connect_kuberkosh_db);
                $response->result = true;
                $response->dbResponse = $dbResponse;
                $_SESSION['mfa_ok'] = true;
            }
        }
        $stmt->close();
    }
} else {
    // If OTP is not valid, return an error response
    $response->result = false;
    $response->message = "Invalid OTP";
}

// Generate and print JSON response
echo json_encode($response);
?>