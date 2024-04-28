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
    <div class="dropdown" id = "dropdown_purpose_div">
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
      <input type="number" class="form-control text-light font-weight-600" id = "money_send_amount_input" aria-label="Sizing example input" value="500" aria-describedby="inputGroup-sizing-sm" style = "height: 40px;" disabled>
    </div>

    <div class="row">
        <!-- Purpose dropdown -->
        <div class="col-xs-6 form-field__control goodluckdubugingit65446453" id="money_sending_remarks_div">
            <input style="width: 200px;" id="money_sending_remarks" type="text" class="form-field__input2" value="Travel" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;" disabled>
            <label style="width: 200px;" for="money_sending_remarks" class="form-field__label2" style="padding-top: 15px; padding-bottom: 0px;">Purpose</label>
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
                <input id= "pin-input" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
                <input id= "pin-input" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
                <input id= "pin-input" class="input" type="password" onkeyup="changeColor()"
                    inputmode="numeric"  maxlength="1" pattern="\d*"  />
                <input id= "pin-input" class="input" type="password" onkeyup="changeColor()"
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
</div>



<script>
    








function replaceDiv() {
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



  var verified_name =document.getElementById('verified_name');

  var verifyWalletAddressButton =document.getElementById('verifyWalletAddressButton');

  var walletAddres;

  var receiver_address =document.getElementById('receiver_address');

  var receiverProfilePic = document.getElementById('receiverProfilePic');

  var money_send_btn = document.getElementById('money_send_btn');

  var money_send_amount_input = document.getElementById('money_send_amount_input');

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
    alert('Data being sent to server: ' + dataToSend); // Debugging: Log data being sent to server
    xhrValidateReceiverWalletAddres.send(dataToSend);
    
    xhrValidateReceiverWalletAddres.onload = function()
    {
      if (xhrValidateReceiverWalletAddres.status === 200) 
      {
        var response = JSON.parse(xhrValidateReceiverWalletAddres.responseText);
        alert('Response from server: ' + JSON.stringify(response)); // Debugging: Log response from server
        if (!response.hasOwnProperty('error')) 
        {
          alert('Name: ' + response.name);

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
    // make changes in the wallet transactions db fro sender and receiver depending on the ammount


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

    // Client-side validation of remoney_send_amount
    if (!money_send_amount) {
      alert('Please enter amount to send');
      return;
    }




    // Server-side validation of receivers wallet address via AJAX
    var xhrValidateReceiverWalletAddres = new XMLHttpRequest();
    xhrValidateReceiverWalletAddres.open('POST', 'php/ajaxFindNameFromWalletAddress.php'); 
    xhrValidateReceiverWalletAddres.setRequestHeader('Content-Type', 'application/json');
    
    var dataToSend = JSON.stringify({ walletAddress: walletAddress });
    alert('Data being sent to server: ' + dataToSend); // Debugging: Log data being sent to server
    xhrValidateReceiverWalletAddres.send(dataToSend);
    
    xhrValidateReceiverWalletAddres.onload = function()
    {
      if (xhrValidateReceiverWalletAddres.status === 200)
      {
        var response = JSON.parse(xhrValidateReceiverWalletAddres.responseText);
        alert('Response from server: ' + JSON.stringify(response)); // Debugging: Log response from server
        if (!response.hasOwnProperty('error')) 
        {
          alert('Name: ' + response.name);

          receiverProfilePic.src = response.profilePicLink;
          verified_name.textContent = response.name;
          verified_name.style.color = '#4ECB71'; // Change the color to green

          amountToSend = money_send_amount;

          
          


          
          // Server-side validation of sending amount via AJAX
          var xhrValidateTransferAmount = new XMLHttpRequest();
          xhrValidateTransferAmount.open('POST', 'php/ajaxVerifyTransferAmount.php'); 
          xhrValidateTransferAmount.setRequestHeader('Content-Type', 'application/json');
          
          var dataToSend = JSON.stringify({ amountToSend: amountToSend });
          alert('Data being sent to server : ' + dataToSend); // Debugging: Log data being sent to server
          xhrValidateTransferAmount.send(dataToSend);
          
          xhrValidateTransferAmount.onload = function()
          {
            if (xhrValidateTransferAmount.status === 200) 
            {
              var response = JSON.parse(xhrValidateTransferAmount.responseText);
              alert('Response from server' + JSON.stringify(response)); // Debugging: Log response from server
              if (!response.hasOwnProperty('error') && response.valid && response.walletBalance >= amountToSend) 
              {




                replaceDiv();

                // // AJAX request to TransferMoneyW2W
                // var xhrTransferMoneyW2W = new XMLHttpRequest();
                // xhrTransferMoneyW2W.open('POST', 'php/ajaxTransferMoneyW2W.php'); 
                // xhrTransferMoneyW2W.setRequestHeader('Content-Type', 'application/json');
                
                // var dataToSend = JSON.stringify({ amountToSend: amountToSend, walletAddress: walletAddress });
                // alert('Data being sent to server : ' + dataToSend); // Debugging: Log data being sent to server
                // xhrTransferMoneyW2W.send(dataToSend);
                
                // xhrTransferMoneyW2W.onload = function()
                // {
                //   if (xhrTransferMoneyW2W.status === 200) 
                //   {
                //     alert('debug'+ xhrTransferMoneyW2W.status);
                    
                //     var response = JSON.parse(xhrTransferMoneyW2W.responseText);
                    
                //     alert('Response from serverrrrrrrrrrrrrr' + JSON.stringify(response)); // Debugging: Log response from server
                    
                //     if (!response.hasOwnProperty('error') && response.success) 
                //     {
                //       alert('Success: Transaction Id = ' + response.trnxId);
                //     }
                //     else if (response.hasOwnProperty('error')) 
                //     {
                //       alert('Error:' + response.error);
                //     }
                //     else 
                //     {
                //       alert('Unknown Error');
                //     }
                //   } 
                //   else 
                //   {
                //     alert('Error occurred while verifying details with server. Please try again.');
                //   }
                // };


























                // alert('Success: ' + amountToSend + 'has been transfered');
              }
              else if (response.hasOwnProperty('error')) 
              {
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

  // function transferMoneyW2W(walletAddress, amountToSend);
  // {
  //   // AJAX request to transferMoneyW2W
  //   var xhrValidateTransferAmount = new XMLHttpRequest();
  //   xhrValidateTransferAmount.open('POST', 'php/ajaxTransferMoneyW2W.php'); 
  //   xhrValidateTransferAmount.setRequestHeader('Content-Type', 'application/json');
    
  //   var dataToSend = JSON.stringify({ amountToSend: amountToSend });
  //   alert('Data being sent to server : ' + dataToSend); // Debugging: Log data being sent to server
  //   xhrValidateTransferAmount.send(dataToSend);
    
  //   xhrValidateTransferAmount.onload = function()
  //   {
  //     if (xhrValidateTransferAmount.status === 200) 
  //     {
  //       var response = JSON.parse(xhrValidateTransferAmount.responseText);
  //       alert('Response from server' + JSON.stringify(response)); // Debugging: Log response from server
  //       if (!response.hasOwnProperty('error') && response.valid) 
  //       {
  //         transferMoneyW2W(walletAddress, amountToSend);
  //         alert('Success: ' + amountToSend + 'has been transfered');
  //       }
  //       else if (response.hasOwnProperty('error')) 
  //       {
  //         alert('Error:' + response.error);
  //       }
  //       else 
  //       {
  //         alert('Unknown Error');
  //       }
  //     } 
  //     else 
  //     {
  //       alert('Error occurred while verifying details with server. Please try again.');
  //     }
  //   };
    // xhr.send(JSON.stringify({ inputNewWalletAddress: inputNewWalletAddress, userId: userId}));

  // }







</script>
