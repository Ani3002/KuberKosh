<?php
session_start();
include_once 'php/database.php'; // Include the database.php file
include_once 'php/functions.php';

$userId = $_SESSION['user_id'];
$wallet_id = fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_id'];

// Retrieve the start and end dates from the AJAX request
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

// Update the start and end dates in the session or database
// For example, you can store them in session variables
$_SESSION['start_date'] = $start_date;
$_SESSION['end_date'] = $end_date;

// You can also update the dates in the database if needed
// updateDatesInDatabase($connect_wallet_transactions_db, $wallet_id, $start_date, $end_date);

// Return a success response
echo json_encode(['success' => true]);
?>
