<?php
include 'functions.php';
require_once 'database.php';

// Establishing database connection
global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

$userId = $_SESSION['user_id'];

// Check request is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get amountToVerify from the request
    $requestData = json_decode(file_get_contents("php://input"), true);
    $amountToSend = $requestData['amountToSend'];

    if ($amountToSend == "") {
        $response = array('error' => 'Error: Enter an Amount to Send');
    } else if (!ctype_digit(strval($amountToSend))) {
        $response = array('error' => 'Error: Enter a valid integer amount');
    } else {
        // Fetch the wallet balance of user
        $walletBalance = fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $userId);

        if ($walletBalance >= $amountToSend) {
            $response = array('valid' => true, 'walletBalance' => $walletBalance, 'amountToSend' => $amountToSend);
        } else {
            $response = array('valid' => false, 'error' => 'Insufficient Balance');
        }
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Invalid request method'));
}
