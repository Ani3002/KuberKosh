<?php
include_once 'php/database.php'; // Include the database.php file
include_once 'php/functions.php';

global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

$userId = $_SESSION['user_id']; // Works only if a user session exists

$userBanks = getUserBanks($connect_kuberkosh_db, $userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['withdrawMoneyButton'])) {
    // Get the selected bank_account_id from the form submission
    $bankAccountId = $_POST['bank_account_id'];
    $money_withdraw_amount = $_POST['money_withdraw_amount'];

    // Call the function to withdraw money from the wallet
    withdrawMoneyFromWallet($connect_kuberkosh_db, $connect_wallet_transactions_db, $bankAccountId, $money_withdraw_amount, $userId);
}
?>

<body>
<div id="assumedBody">
        <div id="requestDiv" class="card card1 align-to-center position-relative">
            <form action="" class="card-form align-to-center">

                <!-- INR Amount -->
                <div class="input-group mt-2 mb-3" id="money_withdraw_amount_div">
                    <span class="input-group-text" id="money_withdraw_currency_span">
                        <img id="inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
                        INR
                    </span>
                    <input name="money_withdraw_amount" id="money_withdraw_amount_input" class="form-control text-light font-weight-600" inputmode="numeric" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
                    <input id="money_withdrawing_remarks" type="text" class="form-field__input" placeholder="Write remarks here">
                    <label for="money_withdrawing_remarks" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
                </div>

                <!-- Withdraw Money Button -->
                <div id="link_share_btn_div">
                    <button name="withdrawMoneyButton" type="submit" class="btn btn-primary bg-gradient text-light font-weight-300" id="share_link_btn">Withdraw Money</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
