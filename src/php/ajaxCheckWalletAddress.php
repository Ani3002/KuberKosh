<?php
include 'functions.php';
require_once 'database.php';  // Include the database.php file


// Establish database connection
global $connect_kuberkosh_db;

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the new wallet address from the request
    $requestData = json_decode(file_get_contents("php://input"), true);
    $walletAddress = $requestData['walletAddress'];

    // Perform server-side validation or additional checks if needed
    
    // Check whether the wallet address already exists in the database and is valid
    if ($walletAddress == ""){   // ADDED WITHOUTT VERIFICATION
        $response = array ('error' => 'Error: Enter Wallet Address');
    }
    else if ((!doesExistWalletAddres($connect_kuberkosh_db, $walletAddress))){
        // Wallet address does not exists
        $response = array('valid' => true);
    }
    else {
        // Wallet address does exist
        $response = array('valid' => false);
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Invalid request method'));
}
?>
