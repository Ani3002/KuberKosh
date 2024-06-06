<?php
// Start Server Session
session_start();

// Include Composer's autoload file
require '../vendor/autoload.php';

use PragmaRX\Google2FA\Google2FA;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

// Initiate antonioribeiro/google2fa object
$_g2fa = new Google2FA();

// Generate a secret key and a test user
$user = new stdClass();
$user->google2fa_secret = $_g2fa->generateSecretKey();
$user->email = $_SESSION['email_address'];

// Store user data and key in the server session
$_SESSION['g2fa_user'] = $user;

// Check if the session contains user data
if (!isset($_SESSION['g2fa_user'])) {
    exit('User data not found');
}

// Provide name of application (To display to user on app)
$app_name = 'KuberKosh';

// Generate a custom URL from user data to provide to qr code generator
$qrCodeUrl = $_g2fa->getQRCodeUrl(
    $app_name,
    $user->email,
    $user->google2fa_secret
);

// QR Code Generation using endroid/qr-code
$qrCode = new QrCode($qrCodeUrl);
$writer = new PngWriter();
$qrCodeData = $writer->write($qrCode)->getString();

// Encode QR code data to base64
$encoded_qr_data = base64_encode($qrCodeData);

// This will provide us with the current password
$current_otp = $_g2fa->getCurrentOtp($user->google2fa_secret);

// Prepare data to be sent back to the client
$response = [
    'qr_code' => $encoded_qr_data,
    'secret_key' => $user->google2fa_secret,
    'current_otp' => $current_otp
];

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
