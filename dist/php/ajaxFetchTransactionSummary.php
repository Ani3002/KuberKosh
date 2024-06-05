<?php
// Fetch and decode the input JSON
$input = json_decode(file_get_contents('php://input'), true);
$dateRange = $input['dateRange'];

// Sample data generation (you should replace this with your actual database queries)
function getDataForRange($dateRange) {
    // Replace with actual data fetching logic based on $dateRange
    switch ($dateRange) {
        case '1_week':
            return [56, 45, 62, 73, 88, 56, 10];
        case '2_weeks':
            return array_merge([56, 45, 62, 73, 88, 56, 10], [43, 56, 67, 45, 23, 56, 78]);
        case '1_month':
            return array_merge([56, 45, 62, 73, 88, 56, 10], [43, 56, 67, 45, 23, 56, 78]);
        case '2_months':
            return array_merge([56, 45, 62, 73, 88, 56, 10], [43, 56, 67, 45, 23, 56, 78], [56, 45, 62, 73, 88, 56, 10], [43, 56, 67, 45, 23, 56, 78]);
        case '6_months':
            return array_merge([56, 45, 62, 73, 88, 56, 10], [43, 56, 67, 45, 23, 56, 78], [56, 45, 62, 73, 88, 56, 10], [43, 56, 67, 45, 23, 56, 78], [56, 45, 62, 73, 88, 56, 10], [43, 56, 67, 45, 23, 56, 78]);
        default:
            return [];
    }
}

$data = getDataForRange($dateRange);

// Calculate the averages and percentage change
$averagePrevious = array_sum($data) / count($data);
$currentData = getDataForRange('1_week');  // Assume the current data is for the past week
$averageCurrent = array_sum($currentData) / count($currentData);
$percentageChange = (($averageCurrent - $averagePrevious) / $averagePrevious) * 100;

// Prepare labels for chart (simplified example)
$labels = array_map(fn($index) => str_pad($index + 1, 2, '0', STR_PAD_LEFT), array_keys($data));

$response = [
    'averagePrevious' => $averagePrevious,
    'averageCurrent' => $averageCurrent,
    'percentageChange' => $percentageChange,
    'dataValues' => $data,
    'labels' => $labels,
];

header('Content-Type: application/json');
echo json_encode($response);
?>
