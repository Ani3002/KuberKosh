<?php

include_once 'gOAuth/vendor/autoload.php';
//require_once 'functions.php';

$ClientId='515588955769-sfksdgdcc565sjofiu9gc80k0f506tff.apps.googleusercontent.com';
$ClientSecret='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';


// Creating client request to google
$google_client = new Google_Client();
$google_client->setClientId($ClientId);
$google_client->setClientSecret($ClientSecret);
$google_client->setRedirectUri('http://localhost/index.php?dash');
$google_client->addScope('email');
$google_client->addScope('profile');

if(isset($_GET["code"]))
  {
   $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
   if(!isset($token["error"]))
   {
    $google_client->setAccessToken($token['access_token']);
    $_SESSION['access_token']=$token['access_token'];
    $google_service = new Google_Service_Oauth2($google_client);
    $data = $google_service->userinfo->get();
    $current_datetime = date('Y-m-d H:i:s');

   // print_r($data);

$_SESSION['first_name']=$data['given_name'];
$_SESSION['last_name']=$data['family_name'];
$_SESSION['email_address']=$data['email'];
$_SESSION['profile_picture']=$data['picture'];
   }
  }
//   $login_button = '';
//  // echo $_SESSION['access_token'];
//   if(!$_SESSION['access_token'])
//   {
// 	//  echo 'test';
//    $login_button = '<a href="'.$google_client->createAuthUrl().'">Login with google</a>';
//   }
?>

