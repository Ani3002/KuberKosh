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
    addMoneyToWalletV2($connect_kuberkosh_db, $connect_wallet_transactions_db, $bankAccountId, $money_send_amount, $trnxRemarks, $wallet_id, $userId);
}
?>

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

<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success fw-semibold" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="successModalMessage" class="modal-body text-light fw-normal">
                Success.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

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
                <input name="money_sending_remarks" id="money_sending_remarks" type="text" class="form-field__input" placeholder="Write remarks here">
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

<?php
function addMoneyToWalletV2($connect_kuberkosh_db, $connect_wallet_transactions_db, $bankAccountId, $money_send_amount, $trnxRemarks, $wallet_id, $userId)
{
    $senderUserId = $_SESSION['user_id'];
    $receiverUserId = $_SESSION['user_id'];

    $senderBankAccountId = getBankAccountId($connect_kuberkosh_db, fetchBankUserId($connect_kuberkosh_db, $userId));

    $receiverWalletId = fetchWalletDetails($connect_kuberkosh_db, $senderUserId)['wallet_id'];

    $senderName = fetchNameViaWalletAddress($connect_kuberkosh_db, fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address']);
    $receiverName = fetchNameViaWalletAddress($connect_kuberkosh_db, fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address']);

    $receiverEndBalanceBeforeTrnx = fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $userId);

    $receiverEndBalanceAfterTrnx = $receiverEndBalanceBeforeTrnx + $money_send_amount;

    $currentDate = date('Y-m-d');
    $currentDateTime = date('YmdHis');

    $trnxId = $senderUserId . $receiverUserId . $receiverWalletId . $senderBankAccountId . $senderName . $receiverName . $receiverEndBalanceBeforeTrnx . $receiverEndBalanceAfterTrnx . $currentDateTime;
    $trnxId = hash("sha3-256", $trnxId);

    $trnxRemarks = $trnxRemarks ?? ''; // Ensure $trnxRemarks is not null
    $senderParticulars = "B2W/CR/{$receiverName}//{$senderBankAccountId}/{$currentDateTime}//{$trnxRemarks}";

    // Validate and sanitize the input
    if (!empty($bankAccountId) && is_numeric($bankAccountId) && !empty($money_send_amount) && is_numeric($money_send_amount)) {
        // Subtract money from the selected bank account
        $amount = (int) $money_send_amount; // Convert to integer for safety
        $query = "UPDATE bank_accounts SET account_balance = account_balance - $amount WHERE bank_account_id = $bankAccountId";
        $result = $connect_kuberkosh_db->query($query);

        // Check if the query was successful
        if ($result) {
            // Get the current balance from the wallet table
            $balanceQuery = "SELECT end_balance FROM `$wallet_id` ORDER BY trnx_no DESC LIMIT 1";
            $balanceResult = $connect_wallet_transactions_db->query($balanceQuery);

            if ($balanceResult) {
                $row = $balanceResult->fetch_assoc();
                $current_balance = $row['end_balance'];
                $new_balance = $current_balance + $amount;

                // Construct the particulars
                $currentDate = date('Y-m-d');
                $currentDateTime = date('YmdHis');

                // Insert the new transaction into the wallet table
                $insertQuery = "INSERT INTO `$wallet_id` (`Date`, `Particulars`, `Trnx_id`, `credit`, `end_balance`, `trnxPurpose`)
                                VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $connect_wallet_transactions_db->prepare($insertQuery);
                $trnxPurpose = 'Transfer from Bank';
                $stmt->bind_param("sssids", $currentDate, $senderParticulars, $trnxId, $amount, $new_balance, $trnxPurpose);

                // Execute the statement
                $insertResult = $stmt->execute();

                $status = '';
                $insertError = '';

                if ($insertResult) {
                    $status = 'Success';
                    echo '<script>showModal("Success", "Money added successfully!");</script>';
                } else {
                    $status = 'Failed';
                    $insertError = $stmt->error;
                    echo '<script>showModal("Error", "Error updating wallet balance.");</script>';
                }

                // Log the transaction
                $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
                $insertLogQuery = "INSERT INTO `transaction_logs` (`user_id`, `sender_wallet_id`, `receiver_wallet_id`, `transaction_id`, `amount`, `status`, `sender_error`, `receiver_error`, `ip_address`)
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $insertLogStmt = $connect_kuberkosh_db->prepare($insertLogQuery);
                $senderError = '';
                $receiverError = $insertError;
                $insertLogStmt->bind_param("iiissssss", $senderUserId, $wallet_id, $wallet_id, $trnxId, $amount, $status, $senderError, $receiverError, $userIP);
                $insertLogStmt->execute();
                $insertLogStmt->close();

                $stmt->close();
            } else {
                echo '<script>showModal("Error", "Error retrieving current wallet balance.");</script>';
            }
        } else {
            echo '<script>showModal("Error", "Error updating bank account balance.");</script>';
        }
    } else {
        echo '<script>showModal("Error", "Invalid bank account ID or amount.");</script>';
    }
}
?>

<script>
function showModal(label, message) {
    var modalElement;
    var modalLabel;
    var modalMessage;
    if (label === "Success") {
        modalElement = document.getElementById('successModal');
        modalLabel = document.getElementById('successModalLabel');
        modalMessage = document.getElementById('successModalMessage');
    } else {
        modalElement = document.getElementById('failedModal');
        modalLabel = document.getElementById('failedModalLabel');
        modalMessage = document.getElementById('failedModalMessage');
    }
    modalLabel.textContent = label;
    modalMessage.textContent = message;
    var myModal = new bootstrap.Modal(modalElement);
    myModal.show();
}
</script>
