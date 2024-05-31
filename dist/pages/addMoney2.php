<?php
include_once 'php/database.php'; // Include the database.php file
include_once 'php/functions.php';

global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

$userId = $_SESSION['user_id']; // Works only if a user session exists

$userBanks = getUserBanks($connect_kuberkosh_db, $userId);

$walletDetails = fetchWalletDetails($connect_kuberkosh_db, $userId);
$wallet_id = $walletDetails['wallet_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addMoneyButton'])) {
    // Get the selected bank_account_id from the form submission
    $bankAccountId = $_POST['bank_account_id'];
    $money_send_amount = $_POST['money_send_amount'];
    $trnxRemarks = $_POST['money_sending_remarks'];

    // Call the function to add money to the wallet
    addMoneyToWallet($connect_kuberkosh_db, $connect_wallet_transactions_db, $bankAccountId, $money_send_amount, $trnxRemarks, $wallet_id, $userId);
}
?>
<div id="assumedBody">
        <div id="requestDiv" class="card card1 align-to-center position-relative">
            <form action="" method="POST" class="card-form align-to-center"> 
                <div id="selectIFSC">
                    <select id="bankSelect" name="bank_account_id" class="mt-3 mb-2">
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

                <!-- INR Amount -->
                <div class="input-group mb-3" id="money_send_amount_div">
                    <span class="input-group-text" id="money_send_currency_span">
                        <img id="inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
                        INR
                    </span>
                    <input name="money_send_amount" id="money_send_amount_input" class="form-control text-light font-weight-600" inputmode="numeric" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <!-- Remarks -->
                <div class="form-field__control mb-3" id="money_sending_remarks_div">
                    <input name= "money_sending_remarks" id="money_sending_remarks" type="text" class="form-field__input" placeholder="Write remarks here">
                    <label for="money_sending_remarks" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
                </div>

                <!-- Add Money Button -->
                <div id="link_share_btn_div">
                    <button name="addMoneyButton" type="submit" class="btn btn-primary bg-gradient text-light font-weight-300" id="share_link_btn">Add Money</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
