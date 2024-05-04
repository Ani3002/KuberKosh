<?php
// include 'functions.php';
require_once 'database.php';  // Include the database.php file


// Establish database connection
global $connect_kuberkosh_db;

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the new wallet address from the request
    $requestData = json_decode(file_get_contents("php://input"), true);
    $inputNewWalletAddress = $requestData['inputNewWalletAddress'];

    // Perform server-side validation or additional checks if needed
    
    // Check whether the wallet address already exists in the database and is valid
    if (doesExistWalletAddres($connect_kuberkosh_db, $inputNewWalletAddress)) {
        // Wallet address is valid
        $response = array('valid' => true);
    } else {
        // Wallet address is not valid
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

// Function to check whether the wallet address already exists in the database and is valid
function doesExistWalletAddres($connect_kuberkosh_db, $inputNewWalletAddress) {
    // Escape the wallet address to prevent SQL injection
    $inputNewWalletAddress = $connect_kuberkosh_db->real_escape_string($inputNewWalletAddress);

    // Query to check if the wallet address already exists in the database
    $query = "SELECT COUNT(*) AS count FROM wallet WHERE wallet_address = '$inputNewWalletAddress'";
    $result = $connect_kuberkosh_db->query($query);


    if(empty($inputNewWalletAddress)){
        return false;
    }
    // Check if the query was successful
    if ($result) {
        $row = $result->fetch_assoc();
        $count = $row['count'];
        
        // If count is 0, the wallet address is available
        if ($count == 0) {
            return true;
        }
        else{
            return false;
        }
        
    } else {
        // Handle query error
        // For now, lets return false here
        return false;
    }
}
?>
