<?php

$servername = "db";
$username = "admin";
$password = "password";
$database = "kuberkosh_db";


$databaseConnection = connectToDatabase($servername, $username, $password, $database);

// function to connect to database
function connectToDatabase($servername, $username, $password, $database) {
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Failed to connect with MySQL: " . $conn->connect_error);
    }

    return $conn;
}
?>
