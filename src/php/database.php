<?php

$servername = "db";
// $servername = "172.18.0.3";
$username = "admin";
$password = "password";
$database_kuberkosh_db = "kuberkosh_db";
$database_wallet_transactions_db = "wallet_transactions_db";


$connect_kuberkosh_db = connectToDatabase($servername, $username, $password, $database_kuberkosh_db);

$connect_wallet_transactions_db = connectToDatabase($servername, $username, $password, $database_wallet_transactions_db);

// function to connect to database
function connectToDatabase($servername, $username, $password, $database) {
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Failed to connect with MySQL: " . $conn->connect_error);
    }

    return $conn;
}
?>
