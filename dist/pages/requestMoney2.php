<?php
include_once 'php/functions.php';
require_once "php/database.php";

global $connect_kuberkosh_db;

$userId = $_SESSION['user_id']; // Works only if a user session exists
$walletAddress = fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address'];
?>

<div id="assumedBody">
        <div id="requestDiv" class="card align-to-center position-relative">
            <form action="" class="card-form align-to-center">

                <!-- INR Amount -->
                <div class="input-group mb-1" id="money_send_amount_div">
                    <span class="input-group-text" id="money_send_currency_span"> 
                        <img id="inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
                        INR
                    </span>
                    <input id="money_send_amount_input" class="form-control text-light font-weight-600" inputmode="numeric" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <!-- Purpose Dropdown -->
                <div class="dropdown" id="dropdown_purpose_div">
                    <input list="purposeList" id="dropdown_purpose_button_a" type="text" class="form-field__input" placeholder="Write remarks here">
                    <datalist id="purposeList">
                        <option value="Travel">
                        <option value="Food">
                        <option value="Party">
                        <option value="Girlfriend">
                        <option value="Clothes">
                    </datalist>
                    <label for="purposeList" class="form-field__label">Purpose</label>
                </div>

                <!-- QR Code -->
                <div id="qr_code_div" class="mb-1">
                    <img id="qr_code_img" src="/img/qr.svg" alt="QR Code" width="120px" height="120px">
                </div>

                <!-- Receiving Address -->
                <div class="form-field__control mb-1" id="money_sending_address_div">
                    <input id="receiver_address" type="text" class="form-field__input" placeholder="walletaddress@kkosh" value="<?php echo htmlspecialchars($walletAddress); ?>">
                    <label for="receiver_address" class="form-field__label">Your address (Kuber Kosh Address)</label>
                    <span class="input-group-text" id="money_send_address_verify_span"> 
                        <button class="btn" id="verifyWalletAddressButton" width="35px" hight="35px"> 
                            <img id="wallet_verify" src="/img/verifyWalletAddress1.svg" alt="" width="50px" height="50px">
                        </button>
                    </span>
                </div>

                <!-- Remarks -->
                <div class="form-field__control mb-1" id="money_sending_remarks_div">
                    <input id="money_sending_remarks" type="text" class="form-field__input" placeholder="Write remarks here">
                    <label for="money_sending_remarks" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
                </div>

                <!-- Generate and Copy Link Button -->
                <div id="link_share_btn_div">
                    <button type="button" class="btn btn-primary bg-gradient text-light font-weight-300" id="share_link_btn" onclick="generateAndCopyUrl()">Share Link</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function generateAndCopyUrl() {
    const receiverAddress = document.getElementById('receiver_address').value;
    const amount = document.getElementById('money_send_amount_input').value;
    const purpose = document.getElementById('dropdown_purpose_button_a').value;
    const remarks = document.getElementById('money_sending_remarks').value;

    // Check if amount is a valid number
    if (isNaN(amount) || amount <= 0) {
        alert('Please enter a valid amount.');
        return; // Stop execution if amount is invalid
    }
    
    const url = `http://localhost/index.php?send&receiver_address=${encodeURIComponent(receiverAddress)}&amount=${encodeURIComponent(amount)}&purpose=${encodeURIComponent(purpose)}&remarks=${encodeURIComponent(remarks)}`;

    // Copy the URL to the clipboard
    const tempInput = document.createElement('input');
    tempInput.value = url;
    document.body.appendChild(tempInput);
    tempInput.select();
    tempInput.setSelectionRange(0, 99999); // For mobile devices
    document.execCommand('copy');
    document.body.removeChild(tempInput);

    // Alert the user that the URL has been copied
    alert('Link copied to clipboard');
}

    </script>