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


function insertSecretKeyInDb($userId, $newSecretKey, $connect_kuberkosh_db)
{
    $query = "SELECT `secret_key` FROM `users` WHERE `user_id` = '$userId'";

    // Execute the query
    $result = $connect_kuberkosh_db->query($query);

    // Check if there are any users with empty secret keys
    if ($result && $result->num_rows == 1) {
        // Loop through each user
        $row = $result->fetch_assoc();
        // $secretKey = $row['secret_key'];
        if (empty($secretKey)) {
            // Update the user's record with the secret key
            $updateQuery = "UPDATE `users` SET `secret_key` = '$newSecretKey' WHERE `user_id` = $userId";
            $connect_kuberkosh_db->query($updateQuery);

            return "Secret keys have been inserted successfully.";
        }

    }

}


// function insertSecretKeyInDb($userId, $newSecretKey, $connect_kuberkosh_db)
// {
//     $query = "SELECT `secret_key` FROM `users` WHERE `user_id` = '$userId'";

//     // Execute the query
//     $result = $connect_kuberkosh_db->query($query);

//     // Initialize the response array
//     $response = [
//         'TOTPenabled' => false,
//         'updateStatus' => 'No update performed'
//     ];

//     // Check if the query was successful and we have a result
//     if ($result && $result->num_rows == 1) {
//         $row = $result->fetch_assoc();
//         $secretKey = $row['secret_key'];
//         $response['TOTPenabled'] = !empty($secretKey);

//         // If TOTP is not enabled, update the user's record with the new secret key
//         if (empty($secretKey)) {
//             $updateQuery = "UPDATE `users` SET `secret_key` = '$newSecretKey' WHERE `user_id` = $userId";
//             $updateResult = $connect_kuberkosh_db->query($updateQuery);

//             $response['updateStatus'] = $updateResult ? 'Secret key updated successfully' : 'Failed to update secret key';
//         }
//     }

//     return $response;

// }



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
function getIFSC($connect_kuberkosh_db, $selectedBankId, $location)
{
    $query = "SELECT bb.ifsc 
              FROM bank_brunches bb
              JOIN registeredBanks rb ON bb.regBank_id = rb.regBank_id
              WHERE rb.regBank_id = '$selectedBankId' AND bb.brunchLocation = '$location'";
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


function fetchBankUserId($connect_kuberkosh_db, $userId)
{
    $query = "SELECT bank_user_id FROM Bank WHERE user_id = '$userId'";
    $result = $connect_kuberkosh_db->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['bank_user_id'];
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
function updateDefaultBankAccountId($connect_kuberkosh_db, $bankAccountId, $userId)
{
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

// Function to fetch Bank Name and Location with IFSC code  Function to fetch Bank Name and Location with IFSC code  Function to fetch Bank Name and Location with IFSC code  Function to fetch Bank Name and Location with IFSC code  
// Function to fetch Bank Name and Location with IFSC code  Function to fetch Bank Name and Location with IFSC code  Function to fetch Bank Name and Location with IFSC code  Function to fetch Bank Name and Location with IFSC code  
// Function to fetch Bank Name and Location with IFSC code  Function to fetch Bank Name and Location with IFSC code  Function to fetch Bank Name and Location with IFSC code  Function to fetch Bank Name and Location with IFSC code  
function fetchBankNameLocation($connect_kuberkosh_db, $ifsc)
{
    // Prepare and execute SQL query to fetch data
    $sql = "SELECT rb.bank_name, bb.brunchLocation
            FROM bank_brunches bb
            INNER JOIN registeredBanks rb ON bb.regBank_id = rb.regBank_id
            WHERE bb.ifsc = :ifsc";

    $stmt = $connect_kuberkosh_db->prepare($sql);
    $stmt->bindParam(':ifsc', $ifsc, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Close the statement
    $stmt->closeCursor();

    return $result;
}



// Function to fetch banks registered with the userId  Function to fetch banks registered with the userId  Function to fetch banks registered with the userId  Function to fetch banks registered with the userId  
// Function to fetch banks registered with the userId  Function to fetch banks registered with the userId  Function to fetch banks registered with the userId  Function to fetch banks registered with the userId  
// Function to fetch banks registered with the userId  Function to fetch banks registered with the userId  Function to fetch banks registered with the userId  Function to fetch banks registered with the userId  
// function getUserBanks($connect_kuberkosh_db, $userId)
// {
//     $userBanks = [];

//     // SQL query to get bank details for the given userId
//     $query = "
//                 SELECT
//                     bank_accounts.bank_account_id,
//                     bank_accounts.bank_name,
//                     bank_brunches.brunchLocation
//                 FROM
//                     Bank
//                 INNER JOIN
//                     bank_accounts ON Bank.bank_user_id = bank_accounts.bank_user_id
//                 INNER JOIN
//                     bank_brunches ON bank_accounts.ifsc_code = bank_brunches.ifsc
//                 WHERE
//                     Bank.user_id = '$userId'
//             ";
//     $result = $connect_kuberkosh_db->query($query);
//     if ($result) {
//         while ($row = $result->fetch_assoc()) {
//             $userBanks[] = [
//                 'bank_account_id' => $row['bank_account_id'],
//                 'bank_info' => $row['bank_name'] . ', ' . $row['brunchLocation']
//             ];
//         }
//     }

//     return $userBanks;
// }

function getUserBanks($connect_kuberkosh_db, $userId)
{
    $userBanks = [];

    // SQL query to get bank details for the given userId
    $query = "
                SELECT
                    bank_accounts.bank_account_id,
                    bank_accounts.bank_name,
                    bank_accounts.account_balance,
                    bank_accounts.account_number,
                    bank_brunches.brunchLocation
                FROM
                    Bank
                INNER JOIN
                    bank_accounts ON Bank.bank_user_id = bank_accounts.bank_user_id
                INNER JOIN
                    bank_brunches ON bank_accounts.ifsc_code = bank_brunches.ifsc
                WHERE
                    Bank.user_id = '$userId'
            ";
    $result = $connect_kuberkosh_db->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $userBanks[] = [
                'bank_account_id' => $row['bank_account_id'],
                'bank_info' => $row['bank_name'] . ', ' . $row['brunchLocation'],
                'account_no' => $row['account_number'],
                'accountBalance' => $row['account_balance']
            ];
        }
    }

    return $userBanks;
}






// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 
// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 
// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 
// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 
// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 
// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 
// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 
// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 
// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 
// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 
// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 
// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 
// WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET WALLET 


















// Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. 
// Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. 
// Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. Function to fetch walletDetails using the user_id from the wallet table. 
function fetchWalletDetails($connect_kuberkosh_db, $userId)
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

// Function to fetch Wallet Address  Function to fetch Wallet Address  Function to fetch Wallet Address  Function to fetch Wallet Address  Function to fetch Wallet Address  
// Function to fetch Wallet Address  Function to fetch Wallet Address  Function to fetch Wallet Address  Function to fetch Wallet Address  Function to fetch Wallet Address  
// Function to fetch Wallet Address  Function to fetch Wallet Address  Function to fetch Wallet Address  Function to fetch Wallet Address  Function to fetch Wallet Address  
//  function fetchWalletAddress($connect_kuberkosh_db, $userId)
// {
//     $query = "SELECT wallet_address FROM wallet WHERE user_id = ?";
//     $stmt = $connect_kuberkosh_db->prepare($query);
//     $stmt->bind_param("i", $userId);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     if ($result && $result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         return $row['wallet_address'];
//     } else {
//         return '';
//     }
// }


// Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. 
// Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. 
// Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. Function to Insert Wallet address in the wallet table. 
function insertWalletAddress($connect_kuberkosh_db, $userId, $walletAddress)
{
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
function doesExistWalletAddres($connect_kuberkosh_db, $walletAddress)
{
    // Escape the wallet address to prevent SQL injection
    $walletAddress = $connect_kuberkosh_db->real_escape_string($walletAddress);

    // Query to check if the wallet address already exists in the database
    $query = "SELECT COUNT(*) AS count FROM wallet WHERE wallet_address = '$walletAddress'";
    $result = $connect_kuberkosh_db->query($query);


    if (empty($walletAddress)) {
        return false;
    }
    // Check if the query was successful
    if ($result) {
        $row = $result->fetch_assoc();
        $count = $row['count'];

        // If count is 0, the wallet address is available
        if ($count == 0) {
            return false;
        } else {
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
function fetchUserIdViaWalletAddress($connect_kuberkosh_db, $walletAddress)
{

    $query = "SELECT user_id FROM wallet WHERE wallet_address = '$walletAddress'";

    $result = $connect_kuberkosh_db->query($query);
    if ($result && $result->num_rows > 0) {
        $user_id = $result->fetch_assoc();
        return $user_id['user_id'];
    } else {
        return "";
    }
}

// Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. 
// Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. 
// Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. Function to fetch Name via walletAddress. 
function fetchNameViaWalletAddress($connect_kuberkosh_db, $walletAddress)
{
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
function fetchProfilePictureLinkViaWalletAddress($connect_kuberkosh_db, $walletAddress)
{
    $user_id = fetchUserIdViaWalletAddress($connect_kuberkosh_db, $walletAddress);

    $query = "SELECT picture FROM users WHERE user_id = '$user_id'";

    $result = $connect_kuberkosh_db->query($query);
    if ($result && $result->num_rows > 0) {
        // Fetch the first and last names from the result
        $row = $result->fetch_assoc();
        $profilePicLink = isset($row['picture']) ? $row['picture'] : '';

        return $profilePicLink;
    } else {
        return 0;
    }
}

// function downloadProfilePicture($profilePicLink, $walletAddress)
// {
//     // Define the directory to save the profile pictures
//     $directory = 'assets/profilePics/';

//     // Create the directory if it doesn't exist
//     if (!file_exists($directory)) {
//         mkdir($directory, 0777, true);
//     }

//     // Define the file name
//     $fileName = $walletAddress . '.png';

//     // Define the file path
//     $filePath = $directory . $fileName;

//     // Download the image
//     file_put_contents($filePath, file_get_contents($profilePicLink));

//     return $filePath;
// }

// Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. 
// Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. 
// Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. Function to fetch WalletBalance via WallerId. 
function fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $userId)
{

    // $walletDetails = fetchWalletDetails($connect_kuberkosh_db, $userId);

    // $wallet_id = $walletDetails['wallet_id'];

    $wallet_id = fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_id'];

    if (!tableExists($connect_wallet_transactions_db, $wallet_id)) {
        createWalletTable($connect_wallet_transactions_db, $wallet_id);
    }

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

// Function to transferMoneyW2W. Function to transferMoneyW2W. Function to transferMoneyW2W. Function to transferMoneyW2W. Function to transferMoneyW2W. Function to transferMoneyW2W. 
// Function to transferMoneyW2W. Function to transferMoneyW2W. Function to transferMoneyW2W. Function to transferMoneyW2W. Function to transferMoneyW2W. Function to transferMoneyW2W. 
// Function to transferMoneyW2W. Function to transferMoneyW2W. Function to transferMoneyW2W. Function to transferMoneyW2W. Function to transferMoneyW2W. Function to transferMoneyW2W. 
function transferMoneyW2W($walletAddress, $amountToSend, $senderRemarks, $trnxPurpose, $connect_kuberkosh_db, $connect_wallet_transactions_db)
{
    $senderUserId = $_SESSION['user_id'];
    $receiverUserId = fetchUserIdViaWalletAddress($connect_kuberkosh_db, $walletAddress);

    $senderWalletAddress = fetchWalletDetails($connect_kuberkosh_db, $senderUserId)['wallet_address'];
    $receiverWalletAddress = $walletAddress;

    $senderWalletId = fetchWalletDetails($connect_kuberkosh_db, $senderUserId)['wallet_id'];
    $receiverWalletId = fetchWalletDetails($connect_kuberkosh_db, $receiverUserId)['wallet_id'];

    if (!tableExists($connect_wallet_transactions_db, $senderWalletId)) {
        createWalletTable($connect_wallet_transactions_db, $senderWalletId);
    }

    if (!tableExists($connect_wallet_transactions_db, $receiverWalletId)) {
        createWalletTable($connect_wallet_transactions_db, $receiverWalletId);
    }

    $receiverProfilePic = fetchProfilePictureLinkViaWalletAddress($connect_kuberkosh_db, $walletAddress);

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


    $senderParticulars = "W2W/DR/{$receiverName}/{$receiverWalletAddress}/{$receiverWalletId}/{$currentDateTime}/{$trnxPurpose}/{$senderRemarks}";
    $receiveParticulars = "W2W/CR/{$senderName}/{$senderWalletAddress}/{$senderWalletId}/{$currentDateTime}/{$trnxPurpose}/{$senderRemarks}";

    // Prepare sender query
    $senderQuery = "INSERT INTO `$senderWalletId` (`Date`, `Particulars`, `Trnx_id`, `debit`, `credit`, `end_balance`, `trnxPurpose`) 
    VALUES (?, ?, ?, ?, NULL, ?, ?)";

    // Prepare receiver query
    $receiverQuery = "INSERT INTO `$receiverWalletId` (`Date`, `Particulars`, `Trnx_id`, `debit`, `credit`, `end_balance`, `trnxPurpose`) 
    VALUES (?, ?, ?, NULL, ?, ?, ?)";

    // Bind parameters for sender query
    $senderStmt = $connect_wallet_transactions_db->prepare($senderQuery);
    $senderStmt->bind_param("ssssis", $currentDate, $senderParticulars, $trnxId, $amountToSend, $senderEndBalanceAfterTrnx, $trnxPurpose);

    // Bind parameters for receiver query
    $receiverStmt = $connect_wallet_transactions_db->prepare($receiverQuery);
    $receiverStmt->bind_param("ssssis", $currentDate, $receiveParticulars, $trnxId, $amountToSend, $receiverEndBalanceAfterTrnx, $trnxPurpose);

    // Execute stmt query
    $senderSuccess = $senderStmt->execute();
    $receiverSuccess = $receiverStmt->execute();

    $status = '';
    $senderError = '';
    $receiverError = '';

    if ($senderSuccess && $receiverSuccess) {
        // Both queries executed successfully
        $senderStmt->close();
        $receiverStmt->close();

        $senderLastTrnxId = fetchLastTrnxId($senderWalletId, $connect_wallet_transactions_db);
        $receiverLastTrnxId = fetchLastTrnxId($receiverWalletId, $connect_wallet_transactions_db);

        if ($senderLastTrnxId == $receiverLastTrnxId) {
            $response = array('success' => true, 'trnxId' => $trnxId, 'amountToSend' => $amountToSend, 'receiverWalletAddress' => $receiverWalletAddress, 'receiverName' => $receiverName, 'receiverProfilePic' => $receiverProfilePic, 'trnxMessage' => 'Transaction Successful');
            $status = 'Success';

            // Get user's IP address
            $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

            // Insert transaction log into the database
            $insertLogQuery = "INSERT INTO `transaction_logs` (`user_id`, `sender_wallet_id`, `receiver_wallet_id`, `transaction_id`, `amount`, `status`, `sender_error`, `receiver_error`, `ip_address`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertLogStmt = $connect_kuberkosh_db->prepare($insertLogQuery);
            $insertLogStmt->bind_param("iiissssss", $senderUserId, $senderWalletId, $receiverWalletId, $trnxId, $amountToSend, $status, $senderError, $receiverError, $userIP);
            $insertLogStmt->execute();
            $insertLogStmt->close();


            return $response;
        } else {
            $response = array('success' => false, 'error' => 'Transaction Error');
            $status = 'Failed';


            // Get user's IP address
            $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

            // Insert transaction log into the database
            $insertLogQuery = "INSERT INTO `transaction_logs` (`user_id`, `sender_wallet_id`, `receiver_wallet_id`, `transaction_id`, `amount`, `status`, `sender_error`, `receiver_error`, `ip_address`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertLogStmt = $connect_kuberkosh_db->prepare($insertLogQuery);
            $insertLogStmt->bind_param("iiissssss", $senderUserId, $senderWalletId, $receiverWalletId, $trnxId, $amountToSend, $status, $senderError, $receiverError, $userIP);
            $insertLogStmt->execute();
            $insertLogStmt->close();


            return $response;
        }

    } else {
        // Query execution failed for either sender or receiver
        $senderError = $senderStmt->error;
        $receiverError = $receiverStmt->error;

        // Log errors or handle them as needed
        // For simplicity, let's concatenate the errors
        $error = "Sender Error: $senderError, Receiver Error: $receiverError";

        $response = array('success' => false, 'error' => $error);
        $status = 'Failed';





        // Get user's IP address
        $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

        // Insert transaction log into the database
        $insertLogQuery = "INSERT INTO `transaction_logs` (`user_id`, `sender_wallet_id`, `receiver_wallet_id`, `transaction_id`, `amount`, `status`, `sender_error`, `receiver_error`, `ip_address`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertLogStmt = $connect_kuberkosh_db->prepare($insertLogQuery);
        $insertLogStmt->bind_param("iiissssss", $senderUserId, $senderWalletId, $receiverWalletId, $trnxId, $amountToSend, $status, $senderError, $receiverError, $userIP);
        $insertLogStmt->execute();
        $insertLogStmt->close();




        return $response;
    }

}


// Function to fetchLastTranxId. Function to fetchLastTranxId. Function to fetchLastTranxId. Function to fetchLastTranxId. Function to fetchLastTranxId. 
// Function to fetchLastTranxId. Function to fetchLastTranxId. Function to fetchLastTranxId. Function to fetchLastTranxId. Function to fetchLastTranxId. 
// Function to fetchLastTranxId. Function to fetchLastTranxId. Function to fetchLastTranxId. Function to fetchLastTranxId. Function to fetchLastTranxId. 
function fetchLastTrnxId($wallet_id, $connect_wallet_transactions_db)
{
    $query = "SELECT Trnx_id FROM `$wallet_id` ORDER BY trnx_no DESC LIMIT 1";

    $result = $connect_wallet_transactions_db->query($query);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $lastTrnxId = $row['Trnx_id'];
        return $lastTrnxId;
    } else {
        return null;
    }
}


// Function to Fetch Transaction details based on Trnx_Id  Amount and wallet Id. Function to Fetch Transaction details based on Trnx_Id  Amount and wallet Id. Function to Fetch Transaction details based on Trnx_Id  Amount and wallet Id. Function to Fetch Transaction details based on Trnx_Id  Amount and wallet Id. 
// Function to Fetch Transaction details based on Trnx_Id  Amount and wallet Id. Function to Fetch Transaction details based on Trnx_Id  Amount and wallet Id. Function to Fetch Transaction details based on Trnx_Id  Amount and wallet Id. Function to Fetch Transaction details based on Trnx_Id  Amount and wallet Id. 
// Function to Fetch Transaction details based on Trnx_Id  Amount and wallet Id. Function to Fetch Transaction details based on Trnx_Id  Amount and wallet Id. Function to Fetch Transaction details based on Trnx_Id  Amount and wallet Id. Function to Fetch Transaction details based on Trnx_Id  Amount and wallet Id. 


function getTrnxDetails($connect_wallet_transactions_db, $wallet_id, $transactionId, $amount)
{
    // Sanitize the wallet ID to prevent SQL injection
    $wallet_id = $connect_wallet_transactions_db->real_escape_string($wallet_id);

    // Prepare SQL statement with the dynamic table name
    $query = "SELECT * FROM `$wallet_id` WHERE `Trnx_id` = ? AND (`debit` = ? OR `credit` = ?)";

    // Prepare and bind parameters
    $stmt = $connect_wallet_transactions_db->prepare($query);
    $stmt->bind_param("iii", $transactionId, $amount, $amount);

    // Execute the statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Fetch associative array of the first row
        $row = $result->fetch_assoc();
        // Free result set
        $result->free_result();
        // Close statement
        $stmt->close();
        // Return the fetched row
        return $row;
    } else {
        // No matching row found, return null
        return null;
    }
}



// Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. 
// Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. 
// Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. 
// Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. Function to Fetch Transaction details based on Date Range and wallet Id. 
function getTrnxDetailsDateRange($connect_wallet_transactions_db, $wallet_id, $start_date, $end_date)
{
    // Sanitize the wallet ID to prevent SQL injection
    $wallet_id = $connect_wallet_transactions_db->real_escape_string($wallet_id);

    // Prepare SQL statement with the dynamic table name and date range
    $query = "SELECT * FROM `$wallet_id` WHERE `Date` BETWEEN ? AND ? ORDER BY `Date` DESC, `trnx_no` DESC";

    // Prepare and bind parameters
    $stmt = $connect_wallet_transactions_db->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);

    // Execute the statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Fetch all rows as an associative array
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        // Free result set
        $result->free_result();
        // Close statement
        $stmt->close();
        // Return the fetched rows
        return $rows;
    } else {
        // No matching rows found, return null
        return null;
    }
}


function extractParticularsParts($particulars, $part)
{
    $parts = explode('/', $particulars);
    return isset($parts[$part]) ? $parts[$part] : 'unknown_user';
}

// Function to check whether table in transactions db. Function to check whether table in transactions db. Function to check whether table in transactions db. Function to check whether table in transactions db. 
// Function to check whether table in transactions db. Function to check whether table in transactions db. Function to check whether table in transactions db. Function to check whether table in transactions db. 
// Function to check whether table in transactions db. Function to check whether table in transactions db. Function to check whether table in transactions db. Function to check whether table in transactions db. 
function tableExists($connect_wallet_transactions_db, $tableName)
{
    $result = $connect_wallet_transactions_db->query("SHOW TABLES LIKE '$tableName'");
    return $result && $result->num_rows > 0;
}


// Function to create a table for wallet transactions if it does not exist. Function to create a table for wallet transactions if it does not exist. Function to create a table for wallet transactions if it does not exist. Function to create a table for wallet transactions if it does not exist. 
// Function to create a table for wallet transactions if it does not exist. Function to create a table for wallet transactions if it does not exist. Function to create a table for wallet transactions if it does not exist. Function to create a table for wallet transactions if it does not exist. 
// Function to create a table for wallet transactions if it does not exist. Function to create a table for wallet transactions if it does not exist. Function to create a table for wallet transactions if it does not exist. Function to create a table for wallet transactions if it does not exist. 
function createWalletTable($connect_wallet_transactions_db, $tableName)
{
    // SQL query to create the table
    $sql = "CREATE TABLE `$tableName` (
              `trnx_no` int(15) NOT NULL AUTO_INCREMENT,
              `Date` date NOT NULL,
              `Particulars` varchar(300) NOT NULL,
              `Trnx_id` varchar(100) NOT NULL,
              `debit` int(11) DEFAULT NULL,
              `credit` int(11) DEFAULT NULL,
              `end_balance` int(11) NOT NULL,
              `trnxPurpose` varchar(100) DEFAULT NULL,
              PRIMARY KEY (`trnx_no`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

    // Execute query
    $connect_wallet_transactions_db->query($sql);
}











function addMoneyToWallet($connect_kuberkosh_db, $connect_wallet_transactions_db, $bankAccountId, $money_send_amount, $trnxRemarks, $wallet_id, $userId)
{
    $senderUserId = $_SESSION['user_id'];
    $receiverUserId = $_SESSION['user_id'];

    $senderBankAccountId = getBankAccountId($connect_kuberkosh_db, fetchBankUserId($connect_kuberkosh_db, $userId));

    $receiverWalletId = fetchWalletDetails($connect_kuberkosh_db, $senderUserId)['wallet_id'];

    $senderName = fetchNameViaWalletAddress($connect_kuberkosh_db, fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address']);
    $receiverName = fetchNameViaWalletAddress($connect_kuberkosh_db, fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address']);

    $receiverEndBalanceBeforeTrnx = fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $userId);

    $receiverEndBalanceAfterTrnx = $receiverEndBalanceBeforeTrnx + $money_send_amount;

    $currentDate = date('Y-m-d');
    $currentDateTime = date('YmdHis');

    $trnxId = $senderUserId . $receiverUserId . $receiverWalletId . $senderBankAccountId . $senderName . $receiverName . $receiverEndBalanceBeforeTrnx . $receiverEndBalanceAfterTrnx . $currentDateTime;
    $trnxId = hash("sha3-256", $trnxId);

    $trnxRemarks = $trnxRemarks ?? ''; // Ensure $trnxRemarks is not null
    $senderParticulars = "B2W/CR/{$receiverName}//{$senderBankAccountId}/{$currentDateTime}//{$trnxRemarks}";

    // Validate and sanitize the input
    if (!empty($bankAccountId) && is_numeric($bankAccountId) && !empty($money_send_amount) && is_numeric($money_send_amount)) {
        // Subtract money from the selected bank account
        $amount = (int) $money_send_amount; // Convert to integer for safety
        $query = "UPDATE bank_accounts SET account_balance = account_balance - $amount WHERE bank_account_id = $bankAccountId";
        $result = $connect_kuberkosh_db->query($query);

        // Check if the query was successful
        if ($result) {
            // Get the current balance from the wallet table
            $balanceQuery = "SELECT end_balance FROM `$wallet_id` ORDER BY trnx_no DESC LIMIT 1";
            $balanceResult = $connect_wallet_transactions_db->query($balanceQuery);

            if ($balanceResult) {
                $row = $balanceResult->fetch_assoc();
                $current_balance = $row['end_balance'];
                $new_balance = $current_balance + $amount;

                // Construct the particulars
                $currentDate = date('Y-m-d');
                $currentDateTime = date('YmdHis');

                // Insert the new transaction into the wallet table
                $insertQuery = "INSERT INTO `$wallet_id` (`Date`, `Particulars`, `Trnx_id`, `credit`, `end_balance`, `trnxPurpose`)
                                VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $connect_wallet_transactions_db->prepare($insertQuery);
                $trnxPurpose = 'Transfer from Bank';
                $stmt->bind_param("sssids", $currentDate, $senderParticulars, $trnxId, $amount, $new_balance, $trnxPurpose);

                // Execute the statement
                $insertResult = $stmt->execute();

                $status = '';
                $insertError = '';

                if ($insertResult) {
                    $status = 'Success';
                    echo '<script>alert("Money added successfully!")</script>';
                } else {
                    $status = 'Failed';
                    $insertError = $stmt->error;
                    echo '<script>alert("Error updating wallet balance.")</script>';
                }

                // Log the transaction
                $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
                $insertLogQuery = "INSERT INTO `transaction_logs` (`user_id`, `sender_wallet_id`, `receiver_wallet_id`, `transaction_id`, `amount`, `status`, `sender_error`, `receiver_error`, `ip_address`)
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $insertLogStmt = $connect_kuberkosh_db->prepare($insertLogQuery);
                $senderError = '';
                $receiverError = $insertError;
                $insertLogStmt->bind_param("iiissssss", $senderUserId, $wallet_id, $wallet_id, $trnxId, $amount, $status, $senderError, $receiverError, $userIP);
                $insertLogStmt->execute();
                $insertLogStmt->close();

                $stmt->close();
            } else {
                echo '<script>alert("Error retrieving current wallet balance.")</script>';
            }
        } else {
            echo '<script>alert("Error updating bank account balance.")</script>';
        }
    } else {
        echo '<script>alert("Invalid bank account ID or amount.")</script>';
    }
}






function withdrawMoneyFromWallet($connect_kuberkosh_db, $connect_wallet_transactions_db, $bankAccountId, $money_withdraw_amount, $trnxRemarks, $userId)
{
    // Fetch the wallet balance
    $current_balance = fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $userId);

    $senderUserId = $_SESSION['user_id'];
    $receiverUserId = $_SESSION['user_id'];

    $receiverBankAccountId = getBankAccountId($connect_kuberkosh_db, fetchBankUserId($connect_kuberkosh_db, $userId));

    $senderWalletId = fetchWalletDetails($connect_kuberkosh_db, $senderUserId)['wallet_id'];

    $senderName = fetchNameViaWalletAddress($connect_kuberkosh_db, fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address']);
    $receiverName = fetchNameViaWalletAddress($connect_kuberkosh_db, fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address']);

    $senderEndBalanceBeforeTrnx = fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $senderUserId);

    $senderEndBalanceAfterTrnx = $senderEndBalanceBeforeTrnx - $money_withdraw_amount;

    $currentDate = date('Y-m-d');
    $currentDateTime = date('YmdHis');

    $trnxId = $senderUserId . $receiverUserId . $senderWalletId . $receiverBankAccountId . $senderName . $receiverName . $senderEndBalanceBeforeTrnx . $senderEndBalanceAfterTrnx . $currentDateTime;
    $trnxId = hash("sha3-256", $trnxId);

    $trnxRemarks = $trnxRemarks ?? ''; // Ensure $trnxRemarks is not null
    $senderParticulars = "W2B/DR/{$receiverName}//{$receiverBankAccountId}/{$currentDateTime}//{$trnxRemarks}";


    // Validate and sanitize the input
    if (!empty($bankAccountId) && is_numeric($bankAccountId) && !empty($money_withdraw_amount) && is_numeric($money_withdraw_amount)) {
        $amount = (int) $money_withdraw_amount; // Convert to integer for safety
        if ($current_balance !== null && $current_balance >= $amount) {
            // Fetch wallet details
            $walletDetails = fetchWalletDetails($connect_kuberkosh_db, $userId);
            $wallet_id = $walletDetails['wallet_id'];

            // Subtract money from the wallet
            $new_balance = $current_balance - $amount;

            // Insert the new transaction into the wallet table using prepared statement
            $insertQuery = "INSERT INTO `$wallet_id` (`Date`, `Particulars`, `Trnx_id`, `debit`, `end_balance`, `trnxPurpose`)
                        VALUES (?, ?, ?, ?, ?, ?)";
            $insertStmt = $connect_wallet_transactions_db->prepare($insertQuery);
            $trnxPurpose = 'Transfer to Bank';
            $insertStmt->bind_param("sssids", $currentDate, $senderParticulars, $trnxId, $amount, $new_balance, $trnxPurpose);

            $insertSuccess = $insertStmt->execute();

            $status = '';
            $insertError = '';
            $bankAccQueryError = '';
            if ($insertSuccess) {

                $insertStmt->close();
                // Add money to the selected bank account
                // $bankAccQuery = "UPDATE bank_accounts SET account_balance = account_balance + $amount WHERE bank_account_id = $bankAccountId";
                $bankAccQuery = "UPDATE bank_accounts SET account_balance = account_balance + $amount WHERE bank_account_id = $bankAccountId";

                $bankAccQueryStmt = $connect_kuberkosh_db->query($bankAccQuery);

                if ($bankAccQueryStmt) {
                    // Fetch user banks to get the account number
                    $userBanks = getUserBanks($connect_kuberkosh_db, $userId);
                    $accountNumber = '';
                    foreach ($userBanks as $bank) {
                        if ($bank['bank_account_id'] == $bankAccountId) {
                            $accountNumber = $bank['account_no'];
                            $bankName = $bank['bank_info'];
                            break;
                        }
                    }
                    $response = array(
                        'success' => true,
                        'trnxId' => $trnxId,
                        'money_withdraw_amount' => $money_withdraw_amount,
                        'bankAccountId' => $bankAccountId,
                        'account_number' => $accountNumber,
                        'bankName' => $bankName,
                        'trnxMessage' => 'Withdraw Successful'
                    );
                    // echo '<script>alert("Money withdrawn successfully!")</script>';
                    return $response;

                } else {
                    $response = array('success' => false, 'error' => 'Transaction Error. If Money Debited from Wallet contact Support Team.');
                    $status = 'Failed';
                    $bankAccQueryError = $bankAccQueryStmt->error;

                    // Get user's IP address
                    $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

                    // Insert transaction log into the database
                    $insertLogQuery = "INSERT INTO `transaction_logs` (`user_id`, `sender_wallet_id`, `receiver_wallet_id`, `transaction_id`, `amount`, `status`, `sender_error`, `receiver_error`, `ip_address`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $insertLogStmt = $connect_kuberkosh_db->prepare($insertLogQuery);
                    $insertLogStmt->bind_param("iiissssss", $senderUserId, $senderWalletId, $bankAccountId, $trnxId, $money_withdraw_amount, $status, $bankAccQueryError, $bankAccQueryError, $userIP);
                    $insertLogStmt->execute();
                    $insertLogStmt->close();

                    // echo '<script>alert("Error updating bank account balance.")</script>';
                    return $response;
                }
            } else {
                // Query execution failed for either sender or receiver
                $insertError = $insertStmt->error;

                $error = "Transaction Error. Money Not Debited from Wallet.";
                $response = array('success' => false, 'error' => $error);
                $status = 'Failed';

                // Get user's IP address
                $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

                // Insert transaction log into the database
                $insertLogQuery = "INSERT INTO `transaction_logs` (`user_id`, `sender_wallet_id`, `receiver_wallet_id`, `transaction_id`, `amount`, `status`, `sender_error`, `receiver_error`, `ip_address`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $insertLogStmt = $connect_kuberkosh_db->prepare($insertLogQuery);
                $insertLogStmt->bind_param("iiissssss", $senderUserId, $senderWalletId, $bankAccountId, $trnxId, $money_withdraw_amount, $status, $insertError, $insertError, $userIP);
                $insertLogStmt->execute();
                $insertLogStmt->close();

                // echo '<script>alert("Transaction Error. Money Not Debited from Wallet.")</script>';
                return $response;
            }
        } else {

            $error = "Transaction Error. Insufficient wallet balance.";
            $response = array('success' => false, 'error' => $error);
            $status = 'Failed';
            // echo '<script>alert("Insufficient wallet balance.")</script>';
            return $response;
        }
    } else {
        $error = "Transaction Error. Invalid bank account ID or amount.";
        $response = array('success' => false, 'error' => $error);
        $status = 'Failed';
        // echo '<script>alert("Invalid bank account ID or amount.")</script>';
        return $response;
    }

}

?>