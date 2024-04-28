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

// For validating signup/login form.For validating signup/login form.For validating signup/login form.For validating signup/login form.For validating signup/login form.
// For validating signup/login form.For validating signup/login form.For validating signup/login form.For validating signup/login form.For validating signup/login form.
// For validating signup/login form.For validating signup/login form.For validating signup/login form.For validating signup/login form.For validating signup/login form.
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

// For Checking whether Email Exists in db. For Checking whether Email Exists in db.For Checking whether Email Exists in db.For Checking whether Email Exists in db.
// For Checking whether Email Exists in db. For Checking whether Email Exists in db.For Checking whether Email Exists in db.For Checking whether Email Exists in db.
// For Checking whether Email Exists in db. For Checking whether Email Exists in db.For Checking whether Email Exists in db.For Checking whether Email Exists in db.
function doesEmailExist($email)
{
    global $connect_kuberkosh_db;
    $query = "SELECT COUNT(*) as row FROM users WHERE email='$email'";
    $run = mysqli_query($connect_kuberkosh_db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

// For Checking whether Mobile Exists in db. For Checking whether Mobile Exists in db. For Checking whether Mobile Exists in db. For Checking whether Mobile Exists in db. 
// For Checking whether Mobile Exists in db. For Checking whether Mobile Exists in db. For Checking whether Mobile Exists in db. For Checking whether Mobile Exists in db. 
// For Checking whether Mobile Exists in db. For Checking whether Mobile Exists in db. For Checking whether Mobile Exists in db. For Checking whether Mobile Exists in db.
function doesMobileExist($mobile)
{
    global $connect_kuberkosh_db;
    $query = "SELECT COUNT(*) as row FROM users WHERE mobile='$mobile'";
    $run = mysqli_query($connect_kuberkosh_db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

// Register new users by adding them to the database. Register new users by adding them to the database. Register new users by adding them to the database. Register new users by adding them to the database. 
// Register new users by adding them to the database. Register new users by adding them to the database. Register new users by adding them to the database. Register new users by adding them to the database. 
// Register new users by adding them to the database. Register new users by adding them to the database. Register new users by adding them to the database. Register new users by adding them to the database. 
function addUser($connect_kuberkosh_db, $newUser)
{
    // Insert new user into the 'users' table
    $sql = "INSERT INTO users (oauth_provider, oauth_uid, first_name, last_name, email, gender, locale, picture, created, modified) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $connect_kuberkosh_db->prepare($sql);

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

// Function to Fetch UserID with oauth_uid. Function to Fetch UserID with oauth_uid. Function to Fetch UserID with oauth_uid. Function to Fetch UserID with oauth_uid. 
// Function to Fetch UserID with oauth_uid. Function to Fetch UserID with oauth_uid. Function to Fetch UserID with oauth_uid. Function to Fetch UserID with oauth_uid. 
// Function to Fetch UserID with oauth_uid. Function to Fetch UserID with oauth_uid. Function to Fetch UserID with oauth_uid. Function to Fetch UserID with oauth_uid. 
function getUserId($oauth_uid)
{
    global $connect_kuberkosh_db;
    $query = "SELECT user_id FROM users WHERE oauth_uid = '$oauth_uid'";
    $run = mysqli_query($connect_kuberkosh_db, $query);
    $return_data = mysqli_fetch_assoc($run);

    // Check if a user with the provided OAuth UID exists
    if ($return_data) {
        return $return_data['user_id'];
    } else {
        return false;
    }
}





// BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING 
// BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING 
// BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING 
// BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING 
// BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING 
// BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING 
// BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING 
// BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING 
// BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING 
// BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING 
// BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING BANKING 




// Function to retrieve bank_name and regBank_id from table registeredBanks. Function to retrieve bank_name and regBank_id from table registeredBanks. Function to retrieve bank_name and regBank_id from table registeredBanks. Function to retrieve bank_name and regBank_id from table registeredBanks. 
// Function to retrieve bank_name and regBank_id from table registeredBanks. Function to retrieve bank_name and regBank_id from table registeredBanks. Function to retrieve bank_name and regBank_id from table registeredBanks. Function to retrieve bank_name and regBank_id from table registeredBanks. 
// Function to retrieve bank_name and regBank_id from table registeredBanks. Function to retrieve bank_name and regBank_id from table registeredBanks. Function to retrieve bank_name and regBank_id from table registeredBanks. Function to retrieve bank_name and regBank_id from table registeredBanks. 
function getRegisteredBanksIdAndName($connect_kuberkosh_db)
{
    $banks = array();

    $query = "SELECT regBank_id, bank_name FROM registeredBanks";
    $result = $connect_kuberkosh_db->query($query);

    while ($row = $result->fetch_assoc()) {
        $banks[] = array("regBank_id" => $row['regBank_id'], "val" => $row['bank_name']);
    }

    return $banks;
}

// Function to retrieve branches data from table bank_brunches. Function to retrieve branches data from table bank_brunches. Function to retrieve branches data from table bank_brunches. Function to retrieve branches data from table bank_brunches. 
// Function to retrieve branches data from table bank_brunches. Function to retrieve branches data from table bank_brunches. Function to retrieve branches data from table bank_brunches. Function to retrieve branches data from table bank_brunches. 
// Function to retrieve branches data from table bank_brunches. Function to retrieve branches data from table bank_brunches. Function to retrieve branches data from table bank_brunches. Function to retrieve branches data from table bank_brunches. 
function getBranchesIdLocationIfscAndFKregBankId($connect_kuberkosh_db)
{
    $branches = array();

    $query = "SELECT regBank_id, brunch_id, brunchLocation FROM bank_brunches";
    $result = $connect_kuberkosh_db->query($query);

    while ($row = $result->fetch_assoc()) {
        $branches[$row['regBank_id']][] = array("regBank_id" => $row['regBank_id'], "val" => $row['brunchLocation']);
    }

    return $branches;
}


// Function to retrieve IFSC with the Bank name and the Location. Function to retrieve IFSC with the Bank name and the Location. Function to retrieve IFSC with the Bank name and the Location. Function to retrieve IFSC with the Bank name and the Location. 
// Function to retrieve IFSC with the Bank name and the Location. Function to retrieve IFSC with the Bank name and the Location. Function to retrieve IFSC with the Bank name and the Location. Function to retrieve IFSC with the Bank name and the Location. 
// Function to retrieve IFSC with the Bank name and the Location. Function to retrieve IFSC with the Bank name and the Location. Function to retrieve IFSC with the Bank name and the Location. Function to retrieve IFSC with the Bank name and the Location. 
function getIFSC($connect_kuberkosh_db, $bankName, $location)
{
    // $query = "SELECT bb.ifsc 
    //           FROM bank_brunches bb
    //           JOIN registeredBanks rb ON bb.regBank_id = rb.regBank_id
    //           WHERE rb.bank_name = '$bankName' AND bb.brunchLocation = '$location'";
    $query = "SELECT bb.ifsc 
                FROM bank_brunches bb
                WHERE bb.brunch_id = '1' AND bb.brunchLocation = 'Winterfell'";
    $result = $connect_kuberkosh_db->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['ifsc'];
    } else {
        return ""; // If no IFSC found, return empty string
    }
}

// Function to retrieve BankName with the regBank_id. Function to retrieve BankName with the regBank_id. Function to retrieve BankName with the regBank_id. Function to retrieve BankName with the regBank_id. Function to retrieve BankName with the regBank_id. 
// Function to retrieve BankName with the regBank_id. Function to retrieve BankName with the regBank_id. Function to retrieve BankName with the regBank_id. Function to retrieve BankName with the regBank_id. Function to retrieve BankName with the regBank_id. 
// Function to retrieve BankName with the regBank_id. Function to retrieve BankName with the regBank_id. Function to retrieve BankName with the regBank_id. Function to retrieve BankName with the regBank_id. Function to retrieve BankName with the regBank_id. 
function getBankName($connect_kuberkosh_db, $regBank_id)
{
    $query = "SELECT bank_name FROM registeredBanks WHERE regBank_id = '$regBank_id'";
    $result = $connect_kuberkosh_db->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['bank_name'];
    } else {
        return ""; // If no bank found, return empty string
    }
}

// Function to retrieve Default Account Number with the userId. Function to retrieve Default Account Number with the userId. Function to retrieve Default Account Number with the userId. Function to retrieve Default Account Number with the userId. 
// Function to retrieve Default Account Number with the userId. Function to retrieve Default Account Number with the userId. Function to retrieve Default Account Number with the userId. Function to retrieve Default Account Number with the userId. 
// Function to retrieve Default Account Number with the userId. Function to retrieve Default Account Number with the userId. Function to retrieve Default Account Number with the userId. Function to retrieve Default Account Number with the userId. 
function getDefaultBankAccountId($connect_kuberkosh_db, $userId)
{
    $query = "SELECT default_bank_account_id FROM Bank WHERE user_id = '$userId'";
    $result = $connect_kuberkosh_db->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['default_bank_account_id'];
    } else {
        return ""; // Return empty string if default account not found
    }
}

// Function to fetch bankAccountId with the bankUserId. Function to fetch bankAccountId with the bankUserId. Function to fetch bankAccountId with the bankUserId. Function to fetch bankAccountId with the bankUserId. 
// Function to fetch bankAccountId with the bankUserId. Function to fetch bankAccountId with the bankUserId. Function to fetch bankAccountId with the bankUserId. Function to fetch bankAccountId with the bankUserId. 
// Function to fetch bankAccountId with the bankUserId. Function to fetch bankAccountId with the bankUserId. Function to fetch bankAccountId with the bankUserId. Function to fetch bankAccountId with the bankUserId. 
function getBankAccountId($connect_kuberkosh_db, $bankUserId)
{
    $query = "SELECT bank_account_id FROM bank_accounts WHERE bank_user_id = '$bankUserId'";
    $result = $connect_kuberkosh_db->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['bank_account_id']; // Return only the bank_account_id // Return all columns as an associative array
    } else {
        // return array(); // Return an empty array if no data found
        return "fgf";
    }
}

// Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. 
// Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. 
// Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. Update Default account ID. 
function updateDefaultBankAccountId($connect_kuberkosh_db, $bankAccountId, $userId){
    $sql_updateDefaultBankAccountId = "UPDATE Bank SET default_bank_account_id = $bankAccountId WHERE user_id = $userId";
        if (mysqli_query($connect_kuberkosh_db, $sql_updateDefaultBankAccountId)) {
            echo '<script>alert("Default account updated successfully")</script>';
        } else {
            echo "Error updating default account: " . mysqli_error($connect_kuberkosh_db);
        }
}

// Function to fetch bank account Details for a given bank user ID. Function to fetch bank account Details for a given bank user ID. Function to fetch bank account Details for a given bank user ID. Function to fetch bank account Details for a given bank user ID. 
// Function to fetch bank account Details for a given bank user ID. Function to fetch bank account Details for a given bank user ID. Function to fetch bank account Details for a given bank user ID. Function to fetch bank account Details for a given bank user ID. 
// Function to fetch bank account Details for a given bank user ID. Function to fetch bank account Details for a given bank user ID. Function to fetch bank account Details for a given bank user ID. Function to fetch bank account Details for a given bank user ID. 
function getBankAccountDetails($connect_kuberkosh_db, $bankUserId)
{
    $query = "SELECT * FROM bank_accounts WHERE bank_user_id = '$bankUserId'";
    $result = $connect_kuberkosh_db->query($query);
    $accounts = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $accounts[] = $row;
        }
    }
    return $accounts;
}


 // Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. 
 // Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. 
 // Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. 
function getWalletDetails($connect_kuberkosh_db, $userId)
{
    $query = "SELECT * FROM  wallet WHERE user_id = '$userId'";
    $result = $connect_kuberkosh_db->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row; // Return all columns as an associative array
    } else {
        return array(); // Return an empty array if no data found
    }
}


// Function to fetches bankUserId using the userId. Function to fetches bankUserId using the userId. Function to fetches bankUserId using the userId. Function to fetches bankUserId using the userId. 
// Function to fetches bankUserId using the userId. Function to fetches bankUserId using the userId. Function to fetches bankUserId using the userId. Function to fetches bankUserId using the userId. 
// Function to fetches bankUserId using the userId. Function to fetches bankUserId using the userId. Function to fetches bankUserId using the userId. Function to fetches bankUserId using the userId. 
function getBankUserId($connect_kuberkosh_db, $userId)
{
    $query = "SELECT bank_user_id FROM Bank WHERE user_id ='$userId'";
    $result = $connect_kuberkosh_db->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['bank_user_id'];
    } else {
        return "";
    }
}

// Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. 
// Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. 
// Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. 
function insertWalletAddress($connect_kuberkosh_db, $userId, $walletAddress) {
    // Escape the inputs to prevent SQL injection
    $userId = $connect_kuberkosh_db->real_escape_string($userId);
    $walletAddress = $connect_kuberkosh_db->real_escape_string($walletAddress);

    // Construct the SQL query
    $query = "INSERT INTO wallet (user_id, wallet_address) VALUES ('$userId', '$walletAddress')";

    // Execute the query
    $result = $connect_kuberkosh_db->query($query);

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


// Function to check whether the wallet address already exists in the database and is valid. Function to check whether the wallet address already exists in the database and is valid. Function to check whether the wallet address already exists in the database and is valid. 
// Function to check whether the wallet address already exists in the database and is valid. Function to check whether the wallet address already exists in the database and is valid. Function to check whether the wallet address already exists in the database and is valid. 
// Function to check whether the wallet address already exists in the database and is valid. Function to check whether the wallet address already exists in the database and is valid. Function to check whether the wallet address already exists in the database and is valid. 
function doesExistWalletAddres($connect_kuberkosh_db, $walletAddress) {
    // Escape the wallet address to prevent SQL injection
    $walletAddress = $connect_kuberkosh_db->real_escape_string($walletAddress);

    // Query to check if the wallet address already exists in the database
    $query = "SELECT COUNT(*) AS count FROM wallet WHERE wallet_address = '$walletAddress'";
    $result = $connect_kuberkosh_db->query($query);


    if(empty($walletAddress)){
        return false;
    }
    // Check if the query was successful
    if ($result) {
        $row = $result->fetch_assoc();
        $count = $row['count'];
        
        // If count is 0, the wallet address is available
        if ($count == 0) {
            return false;
        }
        else{
            return true;
        }
        
    } else {
        // Handle query error
        // For now, lets return false here
        return false;
    }
}

// Function to fetch UserId from walletAddress. Function to fetch UserId from walletAddress. Function to fetch UserId from walletAddress. Function to fetch UserId from walletAddress. 
// Function to fetch UserId from walletAddress. Function to fetch UserId from walletAddress. Function to fetch UserId from walletAddress. Function to fetch UserId from walletAddress. 
// Function to fetch UserId from walletAddress. Function to fetch UserId from walletAddress. Function to fetch UserId from walletAddress. Function to fetch UserId from walletAddress. 
function fetchUserIdViaWalletAddress($connect_kuberkosh_db, $walletAddress){

    $query = "SELECT user_id FROM wallet WHERE wallet_address = '$walletAddress'";

    $result = $connect_kuberkosh_db->query($query);
    if ($result && $result->num_rows > 0) {
        $user_id = $result->fetch_assoc();
        return $user_id['user_id'];
    } else {
        return "";
}}

// Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. 
// Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. 
// Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. 
function fetchNameViaWalletAddress($connect_kuberkosh_db, $walletAddress){
    $user_id = fetchUserIdViaWalletAddress($connect_kuberkosh_db, $walletAddress);

    $query = "SELECT first_name, last_name FROM users WHERE user_id = '$user_id'";

    $result = $connect_kuberkosh_db->query($query);
    if ($result && $result->num_rows > 0) {
        // Fetch the first and last names from the result
        $row = $result->fetch_assoc();
        $first_name = isset($row['first_name']) ? $row['first_name'] : ''; 
        $last_name = isset($row['last_name']) ? $row['last_name'] : '';

        $full_name = $first_name . ' ' . $last_name;

        return $full_name;
    } else {
        return "";
    }
}

// Function to fetch ProfilePictureLink via walletAddress. Function to fetch ProfilePictureLink via walletAddress. Function to fetch ProfilePictureLink via walletAddress. Function to fetch ProfilePictureLink via walletAddress. 
// Function to fetch ProfilePictureLink via walletAddress. Function to fetch ProfilePictureLink via walletAddress. Function to fetch ProfilePictureLink via walletAddress. Function to fetch ProfilePictureLink via walletAddress. 
// Function to fetch ProfilePictureLink via walletAddress. Function to fetch ProfilePictureLink via walletAddress. Function to fetch ProfilePictureLink via walletAddress. Function to fetch ProfilePictureLink via walletAddress. 
function fetchProfilePictureLinkViaWalletAddress($connect_kuberkosh_db, $walletAddress){
    $user_id = fetchUserIdViaWalletAddress($connect_kuberkosh_db, $walletAddress);

    $query = "SELECT picture FROM users WHERE user_id = '$user_id'";

    $result = $connect_kuberkosh_db->query($query);
    if ($result && $result->num_rows > 0) {
        // Fetch the first and last names from the result
        $row = $result->fetch_assoc();
        $profilePicLink = isset($row['picture']) ? $row['picture'] : ''; 

        return $profilePicLink;
    } else {
        return 0 ;
    }
}

// Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. 
// Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. 
// Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. 
function fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $userId){
    
    $walletDetails = getWalletDetails($connect_kuberkosh_db, $userId);

    $wallet_id = $walletDetails['wallet_id'];

    $query = "SELECT end_balance FROM `$wallet_id` ORDER BY trnx_no DESC LIMIT 1";

    $result = $connect_wallet_transactions_db->query($query);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $end_balance = $row['end_balance'];
        return $end_balance;
    } else {
        return null;
    }
}


function transferMoneyW2W($walletAddress, $amountToSend, $connect_kuberkosh_db, $connect_wallet_transactions_db){
    $senderUserId = $_SESSION['user_id'];
    $receiverUserId = fetchUserIdViaWalletAddress($connect_kuberkosh_db, $walletAddress);

    $senderWalletAddress = getWalletDetails($connect_kuberkosh_db, $senderUserId)['wallet_address'];
    $receiverWalletAddress = $walletAddress;

    $senderWalletId = getWalletDetails($connect_kuberkosh_db, $senderUserId)['wallet_id'];
    $receiverWalletId = getWalletDetails($connect_kuberkosh_db, $receiverUserId)['wallet_id'];

    $senderName = fetchNameViaWalletAddress($connect_kuberkosh_db, $walletAddress);
    $receiverName = fetchNameViaWalletAddress($connect_kuberkosh_db, $walletAddress);

    $senderEndBalanceBeforeTrnx = fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $senderUserId);
    $receiverEndBalanceBeforeTrnx = fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $receiverUserId);

    $senderEndBalanceAfterTrnx = $senderEndBalanceBeforeTrnx - $amountToSend;
    $receiverEndBalanceAfterTrnx = $receiverEndBalanceBeforeTrnx + $amountToSend;

    $currentDate = date('Y-m-d');
    $currentDateTime = date('YmdHis');


    $trnxId = $senderUserId . $receiverUserId . $senderWalletId . $receiverWalletId . $senderName . $receiverName . $senderEndBalanceBeforeTrnx . $receiverEndBalanceAfterTrnx . $senderEndBalanceAfterTrnx . $receiverEndBalanceAfterTrnx . $currentDateTime;
    $trnxId = hash("sha3-256", $trnxId);


    $senderParticulars = "W2W/DR/{$receiverName}/{$receiverWalletAddress}/{$receiverWalletId}/{$currentDateTime}";
    $receiveParticulars = "W2W/CR/{$senderName}/{$senderWalletAddress}/{$senderWalletId}/{$currentDateTime}";

    // Prepare sender query
    $senderQuery = "INSERT INTO `$senderWalletId` (`Date`, `Particulars`, `Trnx_id`, `debit`, `credit`, `end_balance`) 
    VALUES (?, ?, ?, ?, NULL, ?)";

    // Prepare receiver query
    $receiverQuery = "INSERT INTO `$receiverWalletId` (`Date`, `Particulars`, `Trnx_id`, `debit`, `credit`, `end_balance`) 
    VALUES (?, ?, ?, NULL, ?, ?)";

    // Bind parameters for sender query
    $senderStmt = $connect_wallet_transactions_db->prepare($senderQuery);
    $senderStmt->bind_param("ssssi", $currentDate, $senderParticulars, $trnxId, $amountToSend, $senderEndBalanceAfterTrnx);

    // Bind parameters for receiver query
    $receiverStmt = $connect_wallet_transactions_db->prepare($receiverQuery);
    $receiverStmt->bind_param("ssssi", $currentDate, $receiveParticulars, $trnxId, $amountToSend, $receiverEndBalanceAfterTrnx);

    // Execute stmt query
    $senderSuccess = $senderStmt->execute();
    $receiverSuccess = $receiverStmt->execute();

    if ($senderSuccess && $receiverSuccess) {
        // Both queries executed successfully
        $senderStmt->close();
        $receiverStmt->close();

        $senderLastTrnxId = fetchLastTrnxId($senderWalletId, $connect_wallet_transactions_db);
        $receiverLastTrnxId = fetchLastTrnxId($receiverWalletId, $connect_wallet_transactions_db);

        if ($senderLastTrnxId == $receiverLastTrnxId)
        {
            $response = array ('success' => true, 'trnxId' => $trnxId);
            return $response;
        }
        else
        {
            $response = array ('success' => false, 'error' => 'Transaction Error');
            return $response;
        }

    } else {
        // Query execution failed for either sender or receiver
        $senderError = $senderStmt->error;
        $receiverError = $receiverStmt->error;

        // Log errors or handle them as needed
        // For simplicity, let's concatenate the errors
        $error = "Sender Error: $senderError, Receiver Error: $receiverError";

        $response = array ('success' => false, 'error' => $error);
        return $response;
    }

}



function fetchLastTrnxId($wallet_id, $connect_wallet_transactions_db)
{
    // Query to fetch last transaction ID
    // $query = "SELECT Trnx_id FROM `$wallet_id` ORDER BY trnx_no DESC LIMIT 1";

    // Prepare stmt query
    // $stmt = $connect_wallet_transactions_db->prepare($query);
    // if (!$stmt) {
    //     echo "Error preparing query: " . $connect_wallet_transactions_db->error;
    //     exit;
    // }

    // $stmt->execute();
    // $stmt->bind_result($lastTrnxId);
    // $stmt->fetch();
    // $stmt->close();

    // return $lastTrnxId;




    $query = "SELECT Trnx_id FROM `$wallet_id` ORDER BY trnx_no DESC LIMIT 1";

    $result = $connect_wallet_transactions_db->query($query);
    
    if ($result && $result->num_rows = 1) {
        $row = $result->fetch_assoc();
        $lastTrnxId = $row['Trnx_id'];
        return $lastTrnxId;
    } else {
        return null;
    }
}



?>