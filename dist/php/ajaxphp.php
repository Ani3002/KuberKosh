<?php
// require 'vendor/autoload.php';
include '../otphp/src/TOTP.php';
use OTPHP\TOTP;

$data = json_decode(file_get_contents('php://input'), true);

if ($data['action'] === 'enableOTP') {
    $totp = TOTP::create();
    $secret = $totp->getSecret();
    $uri = $totp->getProvisioningUri();

    // Generate the QR code
    ob_start();
    echo '<img src="https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=' . urlencode($uri) . '" alt="QR Code">';
    $qrCode = ob_get_clean();

    $response = [
        'secret' => $secret,
        'qrCode' => $qrCode,
    ];

    echo json_encode($response);
} elseif ($data['action'] === 'verifyOTP') {
    $totp = TOTP::create($data['secret']);
    $verified = $totp->verify($data['code']);

    $response = [
        'verified' => $verified,
    ];

    echo json_encode($response);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid action']);
}
?>
