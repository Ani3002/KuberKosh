<?php
include_once 'php/database.php';
include_once 'php/functions.php';

// Display All Errors (For Easier Development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page or display an error message
    exit("User is not logged in.");
}

// Get user ID from session
$userId = $_SESSION['user_id'];

// Include composer packages
require 'vendor/autoload.php';
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
    
    // Insert the secret key in the database
    $dbResponse = insertSecretKeyInDb($userId, $secretKey, $connect_kuberkosh_db);
    
    // Prepare the response
    $response->result = true;
    $response->dbResponse = $dbResponse;
} else {
    // If OTP is not valid, return an error response
    $response->result = false;
    $response->error = "Invalid OTP";
}

// Generate and print JSON response
echo json_encode($response);
?>
