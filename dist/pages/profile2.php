<?php
include_once 'php/functions.php';
require_once "php/database.php";

global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

$userId = $_SESSION['user_id']; // Works only if a user session exists
?>


<div id="assumedBody">
  <div id="profileDiv" class="card card1 align-to-center position-relative">

    <div class="d-flex align-items-center" style="padding-top: 10px;">
      <img id="profilePic" src="<?php  echo fetchProfilePictureLinkViaWalletAddress($connect_kuberkosh_db, (fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address']));    ?>" class="rounded-circle profile-pic" alt="receivers profile pic" width="100px" height="100px">
      <h1 class="display-9 sml-3"><?php echo $_SESSION["first_name"].' '.$_SESSION['last_name']?></h1>
    </div>


    <!-- registered email id -->
    <!-- <div class="form-field__control mt-2" id="money_sending_remarks_div">
      <input id="user_email" type="text" class="form-field__input" value="<?php //echo $_SESSION['email_address']; ?> " placeholder="your registered email id">
      <label for="user_email" class="form-field__label">Email</label>
      <button class="copy-button" onclick="copyToClipboard('user_email')">Copy</button>
    </div> -->

    <div class="form-field__control mt-2 position-relative" id="email_div">
      <input id="user_email" type="text" class="form-field__input" value="<?php echo $_SESSION['email_address']; ?>" placeholder="your registered email id">
      <label for="user_email" class="form-field__label">Email</label>
      <span class="copy-icon" onclick="copyToClipboard('user_email')">
        <img src="../img/copy-light.svg" alt="Copy" width="16" height="16">
      </span>
    </div>

    <!-- wallet address -->
    <!-- <div class="form-field__control mt-2" id="money_sending_remarks_div">
      <input id="wallet_address" type="text" class="form-field__input" value="<?php //echo fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address']; ?> " placeholder="your wallet address">
      <label for="wallet_address" class="form-field__label">Wallet Address</label>
      <button class="copy-button" onclick="copyToClipboard('wallet_address')">Copy</button>
    </div> -->

    <div class="form-field__control mt-2 position-relative" id="wallet_div">
      <input id="wallet_address" type="text" class="form-field__input" value="<?php echo fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address']; ?>" placeholder="your wallet address">
      <label for="wallet_address" class="form-field__label">Wallet Address</label>
      <span class="copy-icon" onclick="copyToClipboard('wallet_address')">
        <img src="../img/copy-light.svg" alt="Copy" width="16" height="16">
      </span>
    </div>


    <!-- wallet balance -->
    <div class="form-field__control mt-2 position-relative" id="money_sending_remarks_div">
      <input id="wallet_balance" type="password" class="form-field__input" value="<?php echo fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $userId); ?> " placeholder="your wallet balance">
      <label for="wallet_balance" class="form-field__label">Wallet Balance</label>
      <span class="eye-button" onmousedown="showBalance()" onmouseup="hideBalance()" onmouseleave="hideBalance()">
        👁️
      </span>
    </div>

  </div>
</div>

<script>
  function showBalance() {
    document.getElementById("wallet_balance").type = "text";
  }

  function hideBalance() {
    document.getElementById("wallet_balance").type = "password";
  }

  function copyToClipboard(elementId) {
    var copyText = document.getElementById(elementId);
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    document.execCommand("copy");

    // Optionally, you can show a tooltip or some feedback to the user
    alert("Copied the text: " + copyText.value);
  }
</script>

</body>
</html>










<!-- only click once to reveal -->

<!-- <div id="assumedBody">
  <div id="profileDiv" class="card align-to-center position-relative">

    <div class="d-flex" style="padding-top: 10px; align-items: left;">
      <img id="profilePic" src="https://bit.ly/3Us0eCl" class="rounded-circle profile-pic" alt="receivers profile pic" width="100px" height="100px">
      <h1 style="padding-right: 100px;"><?php // echo $_SESSION["first_name"].' '.$_SESSION['last_name']?></h1>
    </div>

    <div class="form-field__control mt-2" id="money_sending_remarks_div">
      <input id="user_email" type="text" class="form-field__input" value="<?php // echo $_SESSION['email_address']; ?> " placeholder="your registered email id">
      <label for="user_email" class="form-field__label">Email</label>
    </div>

    <div class="form-field__control mt-2" id="money_sending_remarks_div">
      <input id="wallet_address" type="text" class="form-field__input" value="<?php // echo fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address']; ?> " placeholder="your wallet address">
      <label for="wallet_address" class="form-field__label">Wallet Address</label>
    </div>

    <div class="form-field__control mt-2 position-relative" id="money_sending_remarks_div">
      <input id="wallet_balance" type="password" class="form-field__input" value="<?php // echo fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $userId); ?> " placeholder="your wallet balance">
      <label for="wallet_balance" class="form-field__label">Wallet Balance</label>
      <span class="eye-button" onclick="toggleBalanceVisibility()">
        👁️
      </span>
    </div>

  </div>
</div>

<script>
  function toggleBalanceVisibility() {
    var balanceField = document.getElementById("wallet_balance");
    if (balanceField.type === "password") {
      balanceField.type = "text";
    } else {
      balanceField.type = "password";
    }
  }
</script>
</body>
</html> -->