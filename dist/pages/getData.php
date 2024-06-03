<?php
header('Content-Type: application/json');

$data = [
    'labels' => ['06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18'],
    'values' => [200, 400, 600, 800, 1000, 1200, 1400, 1600, 1800, 2000, 2200, 2400, 2600]
];

echo json_encode($data);
?>
