<?php
include_once 'php/database.php'; // Include the database.php file
include "php/google-auth.php";

// Establish database connection
global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

$userId = $_SESSION['user_id']; // Works only if a user session exists
?>

<!-- Body already started in sendMoneyPart1.php -->
<!-- Background Image Added -->
<!-- Collapsable Side Bar will be inserted here through index.php -->

<div id = "assumedBody">
<div id = "sendDiv" class="card align-to-center position-absolute" style="margin-left: 30%; margin-top: 7%;">
  <img id = "receiverProfilePic" src="https://bit.ly/3Us0eCl" class="rounded-circle receiver-profile-pic " alt="receivers profile pic" width = "100px" height="100px">
  
  <h5 class="" id="verified_name"> </h5>
  <form action="" class = "card-form align-to-center" style="margin-top: 8px;">

    <!-- Receivers Address -->
    <div class="form-field__control" id="money_sending_address_div">
        <input id="receiver_address" type="text" class="form-field__input" placeholder="walletaddress@kkosh" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;" >
        <label for="receiver_address" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Receiver's  address (Kuber Kosh Address)</label>
        <span class="input-group-text" id="money_send_address_verify_span"> 
          <button  class = "btn" id= "verifyWalletAddressButton" width="35px" hight="35px"> 
            <img id = "inr_logo" src="/img/verifyWalletAddress1.svg" alt="" width="35px" height="35px">
          </button>
        </span>
    </div>

    <!-- INR Ammount -->
    <div class="input-group mb-3" id = "money_send_amount_div" >
      <span class="input-group-text" id="money_send_currency_span" style = "height: 40px;"> 
        <img id = "inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
        INR
      </span>
      <input id = "money_send_amount_input" class="form-control text-light font-weight-600" inputmode="numeric" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style = "height: 40px;">
    </div>

    <!-- Purpose dropdown -->
    <!-- <div class="dropdown" id = "dropdown_purpose_div">
      <a class="btn btn-secondary dropdown-toggle" id = "dropdown_purpose_button_a" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Select Purpose
      </a>
      <ul class="dropdown-menu" id = "dropdown_purpose_button_ul" style="">
        <li><a class="dropdown-item" href="#">Travel</a></li>
        <li><a class="dropdown-item" href="#">Food</a></li>
        <li><a class="dropdown-item" href="#">Girlfriend</a></li>
        <li><a class="dropdown-item" href="#">Party</a></li>
        <li><a class="dropdown-item" href="#">Clothes</a></li>
      </ul>
      <label for="purpose" class="form-field__label" >Purpose</label>

      <form action="/action_page.php" method="get">
      <input list="browsers" name="browser" id="browser">
      <datalist id="browsers">
        <option value="Edge">
        <option value="Firefox">
        <option value="Chrome">
        <option value="Opera">
        <option value="Safari">
      </datalist>
    </form>


    </div> -->


    <div class="dropdown" id="dropdown_purpose_div">
        <input list="purposeList" id="dropdown_purpose_button_a" type="text" class="form-field__input" placeholder="Write remarks here" style="height: 45px; padding-bottom: 4px; padding-top: 15px; margin-top: 15px;  border-radius: 10px">
        <datalist id="purposeList">
        <option value="Travel">
        <option value="Food">
        <option value="Party">
        <option value="Girlfriend">
        <option value="Clothes">
      </datalist>
        <label for="purposeList" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Purpose</label>
    </div>

    <!-- Remarks -->
    <div class="form-field__control" id="money_sending_remarks_div">
        <input id="money_sending_remarks" type="text" class="form-field__input" placeholder="Write remarks here" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;">
        <label for="money_sending_remarks" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
    </div>

    <!-- Send Button -->
    <div id="money_send_btn_div">
      <button href="#" class="btn btn-primary bg-gradient  text-light font-weight-300" id="money_send_btn">SEND</button>
    </div>

  </form>
</div>














<div id = "sendVerifyDiv" class="card align-to-center position-absolute" style="margin-left: 30%; margin-top: 7%; display: none;">
  <!-- <img src="https://bit.ly/3Us0eCl" class="rounded-circle receiver-profile-pic " alt="receivers profile pic" width = "100px" height="100px"> -->
  <?php
    echo '<img src="' . $_SESSION['profile_picture'] . '" class="rounded-circle receiver-profile-pic " alt="receivers profile pic" width = "100px" height="100px" />';
    echo '<h5 class="" id="verified_name">' . $_SESSION["first_name"] . ' ' . $_SESSION['last_name'] . '</h5>';
    echo '<h5 class="" id="verified_wallet-address"> walletaddress@kkosh </h5>'//. $reseiversAddress['receivers_address']. '</h5>';
  ?>

  <form action="" class = "card-form align-to-center" style="margin-top: 8px;">

    <!-- INR Ammount -->
    <div class="input-group mb-3" id = "money_send_amount_div" >
      <span class="input-group-text" id="money_send_currency_span" style = "height: 40px;"> 
        <img id = "inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
        INR
      </span>
      <input inputmode="numeric" class="form-control text-light font-weight-600" id = "money_send_amount_input" aria-label="Sizing example input" value="500" aria-describedby="inputGroup-sizing-sm" style = "height: 40px;" disabled>
    </div>

    <div class="row">
        <!-- Purpose dropdown -->
        <div class="col-xs-6 form-field__control goodluckdubugingit65446453" id="money_sending_remarks_div">
            <input style="width: 200px;" id="money_sending_purpose" type="text" class="form-field__input2" value="Travel" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;" disabled>
            <label style="width: 200px;" for="money_sending_purpose" class="form-field__label2" style="padding-top: 15px; padding-bottom: 0px;">Purpose</label>
        </div>

        <!-- Remarks -->
        <div class="col-xs-6 form-field__control goodluckdubugingit65546542" id="money_sending_remarks_div">
            <input style="width: 200px;" id="money_sending_remarks" type="text" class="form-field__input2" value="train ticket NMX to KGP" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;" disabled>
            <label style="width: 200px;" for="money_sending_remarks" class="form-field__label2" style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
        </div>
    </div>

    <!-- PIN input fields -->
    <div class="column">
        <div class="container d-flex flex-grow-1 justify-content-center align-items-center" id = "pin-input-container">
            <div id="inputs" class="inputs">
                <input id= "pin-input1" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
                <input id= "pin-input2" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
                <input id= "pin-input3" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
                <input id= "pin-input4" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
                <input id= "pin-input5" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
                <input id= "pin-input6" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
            </div>
        </div>
        <div class="enter-pin-text d-flex flex-grow-1 justify-content-center align-items-center">Please Enter KuberKosh PIN here</div>
        <br>
        <div class="forgot-pin d-flex flex-grow-1 justify-content-center align-items-center"> <a href="#" class="forgot-pin"> Forgot KuberKosh PIN? </a></div>

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
      <button style="margin: 15px 174px 0 174px;width: 154px;" href="#" class="btn btn-primary bg-gradient  idkwhattonameit34645 text-light font-weight-300" id="money_send_btn">CONFIRM</button>
      </div>


    </form>
  </div>





































  <div id = "sendConfirmDiv" class="card align-to-center position-absolute" style="margin-left: 30%; margin-top: 7%; display: none;">
  <img id = "receiverProfilePic" src="https://bit.ly/3Us0eCl" class="rounded-circle receiver-profile-pic " alt="receivers profile pic" width = "100px" height="100px">
  
  <h5 class="" id="verified_name"></h5>
  <h5 class="" id="verified_wallet-address"></h5>

  
  <h5 id="trnx_confirm_amnt"> </h5>


    <!-- <dotlottie-player id="success_animation" src="https://lottie.host/cfb05086-a402-4113-b111-84766aa6af49/j58fgJqsSv.json" background="transparent" speed="1" style="width: 300px; height: 300px; position: absolute; margin-top: 160px;" autoplay="false"></dotlottie-player> -->

    <div id="testdiv" style="width: 300px; height: 300px; position: absolute; margin-top: 10px;">
    <!-- <dotlottie-player  id = "success_animation" src="https://lottie.host/cfb05086-a402-4113-b111-84766aa6af49/j58fgJqsSv.json" background="transparent" speed="1" style="width: 300px; height: 300px; position: absolute; margin-top: 160px;" ></dotlottie-player> -->
    </div>

    <h3 id = "trnxMessage" style="width: 500px; height: 300px; position: absolute; margin-left: 190px; margin-top: 280px;">Transaction Successful</h3>

    <div id="dwnld_receipt_btn_div">
        <button style="margin: 15px 174px 0 174px;width: 184px;" href="#" class="btn btn-primary bg-gradient  dwnld_receipt_btn text-light font-weight-300" id="dwnld_receipt_btn">Download Receipt</button>
    </div>

    <a href="http://localhost/index.php?share"><img src="/img/shareIcon.svg" alt="Share Icon" id="share_icon"></a>        
</div>



</div>



<script>
    








function replaceDivWithVerificationDiv() {
  // Find the parent node
  var parentNode = document.getElementById('assumedBody');
  // Find the original div
  var originalDiv = document.getElementById('sendDiv');
  // Find the new div
  var newDiv = document.getElementById('sendVerifyDiv');
  // Replace the original div with the new div
  parentNode.replaceChild(newDiv, originalDiv);
  // Optionally, show the new div if it was initially hidden
  newDiv.style.display = 'flex';
}

function replaceDivWithConfirmationDiv() {
  // Find the parent node
  var parentNode = document.getElementById('assumedBody');
  // Find the original div
  var originalDiv = document.getElementById('sendVerifyDiv');
  // Find the new div
  var newDiv = document.getElementById('sendConfirmDiv');
  // Replace the original div with the new div
  parentNode.replaceChild(newDiv, originalDiv);
  // Optionally, show the new div if it was initially hidden
  newDiv.style.display = 'flex';
}



  var verified_name =document.getElementById('verified_name');

  var verifyWalletAddressButton =document.getElementById('verifyWalletAddressButton');

  var walletAddres;

  var receiver_address =document.getElementById('receiver_address');

  var receiverProfilePic = document.getElementById('receiverProfilePic');

  var money_send_btn = document.getElementById('money_send_btn');

  var money_send_amount_input = document.getElementById('money_send_amount_input');

  var money_sending_remarks = document.getElementById('money_sending_remarks');

  var selected_purpose = document.getElementById('selected_purpose');

  var money_send_amount;

  var amountToSend;

  verifyWalletAddressButton.addEventListener('click', function() 
  {
    event.preventDefault(); // Prevent form submission

    walletAddress = receiver_address.value.trim();

    // Client-side validation
    if (!walletAddress) 
    {
        alert('Please enter Receiver Wallet Address');
        return;
    }

    // Server-side validation of receivers wallet address via AJAX
    var xhrValidateReceiverWalletAddres = new XMLHttpRequest();
    xhrValidateReceiverWalletAddres.open('POST', 'php/ajaxFindNameFromWalletAddress.php'); 
    xhrValidateReceiverWalletAddres.setRequestHeader('Content-Type', 'application/json');
    
    var dataToSend = JSON.stringify({ walletAddress: walletAddress });
    //alert('Data being sent to server: ' + dataToSend); // Debugging: Log data being sent to server
    xhrValidateReceiverWalletAddres.send(dataToSend);
    
    xhrValidateReceiverWalletAddres.onload = function()
    {
      if (xhrValidateReceiverWalletAddres.status === 200) 
      {
        var response = JSON.parse(xhrValidateReceiverWalletAddres.responseText);
        //alert('Response from server: ' + JSON.stringify(response)); // Debugging: Log response from server
        if (!response.hasOwnProperty('error')) 
        {
          //alert('Name: ' + response.name);                          // Debugging: Log response from server

          receiverProfilePic.src = response.profilePicLink;
          verified_name.textContent = response.name;
          verified_name.style.color = '#4ECB71'; // Change the color to green

        }
        else if (response.hasOwnProperty('error')) 
        {
          receiverProfilePic.src = 'https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png';
          verified_name.textContent = 'Error: Wallet address invalid';
          verified_name.style.color = 'red'; // Change the color to red
          alert('Error: Wallet address invalid');
        }
        else 
        {
          receiverProfilePic.src = 'https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png';
          verified_name.textContent = 'Unknown Error';
          verified_name.style.color = 'red'; // Change the color to red
          alert('Unknown Error');
        }
      } 
      else 
      {
        alert('Error occurred while checking wallet address. Please try again1.');
      }
    };
  });
    
  money_send_btn.addEventListener('click', function() 
  {
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
    if (!walletAddress) 
    {
      alert('Please enter Receiver Wallet Address');
      return;
    }



    // Fetch verified name
    var receiverName = verified_name.textContent.trim();

    // Client-side validation of receivers wallet address verification
    if (!receiverName) 
    {
      alert('Please Valid Wallet Address');
      return;
    }


    // Fetch money_send_amount from input
    money_send_amount = money_send_amount_input.value.trim();

    // Client-side validation of money_send_amount
    if (!money_send_amount) {
      alert('Please enter amount to send');
      return;
    }
    else if (!/^\d+$/.test(money_send_amount)) {
      alert('Please enter a valid integer amount');
      return;
    }





    // Server-side validation of receivers wallet address via AJAX
    var xhrValidateReceiverWalletAddres = new XMLHttpRequest();
    xhrValidateReceiverWalletAddres.open('POST', 'php/ajaxFindNameFromWalletAddress.php'); 
    xhrValidateReceiverWalletAddres.setRequestHeader('Content-Type', 'application/json');
    
    var dataToSend = JSON.stringify({ walletAddress: walletAddress });
    //alert('Data being sent to server: ' + dataToSend); // Debugging: Log data being sent to server
    xhrValidateReceiverWalletAddres.send(dataToSend);
    
    xhrValidateReceiverWalletAddres.onload = function()
    {
      if (xhrValidateReceiverWalletAddres.status === 200)
      {
        var response = JSON.parse(xhrValidateReceiverWalletAddres.responseText);
        //alert('Response from server: ' + JSON.stringify(response)); // Debugging: Log response from server
        if (!response.hasOwnProperty('error')) 
        {
          //alert('Name: ' + response.name + ' ' + response.walletAddress);               // Debugging: Log data being sent to server

          receiverWalletAddress = response.walletAddress;
          receiverProfilePic.src = response.profilePicLink;
          verified_name.textContent = response.name;
          verified_name.style.color = '#4ECB71'; // Change the color to green

          amountToSend = money_send_amount;
          
          // Server-side validation of sending amount via AJAX
          var xhrValidateTransferAmount = new XMLHttpRequest();
          xhrValidateTransferAmount.open('POST', 'php/ajaxVerifyTransferAmount.php'); 
          xhrValidateTransferAmount.setRequestHeader('Content-Type', 'application/json');
          
          var dataToSend = JSON.stringify({ amountToSend: amountToSend });
          //alert('Data being sent to server : ' + dataToSend); // Debugging: Log data being sent to server
          xhrValidateTransferAmount.send(dataToSend);
          
          xhrValidateTransferAmount.onload = function()
          {
            if (xhrValidateTransferAmount.status === 200) 
            {
              var response = JSON.parse(xhrValidateTransferAmount.responseText);
              alert('Response from server' + JSON.stringify(response)); // Debugging: Log response from server

              // if (!response.hasOwnProperty('error') && response.valid && response.walletBalance >= amountToSend)
              if (!response.hasOwnProperty('error') && response.valid )
              {

                alert ('moving to next page');
                // purpose = selected_purpose.value;
                senderRemarks = money_sending_remarks.value.trim();
                

                replaceDivWithVerificationDiv();

                verifiedWalletAddress = document.getElementById('verified_wallet-address');
                verifiedWalletAddress.textContent = receiverWalletAddress;

                money_send_amount_input = document.getElementById('money_send_amount_input');
                money_send_amount_input.value = response.amountToSend;

                money_sending_remarks = document.getElementById('money_sending_remarks');
                money_sending_remarks.value = senderRemarks;

                money_sending_purpose = document.getElementById('money_sending_purpose');
                money_sending_purpose.value = "purpose";


                money_send_btn = document.getElementById('money_send_btn');
                money_send_btn.addEventListener('click', function() 
                {
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

                  var concatenatedString = pinInput1.toString() + pinInput2.toString() + pinInput3.toString() + pinInput4.toString() + pinInput5.toString() + pinInput6.toString();
                  
                  var hashedString = sha256(concatenatedString);

                  function sha256(ascii) {
                    function rightRotate(value, amount) {
                        return (value>>>amount) | (value<<(32 - amount));
                    };
                    
                    var mathPow = Math.pow;
                    var maxWord = mathPow(2, 32);
                    var lengthProperty = 'length'
                    var i, j; // Used as a counter across the whole file
                    var result = ''

                    var words = [];
                    var asciiBitLength = ascii[lengthProperty]*8;
                    
                    //* caching results is optional - remove/add slash from front of this line to toggle
                    // Initial hash value: first 32 bits of the fractional parts of the square roots of the first 8 primes
                    // (we actually calculate the first 64, but extra values are just ignored)
                    var hash = sha256.h = sha256.h || [];
                    // Round constants: first 32 bits of the fractional parts of the cube roots of the first 64 primes
                    var k = sha256.k = sha256.k || [];
                    var primeCounter = k[lengthProperty];
                    /*/
                    var hash = [], k = [];
                    var primeCounter = 0;
                    //*/

                    var isComposite = {};
                    for (var candidate = 2; primeCounter < 64; candidate++) {
                        if (!isComposite[candidate]) {
                            for (i = 0; i < 313; i += candidate) {
                                isComposite[i] = candidate;
                            }
                            hash[primeCounter] = (mathPow(candidate, .5)*maxWord)|0;
                            k[primeCounter++] = (mathPow(candidate, 1/3)*maxWord)|0;
                        }
                    }
                    
                    ascii += '\x80' // Append Ƈ' bit (plus zero padding)
                    while (ascii[lengthProperty]%64 - 56) ascii += '\x00' // More zero padding
                    for (i = 0; i < ascii[lengthProperty]; i++) {
                        j = ascii.charCodeAt(i);
                        if (j>>8) return; // ASCII check: only accept characters in range 0-255
                        words[i>>2] |= j << ((3 - i)%4)*8;
                    }
                    words[words[lengthProperty]] = ((asciiBitLength/maxWord)|0);
                    words[words[lengthProperty]] = (asciiBitLength)
                    
                    // process each chunk
                    for (j = 0; j < words[lengthProperty];) {
                        var w = words.slice(j, j += 16); // The message is expanded into 64 words as part of the iteration
                        var oldHash = hash;
                        // This is now the undefinedworking hash", often labelled as variables a...g
                        // (we have to truncate as well, otherwise extra entries at the end accumulate
                        hash = hash.slice(0, 8);
                        
                        for (i = 0; i < 64; i++) {
                            var i2 = i + j;
                            // Expand the message into 64 words
                            // Used below if 
                            var w15 = w[i - 15], w2 = w[i - 2];

                            // Iterate
                            var a = hash[0], e = hash[4];
                            var temp1 = hash[7]
                                + (rightRotate(e, 6) ^ rightRotate(e, 11) ^ rightRotate(e, 25)) // S1
                                + ((e&hash[5])^((~e)&hash[6])) // ch
                                + k[i]
                                // Expand the message schedule if needed
                                + (w[i] = (i < 16) ? w[i] : (
                                        w[i - 16]
                                        + (rightRotate(w15, 7) ^ rightRotate(w15, 18) ^ (w15>>>3)) // s0
                                        + w[i - 7]
                                        + (rightRotate(w2, 17) ^ rightRotate(w2, 19) ^ (w2>>>10)) // s1
                                    )|0
                                );
                            // This is only used once, so *could* be moved below, but it only saves 4 bytes and makes things unreadble
                            var temp2 = (rightRotate(a, 2) ^ rightRotate(a, 13) ^ rightRotate(a, 22)) // S0
                                + ((a&hash[1])^(a&hash[2])^(hash[1]&hash[2])); // maj
                            
                            hash = [(temp1 + temp2)|0].concat(hash); // We don't bother trimming off the extra ones, they're harmless as long as we're truncating when we do the slice()
                            hash[4] = (hash[4] + temp1)|0;
                        }
                        
                        for (i = 0; i < 8; i++) {
                            hash[i] = (hash[i] + oldHash[i])|0;
                        }
                    }
                    
                    for (i = 0; i < 8; i++) {
                        for (j = 3; j + 1; j--) {
                            var b = (hash[i]>>(j*8))&255;
                            result += ((b < 16) ? 0 : '') + b.toString(16);
                        }
                    }
                    return result;
                };

                  // AJAX request to TransferMoneyW2W
                  var xhrTransferMoneyW2W = new XMLHttpRequest();
                  xhrTransferMoneyW2W.open('POST', 'php/ajaxTransferMoneyW2W.php'); 
                  xhrTransferMoneyW2W.setRequestHeader('Content-Type', 'application/json');
                  
                  var dataToSend = JSON.stringify({ amountToSend: amountToSend, walletAddress: walletAddress, hashedPINEnteredByUser: hashedString});
                  alert('Data being sent to server : ' + dataToSend); // Debugging: Log data being sent to server
                  xhrTransferMoneyW2W.send(dataToSend);
                  
                  xhrTransferMoneyW2W.onload = function()
                  {
                    if (xhrTransferMoneyW2W.status === 200) 
                    {
                      alert('debug'+ xhrTransferMoneyW2W.status);       // Debugging: Log data being sent to server
                      
                      var response = JSON.parse(xhrTransferMoneyW2W.responseText);
                      
                      alert('Response from serverrrrrrrrrrrrrr' + JSON.stringify(response)); // Debugging: Log response from server
                      
                      if (!response.hasOwnProperty('error')  && response.success) 
                      {
                        


                        alert('Success: Transaction Id = ' + response.trnxId);
                        replaceDivWithConfirmationDiv()
                        alert(response);

                        receiverProfilePic=document.getElementById('receiverProfilePic');
                        receiverProfilePic.src = response.profilePic;

                        verifiedWalletAddress = document.getElementById('verified_wallet-address');
                        verifiedWalletAddress.textContent = response.receiverWalletAddress;

                        trnx_confirm_amnt = document.getElementById('trnx_confirm_amnt');
                        trnx_confirm_amnt.textContent = ('INR: ' + response.amountToSend);


                        trnxMessage = document.getElementById('trnxMessage');
                        trnxMessage.textContent = response.trnxMessage;
                        trnxMessage.style.color = '#4ECB71'; // Change the color to green


                        verified_name = document.getElementById('verified_name');
                        verified_name.textContent = response.receiverName;
                        verified_name.style.color = '#4ECB71'; // Change the color to green

                        



                      }
                      else if (response.hasOwnProperty('error'))
                      {
                        receiverProfilePic=document.getElementById('receiverProfilePic');
                        receiverProfilePic.src = 'https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png';

                        verified_name = document.getElementById('verified_name');
                        verified_name.textContent = response.receiverName;;
                        verified_name.style.color = 'red'; // Change the color to red

                        trnxMessage = document.getElementById('trnxMessage');
                        trnxMessage.textContent = response.trnxMessage;
                        trnxMessage.style.color = 'red'; // Change the color to green


                        alert('Error:' + response.error);
                      }
                      else 
                      {
                        alert('Unknown Error');
                      }
                    } 
                    else 
                    {
                      alert('Error occurred while verifying details with server. Please try again.');
                    }
                  };
                });
              
                // alert('Success: ' + amountToSend + 'has been transfered');
              }
              else if (response.hasOwnProperty('error')) 
              {
                alert('Error:' + response.error);
              }
              else 
              {
                alert('Unknown Error4324');
              }
            } 
            else 
            {
              alert('Error occurred while verifying details with server. Please try again.');
            }
          }
        }
        else if (response.hasOwnProperty('error')) 
        {
          receiverProfilePic.src = 'https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png';
          verified_name.textContent = 'Error: Wallet address invalid';
          verified_name.style.color = 'red'; // Change the color to red
          alert('Error: Wallet address invalid');
        }
        else 
        {
          receiverProfilePic.src = 'https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png';
          verified_name.textContent = 'Unknown Error';
          verified_name.style.color = 'red'; // Change the color to red
          alert('Unknown Error');
        }
      } 
      else 
      {
        alert('Error occurred while checking wallet address. Please try again.2');
      }
    }
  });
</script>
