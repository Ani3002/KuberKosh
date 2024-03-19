<?php
session_start();
require_once "database.php";
require_once "google-auth.php";

// require_once "../../db/kuberkosh_db.sql";

// for including pages in index.php
// function viewHTML($page, $page_title = "")
// {
//     // echo "Including: $page.php";
//     include "pages/$page.html";
// }

// For including page in index.php
function viewPage($page, $page_title = "")
{
    include "pages/$page.php";
}

//for creating full site urls
function site_url($path)
{
    $site_url = "http://localhost/kuberkosh/";
    return $site_url . $path;
}

//for validating signup/login form
function validateUser($user_data)
{
    $oauth_uid = $user_data["oauth_uid"] ?? "";
    $first_name = $user_data["first_name"] ?? "";
    $last_name = $user_data["last_name"] ?? "";
    $email = $user_data["email_address"] ?? "";
    
    $return_data = [
        "status" => true,
        "msg" => "all fields are perfect",
    ];

    
    if (!$oauth_uid) {
        $return_data["status"] = false;
        $return_data["msg"] = "oauth_uid is blank";
        $return_data["field"] = "oauth_uid";
    }
    if (!$first_name) {
        $return_data["status"] = false;
        $return_data["msg"] = "first name is blank";
        $return_data["field"] = "first_name";
    }
    if (!$last_name) {
        $return_data["status"] = false;
        $return_data["msg"] = "last name is blank";
        $return_data["field"] = "last_name";
    }
    if (!$email) {
        $return_data["status"] = false;
        $return_data["msg"] = "email id is blank";
        $return_data["field"] = "email";
    }


    // Check if user is already registered

    // if (checkDuplicateEmail($email)) {
    //     $return_data["status"] = false;
    //     $return_data["msg"] = "Email Id Is Already Registered !";
    //     $return_data["field"] = "email";
    // }

    // if (checkDuplicateMobile($mobile)) {
    //     $return_data["status"] = false;
    //     $return_data["msg"] = "Mobile no is already registered !";
    //     $return_data["field"] = "mobile";
    // }

        return $return_data;
}

//for checking email id is already registered or not
function checkDuplicateEmail($email){
    global $databaseConnection;
    $query="SELECT COUNT(*) as row FROM users WHERE email='$email'";
    $run = mysqli_query($databaseConnection,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

//for checking email id is already registered or not
function checkDuplicateMobile($mobile){
    global $databaseConnection;
    $query="SELECT COUNT(*) as row FROM users WHERE mobile='$mobile'";
    $run = mysqli_query($databaseConnection,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

// Register new users by adding them to the database.
function addUser($databaseConnection, $newUser) {
    // Insert new user into the 'users' table
    $sql = "INSERT INTO users (oauth_provider, oauth_uid, first_name, last_name, email, gender, locale, picture, created, modified) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $databaseConnection->prepare($sql);

    // Bind parameters
    $stmt->bind_param(
        'ssssssssss',
        $newUser['oauth_provider'],
        $newUser['oauth_uid'],
        $newUser['first_name'],
        $newUser['last_name'],
        $newUser['email'],
        $newUser['gender'],
        $newUser['locale'],
        $newUser['picture'],
        $newUser['created'],
        $newUser['modified']
    );

    // Execute the statement
    $stmt->execute();
    // if ($stmt->execute()) {
    //     echo "New user added successfully!";
    // } else {
    //     echo "Error: " . $stmt->error;
    // }

    // Close the statement
    $stmt->close();
}

function getUserId($oauth_uid){
    global $databaseConnection;
    $query = "SELECT user_id FROM users WHERE oauth_uid = '$oauth_uid'";
    $run = mysqli_query($databaseConnection, $query);
    $return_data = mysqli_fetch_assoc($run);
    
    // Check if a user with the provided OAuth UID exists
    if ($return_data) {
        return $return_data['user_id'];
    } else {
        return false;
    }
}








// BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING 

// Function to retrieve banks data
function getBanksData($db) {
    $banks = array();

    $query = "SELECT regBank_id, bank_name FROM registeredBanks";
    $result = $db->query($query);

    while ($row = $result->fetch_assoc()) {
        $banks[] = array("regBank_id" => $row['regBank_id'], "val" => $row['bank_name']);
    }

    return $banks;
}

// Function to retrieve branches data
function getBranchesData($db) {
    $branches = array();

    $query = "SELECT regBank_id, brunch_id, brunchLocation FROM bank_brunches";
    $result = $db->query($query);

    while ($row = $result->fetch_assoc()) {
        $branches[$row['regBank_id']][] = array("regBank_id" => $row['regBank_id'], "val" => $row['brunchLocation']);
    }

    return $branches;
}



function getIFSC($db, $bankName, $location) {
    $query = "SELECT bb.ifsc 
              FROM bank_brunches bb
              JOIN registeredBanks rb ON bb.regBank_id = rb.regBank_id
              WHERE rb.bank_name = '$bankName' AND bb.brunchLocation = '$location'";
    $result = $db->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['ifsc'];
    } else {
        return ""; // If no IFSC found, return empty string
    }
}

function getBankName($db, $regBankId) {
    $query = "SELECT bank_name FROM registeredBanks WHERE regBank_id = '$regBankId'";
    $result = $db->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['bank_name'];
    } else {
        return ""; // If no bank found, return empty string
    }
}

function getDefaultAccountNumber($db, $userId) {
    $query = "SELECT default_account FROM Bank WHERE user_id = '$userId'";
    $result = $db->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['default_account'];
    } else {
        return ""; // Return empty string if default account not found
    }
}

function getBankDetails($db, $userId) {
    $query = "SELECT * FROM Bank WHERE user_id = '$userId'";
    $result = $db->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row; // Return all columns as an associative array
    } else {
        return array(); // Return an empty array if no data found
    }
}



?>