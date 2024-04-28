<?php
include 'functions.php';
require_once 'database.php';


// Establishing database connection
global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

$userId = $_SESSION['user_id'];
// Check request is POST
if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    // Get amountToVerify from the request
    $requestData = json_decode(file_get_contents("php://input"), true);
    $amountToSend = $requestData['amountToSend'];


    if ($amountToSend == "")
    {
        $response = array ('error' => 'Error: Enter an Amount to Send');
    }
    else
    {
        // do a function call to fetch the wallet balance of user
        // verify the user has the amount in the wallet that he wants to send
        $walletBalance = fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $userId);

        if ($walletBalance > $amountToSend)
        {
            $response = array ('valid' => true, 'walletBalance' => $walletBalance);
        }
        else
        {
            $response = array ('valid' => false, 'error' => 'Insuficient Balance');
        }
        
    }

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