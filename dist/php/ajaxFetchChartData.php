<?php
// Include necessary files and establish database connection
include 'functions.php';
require_once 'database.php';

header('Content-Type: application/json');

// Function to fetch data from the database based on date range
function fetchDataForDateRange($connect_wallet_transactions_db, $wallet_id, $start_date, $end_date)
{
    // Prepare SQL query
    $query = "SELECT `Date`, `end_balance`, `debit`, `Particulars` FROM `$wallet_id` WHERE `Date` BETWEEN ? AND ? ORDER BY `Date` DESC";
    $stmt = $connect_wallet_transactions_db->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $type = extractParticularsParts($row['Particulars'], 6);
        $mode = extractParticularsParts($row['Particulars'], 0);
        if ($type === 'unknown_user') {
            continue;  // Skip this iteration if the type is 'unknown_user'
        }
        if ($mode === 'W2B'){
            continue;
        }
        if ($row['debit'] > 0) {  // Include only debit transactions
            if (!isset($data[$type])) {
                $data[$type] = 0;
            }
            $data[$type] += $row['debit'];
        }
    }
    return $data;
}

// Fetch wallet ID (Assuming you have a function to get wallet ID from user ID)
$userId = $_SESSION['user_id'];
$wallet_id = fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_id'];

// Define start and end dates for the last 30 days
$end_date = date('Y-m-d');
$start_date = date('Y-m-d', strtotime('-30 days'));

// Fetch data for the given date range
$data = fetchDataForDateRange($connect_wallet_transactions_db, $wallet_id, $start_date, $end_date);

// Process the data to get the top 5 types and "others"
arsort($data);  // Sort the data in descending order of the amount
$topTypes = array_slice($data, 0, 5, true);
$otherTypes = array_slice($data, 5, null, true);

$totalOthers = array_sum($otherTypes);
if ($totalOthers > 0) {
    $topTypes['Others'] = $totalOthers;
}

$labels = array_map(function ($label) {
    return substr($label, 0, 100);
}, array_keys($topTypes));
$values = array_values($topTypes);

// Prepare the response
$response = [
    'labels' => $labels,
    'data' => $values
];

echo json_encode($response);
?>