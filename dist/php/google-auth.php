<?php

include 'gOAuth/vendor/autoload.php';
require_once 'functions.php';


global $connect_kuberkosh_db;

$ClientId='515588955769-sfksdgdcc565sjofiu9gc80k0f506tff.apps.googleusercontent.com';
$ClientSecret='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';


// Creating client request to google
$google_client = new Google_Client();
$google_client->setClientId($ClientId);
$google_client->setClientSecret($ClientSecret);
$google_client->setRedirectUri('http://localhost/index.php?mfa');
$google_client->addScope('email');
$google_client->addScope('profile');





if(isset($_GET["code"]))
  {
   $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);        // This line uses the fetchAccessTokenWithAuthCode method of the $google_client object to exchange the authorization code ($_GET["code"]) for an access token. The access token is a credential that allows the application to access the user's data.
   if(!isset($token["error"]))
   {
    $google_client->setAccessToken($token['access_token']);                     // Sets the obtained access token in the Google API client for subsequent requests.
    $_SESSION['access_token']=$token['access_token'];                           // Stores the access token in the PHP session for later use.
    $google_service = new Google_Service_Oauth2($google_client);                // Instantiates a Google Service object for the OAuth2 API using the Google API client. This service is specifically for user information.
    $data = $google_service->userinfo->get();                                   // Calls the get method of the userinfo resource in the OAuth2 service to retrieve information about the authenticated user. The user information is stored in the $data variable.
    $current_datetime = date('Y-m-d H:i:s');                                    // Retrives the corent date and time.

   // print_r($data);


    // Call validateUser function from functions.php
    $user_data = [
      "oauth_uid" => $data['id'],
      "first_name" => $data['given_name'],
      "last_name" => $data['family_name'],
      "email_address" => $data['email'],
    ];

    

    $validation_result = validateUser($user_data);

    // If validation_result status===true
    if ($validation_result["status"]) 
    {
        // The data is valid, proceed with your application logic
        $_SESSION['validation_result_status'] = $validation_result["status"];
        $_SESSION['validation_result_msg'] = $validation_result["msg"];
        $_SESSION['oauth_uid'] = $data['id'];
        $_SESSION['first_name'] = $data['given_name'];
        $_SESSION['last_name'] = $data['family_name'];
        $_SESSION['email_address'] = $data['email'];
        $_SESSION['profile_picture'] = $data['picture'];
        $_SESSION['gender'] = $data['gender'];
        $_SESSION['locale'] = $data['locale'];
        //$_SESSION['phone']=$data['phone'];
        //$_SESSION['']=$data[''];


        $email = $user_data["email_address"] ?? "";
        // Check whether email id exists in database.
        // If email exists proceed with login process or 2FA
        if (doesEmailExist($email)) 
        {
          // echo 'email does exist';
          $_SESSION["msg"] = "Email Id Is Already Registered !";
          $_SESSION["field"] = "email";
          $_SESSION['user_id'] = getUserId($_SESSION['oauth_uid']);
        }

        // Check whether email id does not exists in database.
        // If email id does not exist add user to database
        elseif (!doesEmailExist($email)) 
        {
          // echo 'email does not exist';
          $_SESSION["msg"] = "Email is not Registered !";
          $_SESSION["field"] = "email";
          

          // Add user to database
          $newUser = array(
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
          );

          // Call the addUser function
          addUser($connect_kuberkosh_db, $newUser);
        }
    } 
    // If validation_result status===false
    else 
    {
        // The data is invalid, handle the error
        // echo $validation_result["msg"];
        // echo "Invalid field: " . $validation_result["field"];
        // You may want to redirect or display an error message to the user

        // The data is not valid, set session variables to 'error'
        $_SESSION['validation_result_status'] = $validation_result["status"];
        $_SESSION['validation_result_msg'] = $validation_result["msg"];
        $_SESSION['oauth_uid'] = 'error';
        $_SESSION['first_name'] = 'error';
        $_SESSION['last_name'] = 'error';
        $_SESSION['email_address'] = 'error';
        $_SESSION['profile_picture'] = 'error';
        $_SESSION['gender'] = 'error';
        $_SESSION['locale'] = 'error';
        //$_SESSION['phone'] = 'error';
        //$_SESSION[''] = 'error';
   }

  }
}
?>