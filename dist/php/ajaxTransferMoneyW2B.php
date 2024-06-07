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


    $money_withdraw_amount = $requestData['money_withdraw_amount'];
    $bankAccountId = $requestData['bankAccountId'];
    $hashedPINEnteredByUser = $requestData['hashedPINEnteredByUser'];
    $trnxRemarks = $requestData['money_withdrawing_remarks'];;
    $userId = $_SESSION['user_id'];

    $walletDetails = fetchWalletDetails($connect_kuberkosh_db, $userId);
    $walletPINHash = ($walletDetails['wallet_pin']);

    $walletAddress = fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address'];


    // Check if the hashed PIN entered by the user matches the hashed PIN stored in the database
    if ($hashedPINEnteredByUser === $walletPINHash) {
        // Hashes match, proceed with the transfer
        
    
        // Call the function to withdraw money from the wallet
        $response = withdrawMoneyFromWallet($connect_kuberkosh_db, $connect_wallet_transactions_db, $bankAccountId, $money_withdraw_amount, $trnxRemarks, $userId);
    } else {
        // Hashes don't match, return an error response
        $response = array('error' => 'Invalid PIN');
    }

    


    // $response = transferMoneyW2W($walletAddress, $amountToSend, $connect_kuberkosh_db, $connect_wallet_transactions_db);

    // $response = array ('success' => true, 'trnxId' => 'trnxId');
    
    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
else
{
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Invalid request method'));
}