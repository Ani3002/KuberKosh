<?php
include 'functions.php';
require_once 'database.php';

// Establishing database connection
global $connect_wallet_transactions_db;

// Fetch and decode the input JSON
$input = json_decode(file_get_contents('php://input'), true);
$dateRange = $input['dateRange'];

// Function to fetch data from the database based on date range
function fetchDataForDateRange($connect_wallet_transactions_db, $wallet_id, $start_date, $end_date) {
    // Prepare SQL query
    $query = "SELECT `Date`, `end_balance` FROM `$wallet_id` WHERE `Date` BETWEEN ? AND ? ORDER BY `Date` DESC";
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
function processDateRange($data, $dateRange) {
    $processedData = [];
    $averageCurrent = 0;
    $averagePrevious = 0;
    $numOfDays = count($data);

    if ($numOfDays == 0) {
        return [$processedData, $averagePrevious, $averageCurrent];
    }

    if ($dateRange == '1_week' || $dateRange == '2_weeks') {
        // Process for 1 week or 2 weeks
        $numPeriods = ($dateRange == '1_week') ? 7 : 14;
        $processedData = array_slice($data, 0, $numPeriods);
        if (count($processedData) >= 3) {
            $averageCurrent = array_sum(array_slice($processedData, 0, 7)) / 7;
            if (count($processedData) >= 14) {
                $averagePrevious = array_sum(array_slice($processedData, 7, 7)) / 7;
            }
            else
            {
                $averagePrevious = 90;

            }
        }
        else
        {
            $averageCurrent = 5;
            $averagePrevious = 9;


        }
    } elseif ($dateRange == '1_month') {
        // Process for 1 month
        for ($i = 0; $i < $numOfDays; $i += 2) {
            if (isset($data[$i + 1])) {
                $processedData[] = ($data[$i] + $data[$i + 1]) / 2;
            } else {
                $processedData[] = $data[$i];
            }
        }
        if (count($processedData) >= 15) {
            $averageCurrent = array_sum(array_slice($processedData, 0, 15)) / 15;
            if (count($processedData) >= 30) {
                $averagePrevious = array_sum(array_slice($processedData, 15, 15)) / 15;
            }
        }
    } elseif ($dateRange == '2_months') {
        // Process for 2 months
        for ($i = 0; $i < $numOfDays; $i += 7) {
            $weekAverage = array_sum(array_slice($data, $i, 7)) / 7;
            $processedData[] = $weekAverage;
        }
        if (count($processedData) >= 8) {
            $averageCurrent = array_sum(array_slice($processedData, 0, 8)) / 8;
            if (count($processedData) >= 16) {
                $averagePrevious = array_sum(array_slice($processedData, 8, 8)) / 8;
            }
        }
    } elseif ($dateRange == '6_months') {
        // Process for 6 months
        for ($i = 0; $i < $numOfDays; $i += 14) {
            $twoWeekAverage = array_sum(array_slice($data, $i, 14)) / 14;
            $processedData[] = $twoWeekAverage;
        }
        if (count($processedData) >= 12) {
            $averageCurrent = array_sum(array_slice($processedData, 0, 12)) / 12;
            if (count($processedData) >= 24) {
                $averagePrevious = array_sum(array_slice($processedData, 12, 12)) / 12;
            }
        }
    }

    return [$processedData, $averagePrevious, $averageCurrent];
}

// Fetch wallet ID (Assuming you have a function to get wallet ID from user ID)
$userId = $_SESSION['user_id'];
$wallet_id = fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_id'];

// Define start and end dates based on the selected date range
$end_date = date('Y-m-d');
$start_date = '';
switch ($dateRange) {
    case '1_week':
        $start_date = date('Y-m-d', strtotime('-7 days'));
        break;
    case '2_weeks':
        $start_date = date('Y-m-d', strtotime('-14 days'));
        break;
    case '1_month':
        $start_date = date('Y-m-d', strtotime('-1 month'));
        break;
    case '2_months':
        $start_date = date('Y-m-d', strtotime('-2 months'));
        break;
    case '6_months':
        $start_date = date('Y-m-d', strtotime('-6 months'));
        break;
}

// Fetch data for the given date range
$data = fetchDataForDateRange($connect_wallet_transactions_db, $wallet_id, $start_date, $end_date);
$data = array_values($data);  // Reset the array keys

// Process data based on date range
list($processedData, $averagePrevious, $averageCurrent) = processDateRange($data, $dateRange);

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
    // 'dataValues' => "56, 45, 62, 73",
    'labels' => $labels,
    // 'labels' => "67894",
];

header('Content-Type: application/json');
echo json_encode($response);
?>
