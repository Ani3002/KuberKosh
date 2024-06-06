<?php
// Start Server Session
session_start();

// Display All Errors (For Easier Development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include Composer's autoload file
require 'vendor/autoload.php';

use PragmaRX\Google2FA\Google2FA;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

// Initiate antonioribeiro/google2fa object
$_g2fa = new Google2FA();

// Generate a secret key and a test user
$user = new stdClass();
$user->google2fa_secret = $_g2fa->generateSecretKey();
$user->email = 'save@interactiveutopia.com';

// Store user data and key in the server session
$_SESSION['g2fa_user'] = $user;

// Provide name of application (To display to user on app)
$app_name = 'Interactive Utopia';

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
?>

<!-- HTML Code -->
<div class="container">
<h1>Google Authenticator as 2FA with PHP Example</h1>
<h2>QR Code</h2>
<p><img src="data:image/png;base64,<?= $encoded_qr_data; ?>" alt="QR Code"></p>
<p>One-time password at time of generation: <?= $current_otp; ?></p>
<h2>Verify Code</h2>
One-time password: <input type="number" name="otp" id="otp" required />
<input type="button" value="Verify" onclick="verify_otp();" />
</div>

<!-- JavaScript Code -->
<script>
    let input_otp = document.getElementById('otp');

    const verify_otp = async () => {
        let otp = document.getElementById('otp').value;
        fetch('verify.php?otp=' + otp)
            .then((response) => response.json())
            .then((data) => {
                console.log(data)
                if (data.result == true) {
                    alert("Valid One Time Password");
                } else{
                    alert("Invalid One Time Password");
                }
            });
    }
</script>

<!-- CSS Code -->
<style>
    .container {
        text-align: center;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
