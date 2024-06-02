<?php
require_once 'database.php';
require_once 'functions.php';

// Establishing database connection
global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;


if ($_SERVER["REQUEST_METHOD"] === "POST") 
{

    $requestData = json_decode(file_get_contents("php://input"), true);
    $bankAccountId = $requestData['bankAccountId'];
    $userId = $_SESSION['user_id']; // Ensure the session is started and user ID is set

    $userBanks = getUserBanks($connect_kuberkosh_db, $userId);
    $accountNumber = '';
    $bankName = '';

    foreach ($userBanks as $bank) {
        if ($bank['bank_account_id'] == $bankAccountId) {
            $accountNumber = $bank['account_no'];
            $bankName = $bank['bank_info'];
            break;
        }
    }

    $response = array(
        'accountNumber' => $accountNumber,
        'bankName' => $bankName
    );

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Invalid request method'));
}
?>
