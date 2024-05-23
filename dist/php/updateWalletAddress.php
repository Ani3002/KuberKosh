<?php
// Include database connection file
require_once 'database.php'; // Include the database.php file


// Establish database connection
global $connect_kuberkosh_db;

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the new wallet address from the request
    $requestData = json_decode(file_get_contents("php://input"), true);
    $inputNewWalletAddress = $requestData['inputNewWalletAddress'];
    $userId = $requestData['userId'];

    // Perform server-side validation or additional checks if needed
    
    // Update the wallet address in the database
    if (updateWalletAddress($connect_kuberkosh_db, $inputNewWalletAddress, $userId)) {
        // Wallet address updated successfully
        $response = array('success' => true);
    } else {
        // Failed to update wallet address
        $response = array('success' => false);
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Invalid request method'));
}

// Function to update the wallet address in the database
function updateWalletAddress($db, $inputNewWalletAddress, $userId) {
    // Escape the new wallet address to prevent SQL injection
    $inputNewWalletAddress = $db->real_escape_string($inputNewWalletAddress);

    // Perform the database update operation
    $query = "UPDATE wallet SET wallet_address = '$inputNewWalletAddress' WHERE user_id = ?";

    // Prepare the statement
    $stmt = $db->prepare($query);

    // Bind parameters
    $stmt->bind_param("i", $userId); // Assuming user_id is an integer

    // Execute the statement
    if ($stmt->execute()) {
        // Update successful
        return true;
    } else {
        // Update failed
        return false;
    }
}
?>
