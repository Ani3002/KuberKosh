<?php

$servername = "db";
$username = "admin";
$password = "password";
$database = "kuberkosh_db";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $database);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

$databaseConnection = connectToDatabase($servername, $username, $password, $database);

function connectToDatabase($servername, $username, $password, $database) {
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Failed to connect with MySQL: " . $conn->connect_error);
    }

    return $conn;
}


// // Sample data for a new user
// $newUser = array(
//     'oauth_provider' => 'google',
//     'oauth_uid' => '123456789',
//     'first_name' => 'John',
//     'last_name' => 'Doe',
//     'email' => 'john.doe@example.com',
//     'gender' => 'Male',
//     'locale' => 'en_US',
//     'picture' => 'https://example.com/profile_picture.jpg',
//     'created' => date('Y-m-d H:i:s'),
//     'modified' => date('Y-m-d H:i:s')
// );

// // Insert new user into the 'users' table
// $sql = "INSERT INTO users (oauth_provider, oauth_uid, first_name, last_name, email, gender, locale, picture, created, modified) 
//         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// $stmt = $databaseConnection->prepare($sql);

// // Bind parameters
// $stmt->bind_param(
//     'ssssssssss',
//     $newUser['oauth_provider'],
//     $newUser['oauth_uid'],
//     $newUser['first_name'],
//     $newUser['last_name'],
//     $newUser['email'],
//     $newUser['gender'],
//     $newUser['locale'],
//     $newUser['picture'],
//     $newUser['created'],
//     $newUser['modified']
// );

// // Execute the statement
// if ($stmt->execute()) {
//     echo "New user added successfully!";
// } else {
//     echo "Error: " . $stmt->error;
// }

// // Close the statement and connection
// $stmt->close();
// $databaseConnection->close();






// echo "<!DOCTYPE html>";
// echo '<html lang=""en"">';
// echo "<head>";
// echo    '<meta charset="UTF-8">';
// echo    '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
// echo    "<title>Document</title>";
// echo "</head>";
// echo "<body>";
// echo        '<h3><b>Database Connection Status:</b> ';
// echo        ($databaseConnection) ? 'Connected' : 'Not Connected';
// echo        '</h3>';
// echo "</body>";
// echo "</html>";










?>
