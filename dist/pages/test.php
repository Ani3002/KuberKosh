<?php
include_once 'php/database.php'; // Include the database.php file
include_once 'php/functions.php';

global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

$userId = $_SESSION['user_id']; // Works only if a user session exists

$userBanks = getUserBanks($connect_kuberkosh_db, $userId);

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['withdrawMoneyButton'])) {
//     // Get the selected bank_account_id from the form submission
//     $bankAccountId = $_POST['bank_account_id'];
//     $money_withdraw_amount = $_POST['money_withdraw_amount'];
//     $trnxRemarks = $_POST['money_withdrawing_remarks'];

//     // Call the function to withdraw money from the wallet
//     withdrawMoneyFromWallet($connect_kuberkosh_db, $connect_wallet_transactions_db, $bankAccountId, $money_withdraw_amount, $trnxRemarks, $userId);
// }
?>

<body>
  <div id="assumedBody">
    <div id="requestDiv" class="card card1 align-to-center position-relative">
      <form action="" method="POST" class="card-form align-to-center">

        <!-- INR Amount -->
        <div class="input-group mt-2 mb-3" id="money_withdraw_amount_div">
          <span class="input-group-text" id="money_withdraw_currency_span">
            <img id="inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
            INR
          </span>
          <input name="money_withdraw_amount" id="money_withdraw_amount_input"
            class="form-control text-light font-weight-600" inputmode="numeric" aria-label="Sizing example input"
            aria-describedby="inputGroup-sizing-sm">
        </div>


        <div id="selectIFSC">
          <select id="bankSelect" name="bank_account_id" class="mb-3">
            <?php
            if (!empty($userBanks)) {
              foreach ($userBanks as $bank) {
                echo '<option value="' . $bank['bank_account_id'] . '">' . $bank['bank_info'] . '</option>';
              }
            } else {
              echo '<option value="">No banks registered</option>';
            }
            ?>
          </select>
        </div>

        <!-- Remarks -->
        <div class="form-field__control mb-3" id="money_withdrawing_remarks_div">
          <input name="money_withdrawing_remarks" id="money_withdrawing_remarks" type="text" class="form-field__input"
            placeholder="Write remarks here">
          <label for="money_withdrawing_remarks" class="form-field__label"
            style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
        </div>

        <!-- Withdraw Money Button -->
        <div id="link_share_btn_div">
          <button name="withdrawMoneyButton" type="submit" class="btn btn-primary bg-gradient text-light font-weight-300" id="withdrawMoneyButton">Withdraw Money</button>
          <!-- <button href="#" class="btn btn-primary bg-gradient text-light font-weight-300" id="withdrawMoneyButton">Withdraw Money</button> -->
        </div>
      </form>
    </div>
  </div>








  <div id="withdrawVerifyDiv" class="card card1 align-to-center position-absolute"
    style="margin-left: 30%; margin-top: 7%; display: none;">
    <!-- <img src="https://bit.ly/3Us0eCl" class="rounded-circle receiver-profile-pic " alt="receivers profile pic" width = "100px" height="100px"> -->
    <img id="receiverProfilePic" src="https://bit.ly/3Us0eCl" class="rounded-circle receiver-profile-pic "
      alt="receivers profile pic" width="100px" height="100px">

    <?php
    // echo '<img src="' . $_SESSION['profile_picture'] . '" class="rounded-circle receiver-profile-pic " alt="receivers profile pic" width = "100px" height="100px" />';
    echo '<h5 class="" id="verified_name">' . $_SESSION["first_name"] . ' ' . $_SESSION['last_name'] . '</h5>';
    echo '<h5 class="" id="verified_wallet-address"> walletaddress@kkosh </h5>'//. $reseiversAddress['receivers_address']. '</h5>';
      ?>

    <form action="" class="card-form align-to-center" style="margin-top: 8px;">

      <!-- INR Ammount -->
      <div class="input-group mb-3" id="money_send_amount_div">
        <span class="input-group-text" id="money_send_currency_span" style="height: 40px;">
          <img id="inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
          INR
        </span>
        <input inputmode="numeric" class="form-control text-light font-weight-600" id="money_withdraw_amount_input"
          aria-label="Sizing example input" value="500" aria-describedby="inputGroup-sizing-sm" style="height: 40px;"
          disabled>
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
          <input style="width: 200px;" id="money_withdrawing_remarks" type="text" class="form-field__input2"
            value="train ticket NMX to KGP" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;" disabled>
          <label style="width: 200px;" for="money_withdrawing_remarks" class="form-field__label2"
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
          id="withdrawMoneyButton">CONFIRM</button>

      </div>


    </form>
  </div>

  <script>
    function replaceDivWithVerificationDiv() {
      // Find the parent node
      var parentNode = document.getElementById('assumedBody');
      // Find the original div
      var originalDiv = document.getElementById('requestDiv');
      // Find the new div
      var newDiv = document.getElementById('withdrawVerifyDiv');
      // Replace the original div with the new div
      parentNode.replaceChild(newDiv, originalDiv);
      // Optionally, show the new div if it was initially hidden
      newDiv.style.display = 'flex';
    }

    function replaceDivWithConfirmationDiv() {
      // Find the parent node
      var parentNode = document.getElementById('assumedBody');
      // Find the original div
      var originalDiv = document.getElementById('withdrawVerifyDiv');
      // Find the new div
      var newDiv = document.getElementById('withdrawConfirmDiv');
      // Replace the original div with the new div
      parentNode.replaceChild(newDiv, originalDiv);
      // Optionally, show the new div if it was initially hidden
      newDiv.style.display = 'flex';
    }




    var withdrawMoneyButton = document.getElementById('withdrawMoneyButton');

    var money_withdraw_amount_input = document.getElementById('money_withdraw_amount_input');

    var money_sending_remarks = document.getElementById('money_sending_remarks');

    var inputPurpose = document.getElementById('dropdown_purpose_button_a');

    var selected_purpose = document.getElementById('selected_purpose');

    var wallet_verify = document.getElementById('wallet_verify');

    var money_send_amount;

    var amountToSend = money_withdraw_amount_input.trim();;

    withdrawMoneyButton.addEventListener('click', function () 
    {
      event.preventDefault();
      alert('Button Pressed');
      // verify the input fields in frontend
      // make ajax call to check input fields
      // check whether balance available with ajax
      // check whether wallet address valid with ajax
      // make changes in the wallet transactions db fro sender and receiver depending on the ammount after pin verification


      // Fetch money_send_amount from input
      money_withdraw_amount = money_withdraw_amount_input.value.trim();

      // Client-side validation of money_send_amount
      if (!money_withdraw_amount) {
        alert('Please enter amount to withdraw');
        return;
      }
      else if (!/^\d+$/.test(money_withdraw_amount)) {
        alert('Please enter a valid integer amount');
        return;
      }
      else if (parseInt(money_withdraw_amount) <= 0) {
        alert('Please enter a positive integer amount');
        return;
      }




      // Server-side validation of sending amount via AJAX
      var xhrValidateTransferAmount = new XMLHttpRequest();
      xhrValidateTransferAmount.open('POST', 'php/ajaxVerifyTransferAmount.php');
      xhrValidateTransferAmount.setRequestHeader('Content-Type', 'application/json');

      var dataToSend = JSON.stringify({ amountToSend: amountToSend });
      alert('Data being sent to server : ' + dataToSend); // Debugging: Log data being sent to server
      xhrValidateTransferAmount.send(dataToSend);

      xhrValidateTransferAmount.onload = function () 
      {
        if (xhrValidateTransferAmount.status === 200) 
        {
          var response = JSON.parse(xhrValidateTransferAmount.responseText);
          alert('Response from server' + JSON.stringify(response)); // Debugging: Log response from server

          // if (!response.hasOwnProperty('error') && response.valid && response.walletBalance >= amountToSend)
          if (!response.hasOwnProperty('error') && response.valid) 
          {
            //alert ('moving to next page');
                // purpose = selected_purpose.value;
                senderRemarks = money_sending_remarks.value.trim();
                var trnxPurpose = inputPurpose.value;
                

                replaceDivWithVerificationDiv();


                document.getElementById('pin-input1').focus();

                receiverProfilePic = document.getElementById('receiverProfilePic');
                receiverProfilePic.src = receiverProfilePic1;

                verified_name =document.getElementById('verified_name');
                verified_name.textContent = verified_name1;
                verified_name.style.color = '#4ECB71'; // Change the color to green

                verifiedWalletAddress = document.getElementById('verified_wallet-address');
                verifiedWalletAddress.textContent = receiverWalletAddress;

                money_send_amount_input = document.getElementById('money_send_amount_input');
                money_send_amount_input.value = response.amountToSend;

                money_sending_remarks = document.getElementById('money_sending_remarks');
                money_sending_remarks.value = senderRemarks;

                money_sending_purpose = document.getElementById('money_sending_purpose');
                money_sending_purpose.value = trnxPurpose;

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

                });
          }

        }


      }



    });
  </script>