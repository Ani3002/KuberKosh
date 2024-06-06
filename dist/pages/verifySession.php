<?php

// Include the database connection script
// include 'php/databaseVS.php';

$servername = "db";
// $servername = "172.18.0.3";
$username = "admin";
$password = "password";
$database_kuberkosh_dbVS = "kuberkosh_db";
$database_wallet_transactions_dbVS = "wallet_transactions_db";

$connect_kuberkosh_dbVS = connectToDatabaseVS($servername, $username, $password, $database_kuberkosh_dbVS);
$connect_wallet_transactions_dbVS = connectToDatabaseVS($servername, $username, $password, $database_wallet_transactions_dbVS);

// Function to connect to the database
function connectToDatabaseVS($servername, $username, $password, $database) {
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Failed to connect with MySQL: " . $conn->connect_error);
    }
    return $conn;
}

// Function to check if TOTP is enabled
function checkTOTPenabledVS($userId, $connect_kuberkosh_dbVS) {
    $query = "SELECT `secret_key` FROM `users` WHERE `user_id` = ?";
    
    // Prepare and execute the query
    if ($stmt = $connect_kuberkosh_dbVS->prepare($query)) {
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $stmt->store_result();
        
        // Initialize variable
        $secretKey = null;
        
        // Check if the user exists
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($secretKey);
            $stmt->fetch();
            
            $TOTPenabled = !empty($secretKey);
            
            $stmt->close();
            return json_encode(['TOTPenabled' => $TOTPenabled]);
        }

        $stmt->close();
    }

    return json_encode(['TOTPenabled' => false]);
}

// Check if the user ID is not set in the session
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: index.php?login");
    exit; // Stop further execution of the script
}

// Get user ID from session
$userId = $_SESSION['user_id'];

// Check if TOTP is enabled for the user
$totpStatus = json_decode(checkTOTPenabledVS($userId, $connect_kuberkosh_dbVS), true);

// Redirect if TOTP is not enabled
if ($totpStatus['TOTPenabled']) {
    if (isset($_SESSION['mfa_ok']) == false) {
        header('Location: index.php?mfa');
        exit();
    }
}
?>
