<?php

// This is the ajax PHP script to generate the
// Receipt of transcation

require_once ('../tcpdf/tcpdf.php');
include 'functions.php';
require_once 'database.php';

// Establishing database connection
global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve transaction ID and amount from POST data
    $transactionId = isset($_POST['transactionId']) ?
     $_POST['transactionId'] : '';
    $amount = isset($_POST['amount']) ?
             $_POST['amount'] : '';
    $BankName = isset($_POST['BankName']) ?
             $_POST['BankName'] : '';
    $accountNo = isset($_POST['accountNo']) ?
             $_POST['accountNo'] : '';

    $userId = $_SESSION['user_id'];

    $walletDetails = fetchWalletDetails($connect_kuberkosh_db,
         $userId);
    $senderWalletAddress = $walletDetails['wallet_address'];
    $wallet_id = $walletDetails['wallet_id'];

    $trnxDetail = getTrnxDetails($connect_wallet_transactions_db,
     $wallet_id, $transactionId, $amount);

    $Trnx_id = ($trnxDetail['Trnx_id']);
    $currentDateTime = date('Y-m-d H:i:s');

    // Validate transaction ID and amount
    if (empty($transactionId) || empty($amount)) {
        http_response_code(400); // Bad Request
        echo "Transaction ID and amount are required.";
        exit();
    }

    if ($transactionId != $Trnx_id) {
        http_response_code(400); // Bad Request
        echo $userId;
        echo "<br>";
        echo $wallet_id;
        echo "<br>";
        echo $Trnx_id;
        echo "<br>";
        echo "Transaction ID invalid.";
        exit();
    }

    // Extract individual parameters from the Particulars string
    $particulars = explode('/', $trnxDetail['Particulars']);
    $one = $particulars[0];
    $receiverName = $particulars[2];
    $receiverWalletAddress = $particulars[3];
    $transactionTime = $particulars[5];
    $senderRemarks = $particulars[7];
    $trnxPurpose = $particulars[6];

    if ($one === "W2W") 
    {
        // Create new TCPDF object
        $pdf = new TCPDF('P', 'mm', 'A5', true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Transaction Receipt');
        $pdf->SetSubject('Transaction Receipt');
        $pdf->SetKeywords('Transaction, Receipt');

        // Add a page
        $pdf->AddPage();
        
        // Set Logo or Title
        $pdf->SetFont('times', 'B', 30);
        $pdf->Cell(0, 10, 'KuberKosh', 0, 1, 'C');


        // Add content
        $pdf->SetFont('times', 'BU', 18);
        $pdf->Ln(5); // Line break
        $pdf->Cell(0, 10, 'Transaction Receipt', 0, 1, 'C');
        $pdf->Ln(10); // Line break

        $pdf->SetFont('times', '', 10);
        // Add transaction details
        $pdf->Cell(0, 10, 'Sender Name: ' . ($_SESSION["
            first_name"] . ' ' . $_SESSION["last_name"]), 0, 1);
        $pdf->Cell(0, 10, 'Sender Wallet Address: ' .
             $senderWalletAddress, 0, 1);
        $pdf->Cell(0, 10, 'Receiver Name: ' .
             $receiverName, 0, 1);
        $pdf->Cell(0, 10, 'Receiver Wallet Address: ' .
             $receiverWalletAddress, 0, 1);
        $pdf->Cell(0, 10, 'Amount: INR ' . $amount, 0, 1);

        $pdf->Cell(0, 10, 'Transaction ID: ' .
             $transactionId, 0, 1);

        $pdf->Cell(0, 10, 'Transaction Time: ' .
             $transactionTime, 0, 1);
        $pdf->Cell(0, 10, 'Transaction Purpose: ' .
             $trnxPurpose, 0, 1);
        $pdf->Cell(0, 10, 'Sender Remarks: ' .
             $senderRemarks, 0, 1);
        $pdf->Cell(0, 10, 'Receipt Generation Time: ' .
             $currentDateTime, 0, 1);

        // Output PDF
        $pdf->Output('transaction_receipt.pdf', 'D');}
        
    elseif($one === "W2B")
    {
        // Create new TCPDF object
        $pdf = new TCPDF('P', 'mm', 'A5', true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Withdraw Receipt');
        $pdf->SetSubject('Withdraw Receipt');
        $pdf->SetKeywords('Withdraw, Receipt');

        // Add a page
        $pdf->AddPage();

        // Add logo and company name
        $pdf->SetFont('times', 'B', 30);
        $pdf->Cell(0, 10, 'KuberKosh', 0, 1, 'C');

        // Add content
        $pdf->SetFont('times', 'BU', 18);
        $pdf->Ln(5); // Line break
        $pdf->Cell(0, 10, 'Withdraw Receipt', 0, 1, 'C');
        $pdf->Ln(10); // Line break

        $pdf->SetFont('times', '', 10);
        // Add transaction details
        $pdf->Cell(0, 10, 'Name: ' . ($_SESSION["
            first_name"] . ' ' . $_SESSION["
                last_name"]), 0, 1);
        $pdf->Cell(0, 10, 'Wallet Address: ' .
             $senderWalletAddress, 0, 1);
        $pdf->Cell(0, 10, 'Bank Name: ' . $BankName, 0, 1);
        $pdf->Cell(0, 10, 'Bank Account Number: ' .
             $accountNo, 0, 1);
        $pdf->Cell(0, 10, 'Amount: INR ' . $amount, 0, 1);
        $pdf->Cell(0, 10, 'Transaction ID: ' .
             $transactionId, 0, 1);
        $pdf->Cell(0, 10, 'Transaction Time: ' .
             $transactionTime, 0, 1);
        $pdf->Cell(0, 10, 'Transaction Purpose: ' .
             $trnxPurpose, 0, 1);
        $pdf->Cell(0, 10, 'Sender Remarks: ' .
             $senderRemarks, 0, 1);
        $pdf->Cell(0, 10, 'Receipt Generation Time: ' .
             $currentDateTime, 0, 1);

        // Output PDF
        $pdf->Output('withdrawal_receipt.pdf', 'D');
    }

} else {
    // If it's not a POST request, return an error
    http_response_code(405); // Method Not Allowed
    echo "Method Not Allowed";
}
?>