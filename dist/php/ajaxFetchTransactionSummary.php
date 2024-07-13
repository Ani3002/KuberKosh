<?php
include 'functions.php';
require_once 'database.php';

// Establishing database connection
global $connect_wallet_transactions_db;

// Fetch and decode the input JSON
$input = json_decode(file_get_contents('php://input'), true);
$dateRange = $input['dateRange'];

// Fetch wallet ID (Assuming you have a function to get wallet ID from user ID)
$userId = $_SESSION['user_id'];
$wallet_id = fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_id'];

// Define start and end dates based on the selected date range
$end_date = date('Y-m-d');
$start_date = '';
$end_date_2 = '';
switch ($dateRange) {
    case '1 Week':
        $start_date = date('Y-m-d', strtotime('-7 days'));
        $end_date_2 = date('Y-m-d', strtotime('-14 days'));
        break;
    case '2 Weeks':
        $start_date = date('Y-m-d', strtotime('-14 days'));
        $end_date_2 = date('Y-m-d', strtotime('-28 days'));
        // $end_date_2 = 2024-05-30;

        break;
    case '1 Month':
        $start_date = date('Y-m-d', strtotime('-1 month'));
        $end_date_2 = date('Y-m-d', strtotime('-2 months'));
        break;
    case '2 Months':
        $start_date = date('Y-m-d', strtotime('-2 months'));
        $end_date_2 = date('Y-m-d', strtotime('-4 months'));
        break;
    case '6 Months':
        $start_date = date('Y-m-d', strtotime('-6 months'));
        $end_date_2 = date('Y-m-d', strtotime('-1 year'));
        break;
}

// Fetch data for the given date range
$data = fetchDataForDateRange($connect_wallet_transactions_db, $wallet_id, $start_date, $end_date);
$data2 = fetchDataForDateRange($connect_wallet_transactions_db, $wallet_id, $end_date_2, $start_date);

// Process data based on date range
list($processedData, $processedData2, $averagePrevious, $averageCurrent) = processDateRange($data, $data2, $dateRange);

// Calculate percentage change, ensuring no division by zero
$percentageChange = 0;
if ($averagePrevious != 0) {
    $percentageChange = (($averageCurrent - $averagePrevious) / $averagePrevious) * 100;
}

// Prepare labels for the chart
$labels = array_map(fn($index) => str_pad($index + 1, 2, '0', STR_PAD_LEFT), array_keys($processedData));

// Prepare the response
$response = [
    'averagePrevious' => $averagePrevious,
    'averageCurrent' => $averageCurrent,
    'percentageChange' => $percentageChange,
    'dataValues' => $processedData,
    'labels' => $labels,
    'end_date' => $end_date,
    'start_date' => $start_date,
    'end_date_2' => $end_date_2,
    'data2' => $processedData2
];

header('Content-Type: application/json');
echo json_encode($response);

// Function to fetch data from the database based on date range
function fetchDataForDateRange($connect_wallet_transactions_db, $wallet_id, $start_date, $end_date) {
    $query = "SELECT `Date`, `end_balance` FROM `$wallet_id` WHERE `Date` BETWEEN ? AND ? ORDER BY `Date` ASC";
    $stmt = $connect_wallet_transactions_db->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[$row['Date']] = $row['end_balance'];
    }
    return $data;
}

// Function to process data based on the selected date range
function processDateRange($data, $data2, $dateRange) {
    $processedData = [];
    $processedData2 = [];
    $averageCurrent = 0;
    $averagePrevious = 0;

    if (empty($data) || empty($data2)) {
        return [$processedData, $processedData2, $averagePrevious, $averageCurrent];
    }

    switch ($dateRange) {
        case '1 Week':
        case '2 Weeks':
            $numPeriods = ($dateRange == '1 Week') ? 7 : 14;
            break;
        case '1 Month':
            $numPeriods = 15;
            break;
        case '2 Months':
            $numPeriods = 15;
            break;
        case '6 Months':
            $numPeriods = 12;
            break;
    }

    $processedData = array_slice(array_values($data), -$numPeriods);
    $processedData2 = array_slice(array_values($data2), -$numPeriods);

    $averageCurrent = array_sum($processedData) / count($processedData);
    $averagePrevious = array_sum($processedData2) / count($processedData2);

    return [$processedData, $processedData2, $averagePrevious, $averageCurrent];
}
?>