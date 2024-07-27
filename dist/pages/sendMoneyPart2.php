<?php
/* This script handles the sending of money between users.
It includes client-side validation and AJAX requests to verify details.
*/

// Start session and include necessary files
include_once 'php/database.php';
include "php/google-auth.php";

// Establish database connection
global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

$userId = $_SESSION['user_id']; // Works only if a user session exists
?>

<!-- Body already started in sendMoneyPart1.php -->
<!-- Background Image Added -->
<!-- Collapsable Side Bar will be inserted here through index.php -->

<!-- Modal -->
<div class="modal fade" id="failedModal" tabindex="1" aria-labelledby="failedModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger fw-semibold" id="failedModalLabel">Failed</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="failedModalMessage" class="modal-body text-light fw-normal">
        Failed.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
<div id="assumedBody">
  <div id="sendDiv" class="card card1 align-to-center position-relative">
    <img id="receiverProfilePic" src="https://bit.ly/3Us0eCl" class="rounded-circle receiver-profile-pic "
      alt="receivers profile pic" width="100px" height="100px">

    <h5 class="" id="verified_name"> </h5>
    
    <!-- Form for user to enter transaction details to
    send money trensaction details like receivers wallet
    address, transcation amount, purpose, remarks etc -->
    <form id="send_money_form_1" action="" class="card-form
     align-to-center" style="margin-top: 8px;">
      <!-- Receivers Address -->
      <div class="form-field__control mt-1" 
      id="money_sending_address_div">
        <input id="receiver_address" type="text" 
        class="form-field__input" placeholder="walletaddress@kkosh">
        <label for="receiver_address" class="form-field__label">
          Receiver's address (Kuber Kosh Address)</label>
        <span class="input-group-text" 
        id="money_send_address_verify_span">
          <button class="btn" id="verifyWalletAddressButton"
           width="35px"
           hight="35px">
            <img id="wallet_verify" 
            src="/img/verifyWalletAddress1.svg" alt="" 
            width="50px" height="50px">
          </button>
        </span>
      </div>
      <!-- INR Ammount -->
      <div class="input-group mb-1"
       id="money_send_amount_div">
        <span class="input-group-text"
         id="money_send_currency_span">
          <img id="inr_logo" src="/img/inr.webp" alt=""
           width="35px" height="35px">
          INR
        </span>
        <input id="money_send_amount_input"
         class="form-control text-light font-weight-600"
          inputmode="numeric" aria-label="Sizing example input"
           aria-describedby="inputGroup-sizing-sm">
      </div>
      <!-- Purpose -->
      <div class="dropdown" id="dropdown_purpose_div">
        <input list="purposeList" id="dropdown_purpose_button_a"
         type="text" class="form-field__input"
          placeholder="Write remarks here">
        <datalist id="purposeList">
          <option value="Travel">
          <option value="Food">
          <option value="Party">
          <option value="Girlfriend">
          <option value="Clothes">
        </datalist>
        <label for="purposeList" class="form-field__label">
          Purpose</label>
      </div>
      <!-- Remarks -->
      <div class="form-field__control" id="money_sending_remarks_div">
        <input id="money_sending_remarks" type="text"
         class="form-field__input" placeholder="Write remarks here">
        <label for="money_sending_remarks" class="form-field__label">
          Remarks</label>
      </div>
      <!-- Send Button -->
      <div id="money_send_btn_div">
        <button href="#" class="btn btn-primary bg-gradient
         text-light font-weight-300" id="money_send_btn">
         SEND</button>
      </div>
    </form>
  </div>
  <script>
    // Function to get URL parameters
    function getUrlParameter(name) {
      name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
      var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
      var results = regex.exec(location.search);
      return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }
    // Function to populate form fields
    function populateForm() {
      document.getElementById('receiver_address').value = getUrlParameter('receiver_address');
      document.getElementById('money_send_amount_input').value = getUrlParameter('amount');
      document.getElementById('money_sending_remarks').value = getUrlParameter('remarks');
      document.getElementById('dropdown_purpose_button_a').value = getUrlParameter('purpose');

    }
    window.onload = populateForm;
  </script>


  <div id="sendVerifyDiv" class="card card1 align-to-center
   position-absolute" style="margin-left: 30%; margin-top: 7%;
    display: none;">
    <img id="receiverProfilePic" src="https://bit.ly/3Us0eCl"
     class="rounded-circle receiver-profile-pic " 
     alt="receivers profile pic" width="100px" height="100px">
    <?php
    echo '<h5 class="" id="verified_name">' . $_SESSION["
    first_name"] . ' ' . $_SESSION['last_name'] . '</h5>';
    echo '<h5 class="" id="verified_wallet-address"> 
    walletaddress@kkosh </h5>'
      ?>
    <form action="" class="card-form align-to-center"
     style="margin-top: 8px;">
      <!-- INR Ammount -->
      <div class="input-group mb-3" id="money_send_amount_div">
        <span class="input-group-text" id="money_send_currency_span"
         style="height: 40px;">
          <img id="inr_logo" src="/img/inr.webp" alt=""
           width="35px" height="35px">
          INR
        </span>
        <input inputmode="numeric" class="form-control text-light
         font-weight-600" id="money_send_amount_input" aria-label="
         Sizing example input" value="500" aria-describedby="inputGroup-sizing-sm" style="height: 40px;" disabled>
      </div>

      <div class="row">
        <!-- Purpose dropdown -->
        <div class="col-xs-6 form-field__control goodluckdubugingit65446453" id="money_sending_remarks_div">
          <input style="width: 200px;" id="money_sending_purpose" type="text" class="form-field__input2" value="Travel"
            style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;" disabled>
          <label style="width: 200px;" for="money_sending_purpose" class="form-field__label2"
            style="padding-top: 15px; padding-bottom: 0px;">Purpose</label>
        </div>

        <!-- Remarks -->
        <div class="col-xs-6 form-field__control goodluckdubugingit65546542" id="money_sending_remarks_div">
          <input style="width: 200px;" id="money_sending_remarks" type="text" class="form-field__input2"
            value="train ticket NMX to KGP" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;" disabled>
          <label style="width: 200px;" for="money_sending_remarks" class="form-field__label2"
            style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
        </div>
      </div>

      <!-- PIN input fields -->
      <div class="column">
        <div class="container d-flex flex-grow-1 justify-content-center align-items-center" id="pin-input-container">
          <div id="inputs" class="inputs">
            <input id="pin-input1" class="input" type="password" onkeyup="changeColor()" inputmode="numeric"
              maxlength="1" pattern="\d*" />
            <input id="pin-input2" class="input" type="password" onkeyup="changeColor()" inputmode="numeric"
              maxlength="1" pattern="\d*" />
            <input id="pin-input3" class="input" type="password" onkeyup="changeColor()" inputmode="numeric"
              maxlength="1" pattern="\d*" />
            <input id="pin-input4" class="input" type="password" onkeyup="changeColor()" inputmode="numeric"
              maxlength="1" pattern="\d*" />
            <input id="pin-input5" class="input" type="password" onkeyup="changeColor()" inputmode="numeric"
              maxlength="1" pattern="\d*" />
            <input id="pin-input6" class="input" type="password" onkeyup="changeColor()" inputmode="numeric"
              maxlength="1" pattern="\d*" />
          </div>
        </div>
        <div class="enter-pin-text d-flex flex-grow-1 justify-content-center align-items-center">Please Enter KuberKosh
          PIN here</div>
        <br>
        <div class="forgot-pin d-flex flex-grow-1 justify-content-center align-items-center"> <a href="#"
            class="forgot-pin"> Forgot KuberKosh PIN? </a></div>
      </div>




      <script>
        const inputs = document.getElementById("inputs");
        inputs.addEventListener("input", function (e) {
          const target = e.target;
          const val = target.value;

          if (isNaN(val)) {
            target.value = "";
            return;
          }

          if (val != "") {
            const next = target.nextElementSibling;
            if (next) {
              next.focus();
            }
          }
        });
        inputs.addEventListener("keyup", function (e) {
          const target = e.target;
          const key = e.key.toLowerCase();

          if (key == "backspace" || key == "delete") {
            target.value = "";
            const prev = target.previousElementSibling;
            if (prev) {
              prev.focus();
            }
            return;
          }
        });
      </script>

      <!-- Send Button -->
      <div id="money_send_btn_div">
        <button style="margin: 60px 174px 0 174px;width: 154px;" href="#"
          class="btn btn-primary bg-gradient  idkwhattonameit34645 text-light font-weight-300"
          id="money_send_btn">CONFIRM</button>

      </div>


    </form>
  </div>




  <div id="sendConfirmDiv" class="card card1 align-to-center
   position-absolute"
    style="margin-left: 30%; margin-top: 7%; display: none;">
    <img id="receiverProfilePic" src="https://bit.ly/3Us0eCl"
     class="rounded-circle receiver-profile-pic "
      alt="receivers profile pic" width="100px" height="100px">
    <h5 class="" id="verified_name"></h5>
    <h5 class="" id="verified_wallet-address"></h5>
    <h5 id="trnx_confirm_amnt"> </h5>
    <h5 id="trnx_Id" style="color: var(--background-mode, #FFF);
        font-family: Inter; font-size: 0.9375rem; font-style: normal;
        font-weight: 500; line-height: normal;"> </h5>
    <div id="testdiv" style="width: 300px; height: 300px;
     position: absolute; margin-top: 10px;">
    </div>
    <h3 id="trnxMessage" style="width: 500px; height: 30px;
     position: absolute; margin-left: 190px; margin-top: 280px;">
      Transaction Successful</h3>
    <div id="dwnld_receipt_btn_div">
      <button type="button" id="downloadBtn" href="#"
        class="btn btn-primary bg-gradient 
         text-light font-weight-300"
        style="margin: 60px 174px 0 -90px; width: 184px;">Download Receipt</button>
    </div>
    <a id="shareBtn" href=""><img src="/img/shareIcon.svg"
     alt="Share Icon" id="share_icon"></a>
  </div>
</div>




<script>
  function replaceDivWithVerificationDiv() {
    var parentNode = document.getElementById('assumedBody');
    var originalDiv = document.getElementById('sendDiv');
    var newDiv = document.getElementById('sendVerifyDiv');
    parentNode.replaceChild(newDiv, originalDiv);
    newDiv.style.display = 'flex';
  }
  function replaceDivWithConfirmationDiv() {
    var parentNode = document.getElementById('assumedBody');
    var originalDiv = document.getElementById('sendVerifyDiv');
    var newDiv = document.getElementById('sendConfirmDiv');
    parentNode.replaceChild(newDiv, originalDiv);
    newDiv.style.display = 'flex';
  }
  var verified_name = document.getElementById('verified_name');
  var verifyWalletAddressButton = document.getElementById('verifyWalletAddressButton');
  var walletAddres;
  var receiver_address = document.getElementById('receiver_address');
  var receiverProfilePic = document.getElementById('receiverProfilePic');
  var money_send_btn = document.getElementById('money_send_btn');
  var money_send_amount_input = document.getElementById('money_send_amount_input');
  var money_sending_remarks = document.getElementById('money_sending_remarks');
  var inputPurpose = document.getElementById('dropdown_purpose_button_a');
  var selected_purpose = document.getElementById('selected_purpose');
  var wallet_verify = document.getElementById('wallet_verify');
  var money_send_amount;
  var amountToSend;
  function showModal(label, message) {
    var modalElement = document.getElementById('failedModal');
    var failedModalLabel = document.getElementById('failedModalLabel');
    failedModalLabel.textContent = label;
    var failedModalMessage = document.getElementById('failedModalMessage');
    failedModalMessage.textContent = message;
    var myModal = new bootstrap.Modal(modalElement);
    myModal.show();
  }
  verifyWalletAddressButton.addEventListener('click', function () {
    event.preventDefault(); // Prevent form submission
    walletAddress = receiver_address.value.trim();
    // Client-side validation
    if (!walletAddress) {
      showModal("Failed", "Please enter Receiver Wallet Address");

      return;
    }
    // Server-side validation of receivers wallet address via AJAX
    var xhrValidateReceiverWalletAddres = new XMLHttpRequest();
    xhrValidateReceiverWalletAddres.open('POST', 'php/ajaxFindNameFromWalletAddress.php');
    xhrValidateReceiverWalletAddres.setRequestHeader('Content-Type', 'application/json');
    var dataToSend = JSON.stringify({ walletAddress: walletAddress });
    xhrValidateReceiverWalletAddres.send(dataToSend);
    xhrValidateReceiverWalletAddres.onload = function () {
      if (xhrValidateReceiverWalletAddres.status === 200) {
        var response = JSON.parse(xhrValidateReceiverWalletAddres.responseText);
        if (!response.hasOwnProperty('error')) {
          wallet_verify.src = "/img/verifyWalletAddress2.svg";
          receiverProfilePic.src = response.profilePicLink;
          verified_name.textContent = response.name;
          verified_name.style.color = '#4ECB71'; // Change the color to green

        }
        else if (response.hasOwnProperty('error')) {
          receiverProfilePic.src = 'https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png';
          verified_name.textContent = 'Error: Wallet address invalid';
          verified_name.style.color = 'red'; // Change the color to red
          showModal("Error:", "Wallet address invalid");

        }
        else {
          receiverProfilePic.src = 'https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png';
          verified_name.textContent = 'Unknown Error';
          verified_name.style.color = 'red'; // Change the color to red
          showModal("Error:", "Unknown Error");

        }
      }
      else {
        showModal("Error:", "Error occurred while checking wallet address. Please try again.");

      }
    };
  });

  money_send_btn.addEventListener('click', function () {
    event.preventDefault();

    // verify the input fields in frontend
    // make ajax call to check input fields
    // check whether balance available with ajax
    // check whether wallet address valid with ajax
    // make changes in the wallet transactions db fro sender and receiver depending on the ammount after pin verification

    // Client-side validation of receivers wallet address
    // Fetch receiver_address from input
    walletAddress = receiver_address.value.trim();
    // Client-side validation receivers wallet address
    if (!walletAddress) {
      showModal("Failed:", "Please enter Receiver Wallet Address");
      return;
    }
    // Fetch verified name
    var receiverName = verified_name.textContent.trim();

    // Client-side validation of receivers wallet address verification
    if (!receiverName) {
      showModal("Failed:", "Please Valid Wallet Address");

      return;
    }
    // Fetch money_send_amount from input
    money_send_amount = money_send_amount_input.value.trim();
    // Client-side validation of money_send_amount
    if (!money_send_amount) {
      showModal("Failed:", "Please enter amount to send");
      return;
    }
    else if (!/^\d+$/.test(money_send_amount)) {
      showModal("Failed:", "Please enter a valid integer amount");
      return;
    }

    // Server-side validation of receivers wallet address via AJAX
    var xhrValidateReceiverWalletAddres = new XMLHttpRequest();
    xhrValidateReceiverWalletAddres.open('POST',
     'php/ajaxFindNameFromWalletAddress.php');
    xhrValidateReceiverWalletAddres.setRequestHeader('Content-Type',
    'application/json');
    var dataToSend = JSON.stringify({ walletAddress: walletAddress });
    xhrValidateReceiverWalletAddres.send(dataToSend);
    xhrValidateReceiverWalletAddres.onload = function () {
      if (xhrValidateReceiverWalletAddres.status === 200) {
        var response =
         JSON.parse(xhrValidateReceiverWalletAddres.responseText);
        if (!response.hasOwnProperty('error')) {
          receiverWalletAddress = response.walletAddress;
          receiverProfilePic1 = response.profilePicLink;
          receiverProfilePic.src = response.profilePicLink;
          verified_name1 = response.name;
          verified_name.textContent = response.name;
          verified_name.style.color = '#4ECB71'; // Change the color to green
          amountToSend = money_send_amount;

          // Server-side validation of sending amount via AJAX
          var xhrValidateTransferAmount = new XMLHttpRequest();
          xhrValidateTransferAmount.open('POST', 
          'php/ajaxVerifyTransferAmount.php');
          xhrValidateTransferAmount.setRequestHeader('Content-Type',
           'application/json');
          var dataToSend = JSON.stringify({ amountToSend: amountToSend,
             type: 'W2W' });
          xhrValidateTransferAmount.send(dataToSend);
          xhrValidateTransferAmount.onload = function () {
            if (xhrValidateTransferAmount.status === 200) {
              var response = JSON.parse(xhrValidateTransferAmount.responseText);
              // If the user has the amount in his wallet valid response is sent
              if (!response.hasOwnProperty('error') && response.valid) {

                senderRemarks = money_sending_remarks.value.trim();
                var trnxPurpose = inputPurpose.value;

                // dynamicly replace the curent div fot entering transaction
                //  details with the div to verify entered details and 
                //  submit Wallet PIN
                replaceDivWithVerificationDiv();

                document.getElementById('pin-input1').focus();

                receiverProfilePic = document.getElementById('
                receiverProfilePic');
                receiverProfilePic.src = receiverProfilePic1;

                verified_name = document.getElementById('verified_name');
                verified_name.textContent = verified_name1;
                verified_name.style.color = '#4ECB71'; // Change the color to green

                verifiedWalletAddress = document.getElementById('
                verified_wallet-address');
                verifiedWalletAddress.textContent = receiverWalletAddress;

                money_send_amount_input = document.getElementById('
                money_send_amount_input');
                money_send_amount_input.value = response.amountToSend;

                money_sending_remarks = document.getElementById('
                money_sending_remarks');
                money_sending_remarks.value = senderRemarks;

                money_sending_purpose = document.getElementById('
                money_sending_purpose');
                money_sending_purpose.value = trnxPurpose;

                money_send_btn = document.getElementById('money_send_btn');
                // Extract the user entered PIN and put it in variable
                money_send_btn.addEventListener('click', function () {
                  event.preventDefault();
                  pininput1 = document.getElementById('pin-input1');
                  pinInput1 = pininput1.value.trim();
                  pininput2 = document.getElementById('pin-input2');
                  pinInput2 = pininput2.value.trim();
                  pininput3 = document.getElementById('pin-input3');
                  pinInput3 = pininput3.value.trim();
                  pininput4 = document.getElementById('pin-input4');
                  pinInput4 = pininput4.value.trim();
                  pininput5 = document.getElementById('pin-input5');
                  pinInput5 = pininput5.value.trim();
                  pininput6 = document.getElementById('pin-input6');
                  pinInput6 = pininput6.value.trim();
                  var concatenatedString = pinInput1.toString() +
                   pinInput2.toString() + pinInput3.toString() +
                    pinInput4.toString() + pinInput5.toString() +
                     pinInput6.toString();
                  // Hash the string before sending it to server for verification
                  var hashedString = sha256(concatenatedString);
                  function sha256(ascii) {
                    function rightRotate(value, amount) {
                      return (value >>> amount) | (value << (32 - amount));
                    };
                    var mathPow = Math.pow;
                    var maxWord = mathPow(2, 32);
                    var lengthProperty = 'length'
                    var i, j; // Used as a counter across the whole file
                    var result = ''
                    var words = [];
                    var asciiBitLength = ascii[lengthProperty] * 8;
                    var hash = sha256.h = sha256.h || [];
                    // Round constants: first 32 bits of the fractional parts of the cube roots of the first 64 primes
                    var k = sha256.k = sha256.k || [];
                    var primeCounter = k[lengthProperty];
                    var isComposite = {};
                    for (var candidate = 2; primeCounter < 64; candidate++) {
                      if (!isComposite[candidate]) {
                        for (i = 0; i < 313; i += candidate) {
                          isComposite[i] = candidate;
                        }
                        hash[primeCounter] = (mathPow(candidate, .5) * maxWord) | 0;
                        k[primeCounter++] = (mathPow(candidate, 1 / 3) * maxWord) | 0;
                      }
                    }
                    ascii += '\x80' // Append Ƈ' bit (plus zero padding)
                    while (ascii[lengthProperty] % 64 - 56) ascii += '\x00' // More zero padding
                    for (i = 0; i < ascii[lengthProperty]; i++) {
                      j = ascii.charCodeAt(i);
                      if (j >> 8) return; // ASCII check: only accept characters in range 0-255
                      words[i >> 2] |= j << ((3 - i) % 4) * 8;
                    }
                    words[words[lengthProperty]] = ((asciiBitLength / maxWord) | 0);
                    words[words[lengthProperty]] = (asciiBitLength)
                    for (j = 0; j < words[lengthProperty];) {
                      var w = words.slice(j, j += 16); // The message is expanded into 64 words as part of the iteration
                      var oldHash = hash;
                      hash = hash.slice(0, 8);
                      for (i = 0; i < 64; i++) {
                        var i2 = i + j;
                        var w15 = w[i - 15], w2 = w[i - 2];
                        // Iterate
                        var a = hash[0], e = hash[4];
                        var temp1 = hash[7]
                          + (rightRotate(e, 6) ^ rightRotate(e, 11) ^ rightRotate(e, 25)) // S1
                          + ((e & hash[5]) ^ ((~e) & hash[6])) // ch
                          + k[i]
                          // Expand the message schedule if needed
                          + (w[i] = (i < 16) ? w[i] : (
                            w[i - 16]
                            + (rightRotate(w15, 7) ^ rightRotate(w15, 18) ^ (w15 >>> 3)) // s0
                            + w[i - 7]
                            + (rightRotate(w2, 17) ^ rightRotate(w2, 19) ^ (w2 >>> 10)) // s1
                          ) | 0
                          );
                        var temp2 = (rightRotate(a, 2) ^ rightRotate(a, 13) ^ rightRotate(a, 22)) // S0
                          + ((a & hash[1]) ^ (a & hash[2]) ^ (hash[1] & hash[2])); // maj

                        hash = [(temp1 + temp2) | 0].concat(hash); // We don't bother trimming off the extra ones, they're harmless as long as we're truncating when we do the slice()
                        hash[4] = (hash[4] + temp1) | 0;
                      }
                      for (i = 0; i < 8; i++) {
                        hash[i] = (hash[i] + oldHash[i]) | 0;
                      }
                    }
                    for (i = 0; i < 8; i++) {
                      for (j = 3; j + 1; j--) {
                        var b = (hash[i] >> (j * 8)) & 255;
                        result += ((b < 16) ? 0 : '') + b.toString(16);
                      }
                    }
                    return result;
                  };

                  // AJAX request to TransferMoneyW2W
                  var xhrTransferMoneyW2W = new XMLHttpRequest();
                  xhrTransferMoneyW2W.open('POST', 'php/ajaxTransferMoneyW2W.php');
                  xhrTransferMoneyW2W.setRequestHeader('Content-Type', 'application/json');
                  var dataToSend = JSON.stringify({ amountToSend: amountToSend,
                     walletAddress: walletAddress, hashedPINEnteredByUser: hashedString,
                      trnxPurpose: trnxPurpose, senderRemarks: senderRemarks });
                  xhrTransferMoneyW2W.send(dataToSend);

                  xhrTransferMoneyW2W.onload = function () {
                    if (xhrTransferMoneyW2W.status === 200) {
                      var response = JSON.parse(xhrTransferMoneyW2W.responseText);
                      // Display the confirmation message and transaction details if
                      // no error response is sentfrom the server
                      if (!response.hasOwnProperty('error') && response.success) {
                        replaceDivWithConfirmationDiv()

                        receiverProfilePic = document.getElementById('receiverProfilePic');
                        receiverProfilePic.src = response.receiverProfilePic;
                        verifiedWalletAddress = document.getElementById('
                        verified_wallet-address');
                        verifiedWalletAddress.textContent = response.receiverWalletAddress;
                        trnx_confirm_amnt = document.getElementById('trnx_confirm_amnt');
                        trnx_confirm_amnt.textContent = ('INR: ' + response.amountToSend);
                        trnx_Id = document.getElementById('trnx_Id');
                        trnx_Id.textContent = ('Transaction Id: ' +
                         response.trnxId.substring(0, 19));
                        trnxMessage = document.getElementById('trnxMessage');
                        trnxMessage.textContent = response.trnxMessage;
                        trnxMessage.style.color = '#4ECB71'; // Change the color to green
                        verified_name = document.getElementById('verified_name');
                        verified_name.textContent = response.receiverName;
                        verified_name.style.color = '#4ECB71'; // Change the color to green
                        dwnldRec = document.getElementById('dwnld_receipt_btn');
                        dwnldRec = document.getElementById('downloadBtn');
                        var downloadBtn = document.getElementById('downloadBtn');
                        downloadBtn.addEventListener('click', function () {
                          // Get transaction ID and amount from input fields
                          var transactionId = response.trnxId;
                          var amount = response.amountToSend;
                          // Make sure transaction ID and amount are not empty
                          if (transactionId.trim() === '' || amount.trim() === '') {
                            //alert('Please enter transaction ID and amount.');
                            return;
                          }
                          // Create a new XMLHttpRequest object
                          var xhr = new XMLHttpRequest();
                          // Configure the AJAX request
                          xhr.open('POST', 'php/ajaxReceiptGenerator.php', true);
                          xhr.responseType = 'blob'; // Set the response type to blob

                          // Define the success callback function
                          xhr.onload = function () {
                            if (xhr.status === 200) {
                              // Create a blob URL from the response data
                              var blob = new Blob([xhr.response],
                               { type: 'application/pdf' });
                              var url = window.URL.createObjectURL(blob);

                              // Create a temporary link element
                              var a = document.createElement('a');
                              a.href = url;
                              a.download = 'transaction_receipt.pdf';

                              // Append the link to the body and trigger the download
                              document.body.appendChild(a);
                              a.click();

                              // Cleanup
                              window.URL.revokeObjectURL(url);
                              document.body.removeChild(a);
                            } else {
                              console.error('Error downloading receipt:',
                               xhr.status);
                            }
                          };
                          // Define the error callback function
                          xhr.onerror = function () {
                            console.error('Error downloading receipt:',
                             xhr.statusText);
                          };
                          // Send the AJAX request with the transaction ID and amount as data
                          var formData = new FormData();
                          formData.append('transactionId', transactionId);
                          formData.append('amount', amount);
                          xhr.send(formData);
                        });

                        var shareBtn = document.getElementById('shareBtn');

                        // Share button event listener
                        shareBtn.addEventListener('click', function (event) {
                          event.preventDefault(); // Prevent the default action of the anchor tag

                          // Check if Web Share API is supported
                          if (navigator.share) {
                            navigator.share({
                              title: 'Transaction Receipt',
                              text: 'Here is your transaction receipt.',
                              files: [blob], // Pass the blob file to share
                            }).then(() => {
                              showModal("Success:", "Receipt shared successfully.");
                              console.log('Receipt shared successfully.');
                            }).catch((error) => {
                              showModal("Error:", error);
                              console.error('Error sharing receipt:', error);
                            });
                          } else {
                            // Web Share API not supported, provide alternative method
                            showModal("Error:", "Web Share API is not supported in this browser.");
                          }
                        });
                      }
                      else if (response.hasOwnProperty('error')) {
                        receiverProfilePic = document.getElementById('receiverProfilePic');
                        receiverProfilePic.src = 'https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png';
                        verified_name = document.getElementById('verified_name');
                        verified_name.textContent = response.receiverName;;
                        verified_name.style.color = 'red'; // Change the color to red

                        trnxMessage = document.getElementById('trnxMessage');
                        trnxMessage.textContent = response.trnxMessage;
                        trnxMessage.style.color = 'red'; // Change the color to green
                        showModal("Error:", response.error);
                      }
                      else {
                        showModal("Error:", "Unknown Error");
                      }
                    }
                    else {
                      showModal("Error:", "Error occurred while verifying details with server. Please try again.");
                    }
                  };
                });
              }
              else if (response.hasOwnProperty('error')) {
                showModal("Error:", response.error);
              }
              else {
                showModal("Error:", "Unknown Error");
              }
            }
            else {
              showModal("Error:", "Error occurred while verifying details with server. Please try again.");
            }
          }
        }
        else if (response.hasOwnProperty('error')) {
          receiverProfilePic.src = 'https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png';
          verified_name.textContent = 'Error: Wallet address invalid';
          verified_name.style.color = 'red'; // Change the color to red
          showModal("Error:", "Wallet address invalid");
        }
        else {
          receiverProfilePic.src = 'https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png';
          verified_name.textContent = 'Unknown Error';
          verified_name.style.color = 'red'; // Change the color to red
          showModal("Error:", "Unknown Error");
        }
      }
      else {
        showModal("Error:", "Error occurred while checking wallet address. Please try again.");
      }
    }
  });
</script>