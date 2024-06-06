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

// Retrieve One Time Password from URL (DO NOT do this in production)
$otp = $_GET['otp'];

// Verify provided OTP
$valid = $_g2fa->verifyKey($user->google2fa_secret, $otp);

// Check if OTP is valid
if ($valid) {
    // Get the secret key
    $secretKey = $user->google2fa_secret;
    
    // Insert the secret key in the database
    $response = insertSecretKeyInDb($userId, $secretKey, $connect_kuberkosh_db);
    
    // Generate and print JSON response
    $response = json_encode($response);
    echo $response;
} else {
    // If OTP is not valid, return an error response
    $response = new stdClass();
    $response->error = "Invalid OTP";
    $response = json_encode($response);
    echo $response;
}
?>
