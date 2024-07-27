<?php
/* This PHP script facilitates Google OAuth2 authentication for users.
It initializes a Google client, exchanges authorization codes for 
access tokens, retrieves user information, validates users, and
manages user registration and session updates.
*/

include 'gOAuth/vendor/autoload.php';
require_once 'functions.php';

global $connect_kuberkosh_db;

$ClientId = '515588955769-sfksdgdcc565sjofiu9gc80k0f506tff.apps.googleusercontent.com';
$ClientSecret = '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';

// Creating client request to Google
$google_client = new Google_Client();
$google_client->setClientId($ClientId);
$google_client->setClientSecret($ClientSecret);
$google_client->setRedirectUri('http://localhost/index.php?mfa');
$google_client->addScope('email');
$google_client->addScope('profile');

// Handle the authorization code received from Google
if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token["error"])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        $current_datetime = date('Y-m-d H:i:s');

        // Prepare user data for validation
        $user_data = [
            "oauth_uid" => $data['id'],
            "first_name" => $data['given_name'],
            "last_name" => $data['family_name'],
            "email_address" => $data['email'],
        ];

        // Validate user data
        $validation_result = validateUser($user_data);

        // If validation is successful
        if ($validation_result["status"]) {
            // Store validated user data in session
            $_SESSION['validation_result_status'] = $validation_result["status"];
            $_SESSION['validation_result_msg'] = $validation_result["msg"];
            $_SESSION['oauth_uid'] = $data['id'];
            $_SESSION['first_name'] = $data['given_name'];
            $_SESSION['last_name'] = $data['family_name'];
            $_SESSION['email_address'] = $data['email'];
            $_SESSION['profile_picture'] = $data['picture'];
            $_SESSION['gender'] = $data['gender'];
            $_SESSION['locale'] = $data['locale'];

            $email = $user_data["email_address"] ?? "";
            
            // Check if email exists in the database
            if (doesEmailExist($email)) {
                $_SESSION["msg"] = "Email Id Is Already Registered !";
                $_SESSION["field"] = "email";
                $_SESSION['user_id'] = getUserId($_SESSION['oauth_uid']);
            } else {
                // Email does not exist, add user to the database
                $_SESSION["msg"] = "Email is not Registered !";
                $_SESSION["field"] = "email";

                // Prepare new user data
                $newUser = [
                    'oauth_provider' => 'google',
                    'oauth_uid' => $data['id'],
                    'first_name' => $data['given_name'],
                    'last_name' => $data['family_name'],
                    'email' => $data['email'],
                    'gender' => $data['gender'],
                    'locale' => $data['locale'],
                    'picture' => $data['picture'],
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ];

                // Add new user to the database
                addUser($connect_kuberkosh_db, $newUser);
            }
        } else {
            // Validation failed, store error in session variables
            $_SESSION['validation_result_status'] = $validation_result["status"];
            $_SESSION['validation_result_msg'] = $validation_result["msg"];
            $_SESSION['oauth_uid'] = 'error';
            $_SESSION['first_name'] = 'error';
            $_SESSION['last_name'] = 'error';
            $_SESSION['email_address'] = 'error';
            $_SESSION['profile_picture'] = 'error';
            $_SESSION['gender'] = 'error';
            $_SESSION['locale'] = 'error';
        }
    }
}
?>
