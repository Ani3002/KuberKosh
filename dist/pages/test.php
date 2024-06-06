<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview Balance Bar Chart</title>

</head>

<body>

    <div id="manage2FA" class="tabcontent">
        <h3>Manage 2FA</h3>
        <p id="totpStatus">Status: TOTP is disabled</p>
        <button id="enableTOTPBtn" onclick="enableTOTP()">Enable TOTP</button>
        <div id="totpSetupForm" style="display: none;">
            <label for="totpSecretKey">Secret Key:</label>
            <input type="text" id="totpSecretKey" readonly>
            <div id="qrCodeContainer"></div>
            <button onclick="generateTOTP()">Generate QR Code</button>
            <button id="nextBtn" style="display: none;" onclick="showVerification()">Next</button>
        </div>
        <div id="totpVerificationForm" style="display: none;">
            <label for="totpCode">Enter TOTP Code:</label>
            <input type="text" id="totpCode">
            <button onclick="verifyTOTP()">Verify</button>
        </div>
    </div>

<script>
    function enableTOTP() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/ajaxphp.php');
    xhr.setRequestHeader('Content-Type', 'application/json');
    var dataToSend = JSON.stringify({ action: 'enableOTP' });
    xhr.send(dataToSend);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            document.getElementById('totpSecretKey').value = response.secret;
            document.getElementById('qrCodeContainer').innerHTML = response.qrCode;
            document.getElementById('totpSetupForm').style.display = 'block';
            document.getElementById('nextBtn').style.display = 'inline';
        } else {
            alert('Failed to enable TOTP');
        }
    };
}

function generateTOTP() {
    enableTOTP(); // This can be a direct call or part of your flow
}

function showVerification() {
    document.getElementById('totpSetupForm').style.display = 'none';
    document.getElementById('totpVerificationForm').style.display = 'block';
}

function verifyTOTP() {
    var code = document.getElementById('totpCode').value;
    var secret = document.getElementById('totpSecretKey').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajaxphp.php');
    xhr.setRequestHeader('Content-Type', 'application/json');
    var dataToSend = JSON.stringify({ action: 'verifyOTP', code: code, secret: secret });
    xhr.send(dataToSend);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.verified) {
                document.getElementById('totpStatus').innerText = 'Status: TOTP is enabled';
                document.getElementById('totpVerificationForm').style.display = 'none';
            } else {
                alert('Invalid TOTP code. Please try again.');
            }
        } else {
            alert('Failed to verify TOTP');
        }
    };
}

</script>
</body>

</html>