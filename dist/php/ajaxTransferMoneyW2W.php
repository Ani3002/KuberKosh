<?php
include 'functions.php';
require_once 'database.php';


// Establishing database connection
global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

// Check request is POST
if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    // Get amountToVerify from the request
    $requestData = json_decode(file_get_contents("php://input"), true);
    $amountToSend = $requestData['amountToSend'];
    $walletAddress = $requestData['walletAddress'];
    $hashedPINEnteredByUser = $requestData['hashedPINEnteredByUser'];
    $userId = $_SESSION['user_id'];

    $walletDetails = getWalletDetails($connect_kuberkosh_db, $userId);
    $walletPINHash = ($walletDetails['wallet_pin']);

    // Check if the hashed PIN entered by the user matches the hashed PIN stored in the database
    if ($hashedPINEnteredByUser === $walletPINHash) {
        // Hashes match, proceed with the transfer
        $response = transferMoneyW2W($walletAddress, $amountToSend, $connect_kuberkosh_db, $connect_wallet_transactions_db);
    } else {
        // Hashes don't match, return an error response
        $response = array('error' => 'Invalid PIN');
    }


    // $response = transferMoneyW2W($walletAddress, $amountToSend, $connect_kuberkosh_db, $connect_wallet_transactions_db);

    // $response = array ('success' => true, 'trnxId' => 'trnxId');
    
    // Send JSON response
    header('Content-Type: applicatio/json');
    echo json_encode($response);
}
else
{
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Invalid request method'));
}