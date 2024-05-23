<?php
include_once 'php/database.php'; // Include the database.php file

global $connect_kuberkosh_db;
$userId = $userId = $_SESSION['user_id']; // Works only if a user session exists

$userBanks = getUserBanks($connect_kuberkosh_db, $userId);

$walletDetails = fetchWalletDetails($connect_kuberkosh_db, $userId);

$wallet_id = $walletDetails['wallet_id'];
?>
        
        <div id="assumedBody">
        <div id="requestDiv" class="card align-to-center position-absolute">
            <form action="" class="card-form align-to-center">

                

                <!-- INR Amount -->
                <div class="input-group mt-2 mb-3" id="money_send_amount_div">
                    <span class="input-group-text" id="money_send_currency_span"> 
                        <img id="inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
                        INR
                    </span>
                    <input id="money_send_amount_input" class="form-control text-light font-weight-600" inputmode="numeric" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div id="selectIFSC">
                    <select id="bankSelect" name="bank_account_id" class=" mb-3">
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
                <div class="form-field__control mb-3" id="money_sending_remarks_div">
                    <input id="money_sending_remarks" type="text" class="form-field__input" placeholder="Write remarks here">
                    <label for="money_sending_remarks" class="form-field__label" style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
                </div>

                <!-- Generate and Copy Link Button -->
                <div id="link_share_btn_div">
                    <button type="button" class="btn btn-primary bg-gradient text-light font-weight-300" id="share_link_btn" onclick="generateAndCopyUrl()">Withdraw Money</button>
                </div>
            </form>
        </div>
    </div>
