<?php
// updateWalletPIN.php
include 'database.php';
include 'functions.php';

global $connect_kuberkosh_db;
// Function to validate PIN format
function validatePIN($pin) {
    // PIN must consist of exactly 6 digits
    return preg_match('/^\d{6}$/', $pin);
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection

    $requestData = json_decode(file_get_contents("php://input"), true);

    // Start session
    // session_start();

    // Get user ID from session
    // $userId = $_SESSION['user_id'];

    // Retrieve form data
    $currentPIN = $requestData['currentPIN'] ?? null;
    $newPIN = $requestData['newPIN'] ?? null;
    $confirmNewPIN = $requestData['confirmNewPIN'] ?? null;
    $userId = $requestData['userId'] ?? null;


    $walletDetails = fetchWalletDetails($connect_kuberkosh_db, $userId);

    if(empty($walletDetails['wallet_pin']))
    {
        // Validate input
    if (empty($newPIN) || empty($confirmNewPIN)) {
        echo json_encode(array('success' => false, 'message' => 'New PIN and Confirm New PIN are required.'));
        exit;
    }

    if ($newPIN !== $confirmNewPIN) {
        echo json_encode(array('success' => false, 'message' => 'New PIN and Confirm New PIN do not match.'));
        exit;
    }

    // Validate PIN format
    if (!validatePIN($newPIN)) {
        echo json_encode(array('success' => false, 'message' => 'New PIN must be exactly 6 digits.'));
        exit;
    }
    }

    if(!empty($walletDetails['wallet_pin']))
    {
        // Validate input
    if (empty($currentPIN) && !empty($newPIN)) {
        // Current PIN is required for changing PIN
        echo json_encode(array('success' => false, 'message' => 'Current PIN is required.'));
        exit;
    }

    if (empty($newPIN) || empty($confirmNewPIN)) {
        echo json_encode(array('success' => false, 'message' => 'New PIN and Confirm New PIN are required.'));
        exit;
    }

    if ($newPIN !== $confirmNewPIN) {
        echo json_encode(array('success' => false, 'message' => 'New PIN and Confirm New PIN do not match.'));
        exit;
    }

    // Validate PIN format
    if (!validatePIN($newPIN)) {
        echo json_encode(array('success' => false, 'message' => 'New PIN must be exactly 6 digits.'));
        exit;
    }
    }
    





    // Hash the new PIN using SHA-256
    $hashedPIN = hash('sha256', $newPIN);

    // Check if the current PIN matches the one in the database (for changing PIN)
    if (!empty($currentPIN)) {
        if (!validatePIN($currentPIN)) {
            echo json_encode(array('success' => false, 'message' => 'Current PIN must be exactly 6 digits.'));
            exit;
        }
        $currentPIN = hash('sha256', $currentPIN);
        $query = "SELECT * FROM wallet WHERE user_id = ? AND wallet_pin = ?";
        $stmt = $connect_kuberkosh_db->prepare($query);
        $stmt->bind_param('is', $userId, $currentPIN);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            echo json_encode(array('success' => false, 'message' => 'Current PIN is incorrect.'));
            exit;
        }
    }

    // Update the wallet PIN in the database
    $query = "UPDATE wallet SET wallet_pin = ? WHERE user_id = ?";
    $stmt = $connect_kuberkosh_db->prepare($query);
    $stmt->bind_param('si', $hashedPIN, $userId);
    if ($stmt->execute()) {
        echo json_encode(array('success' => true, 'message' => 'Wallet PIN updated successfully.'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error updating wallet PIN.'));
    }
} else {
    // If the request method is not POST, return error
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
?>
