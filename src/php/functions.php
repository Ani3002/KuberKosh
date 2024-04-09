<?php
session_start();
require_once "database.php";
// require_once "google-auth.php";

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
function checkDuplicateEmail($email)
{
    global $databaseConnection;
    $query = "SELECT COUNT(*) as row FROM users WHERE email='$email'";
    $run = mysqli_query($databaseConnection, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

//for checking email id is already registered or not
function checkDuplicateMobile($mobile)
{
    global $databaseConnection;
    $query = "SELECT COUNT(*) as row FROM users WHERE mobile='$mobile'";
    $run = mysqli_query($databaseConnection, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

// Register new users by adding them to the database.
function addUser($databaseConnection, $newUser)
{
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

function getUserId($oauth_uid)
{
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

// Function to retrieve bank_name and regBank_id from table registeredBanks
function getRegisteredBanksIdAndName($databaseConnection)
{
    $banks = array();

    $query = "SELECT regBank_id, bank_name FROM registeredBanks";
    $result = $databaseConnection->query($query);

    while ($row = $result->fetch_assoc()) {
        $banks[] = array("regBank_id" => $row['regBank_id'], "val" => $row['bank_name']);
    }

    return $banks;
}

// Function to retrieve branches data from table bank_brunches
function getBranchesIdLocationIfscAndFKregBankId($databaseConnection)
{
    $branches = array();

    $query = "SELECT regBank_id, brunch_id, brunchLocation FROM bank_brunches";
    $result = $databaseConnection->query($query);

    while ($row = $result->fetch_assoc()) {
        $branches[$row['regBank_id']][] = array("regBank_id" => $row['regBank_id'], "val" => $row['brunchLocation']);
    }

    return $branches;
}


// Function to retrieve IFSC with the Bank name and the Location
function getIFSC($databaseConnection, $bankName, $location)
{
    // $query = "SELECT bb.ifsc 
    //           FROM bank_brunches bb
    //           JOIN registeredBanks rb ON bb.regBank_id = rb.regBank_id
    //           WHERE rb.bank_name = '$bankName' AND bb.brunchLocation = '$location'";
    $query = "SELECT bb.ifsc 
                FROM bank_brunches bb
                WHERE bb.brunch_id = '1' AND bb.brunchLocation = 'Winterfell'";
    $result = $databaseConnection->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['ifsc'];
    } else {
        return ""; // If no IFSC found, return empty string
    }
}

// Function to retrieve BankName with the regBank_id
function getBankName($databaseConnection, $regBank_id)
{
    $query = "SELECT bank_name FROM registeredBanks WHERE regBank_id = '$regBank_id'";
    $result = $databaseConnection->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['bank_name'];
    } else {
        return ""; // If no bank found, return empty string
    }
}

// Function to retrieve Default Account Number with the userId
function getDefaultBankAccountId($databaseConnection, $userId)
{
    $query = "SELECT default_bank_account_id FROM Bank WHERE user_id = '$userId'";
    $result = $databaseConnection->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['default_bank_account_id'];
    } else {
        return ""; // Return empty string if default account not found
    }
}

function getBankAccountId($databaseConnection, $bankUserId)
{
    $query = "SELECT bank_account_id FROM bank_accounts WHERE bank_user_id = '$bankUserId'";
    $result = $databaseConnection->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['bank_account_id']; // Return only the bank_account_id // Return all columns as an associative array
    } else {
        // return array(); // Return an empty array if no data found
        return "fgf";
    }
}

// Update Default account ID
function updateDefaultBankAccountId($databaseConnection, $bankAccountId, $userId){
    $sql_updateDefaultBankAccountId = "UPDATE Bank SET default_bank_account_id = $bankAccountId WHERE user_id = $userId";
        if (mysqli_query($databaseConnection, $sql_updateDefaultBankAccountId)) {
            echo '<script>alert("Default account updated successfully")</script>';
        } else {
            echo "Error updating default account: " . mysqli_error($databaseConnection);
        }
}

// Function to fetch bank account IDs for a given bank user ID
function getBankAccountDetails($databaseConnection, $bankUserId)
{
    $query = "SELECT * FROM bank_accounts WHERE bank_user_id = '$bankUserId'";
    $result = $databaseConnection->query($query);
    $accounts = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $accounts[] = $row;
        }
    }
    return $accounts;
}


 // Function to fetch walletDetails using the user_id fron the wallet table
function getWalletDetails($databaseConnection, $userId)
{
    $query = "SELECT * FROM  wallet WHERE user_id = '$userId'";
    $result = $databaseConnection->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row; // Return all columns as an associative array
    } else {
        return array(); // Return an empty array if no data found
    }
}


// Function to fetches bankUserId using the userId from the bank table
function getBankUserId($databaseConnection, $userId)
{
    $query = "SELECT bank_user_id FROM Bank WHERE user_id ='$userId'";
    $result = $databaseConnection->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['bank_user_id'];
    } else {
        return "";
    }
}


function insertWalletAddress($databaseConnection, $userId, $walletAddress) {
    // Escape the inputs to prevent SQL injection
    $userId = $databaseConnection->real_escape_string($userId);
    $walletAddress = $databaseConnection->real_escape_string($walletAddress);

    // Construct the SQL query
    $query = "INSERT INTO wallet (user_id, wallet_address) VALUES ('$userId', '$walletAddress')";

    // Execute the query
    $result = $databaseConnection->query($query);

    if ($result) {
        // Insertion successful
        return true;
    } else {
        // Insertion failed
        // Handle errors accordingly
        // For simplicity, let's just return false here
        return false;
    }
}





// Function to check if the wallet address is valid
// function isValidWalletAddress($databaseConnection, $walletAddress) {
//     // Escape the wallet address to prevent SQL injection
//     $walletAddress = $databaseConnection->real_escape_string($walletAddress);

//     // Query to check if the wallet address already exists in the database
//     $query = "SELECT COUNT(*) AS count FROM wallet WHERE wallet_address = '$walletAddress'";
//     $result = $databaseConnection->query($query);

//     // Check if the query was successful
//     if ($result) {
//         $row = $result->fetch_assoc();
//         $count = $row['count'];

//         // If count is 0, the wallet address is available
//         return $count == 0;
//     } else {
//         // Handle query error
//         // For simplicity, return false here
//         return false;
//     }
// }


?>