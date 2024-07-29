<?php
include_once 'database.php';
include_once 'functions.php';

// Display All Errors (For Easier Development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    exit(json_encode(['error' => 'User is not logged in']));
}

// Get user ID from session
$userId = $_SESSION['user_id'];

// Disable TOTP for the user
$updateStatus = disableTOTP($userId, $connect_kuberkosh_db);

// Prepare and output the response
$response = [
    'result' => $updateStatus,
    'message' => $updateStatus ? "TOTP has been disabled successfully." : "Failed to disable TOTP."
];
echo json_encode($response);
?>
