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
                        class="form-control text-light font-weight-600" inputmode="numeric"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
                    <input name="money_withdrawing_remarks" id="money_withdrawing_remarks" type="text"
                        class="form-field__input" placeholder="Write remarks here">
                    <label for="money_withdrawing_remarks" class="form-field__label"
                        style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
                </div>

                <!-- Withdraw Money Button -->
                <div id="link_share_btn_div">
                    <button name="withdrawMoneyButton" type="submit"
                        class="btn btn-primary bg-gradient text-light font-weight-300" id="withdrawMoneyButton">Withdraw
                        Money</button>
                </div>
            </form>
        </div>
    </div>

    <div id="sendVerifyDiv" class="card card1 align-to-center position-absolute"
        style="margin-left: 30%; margin-top: 7%; display: none;">
        <img id="receiverProfilePic" src="img/transparent.png" class="rounded-circle receiver-profile-pic "
            alt="receivers profile pic" width="100px" height="70px">


        <h5 class="" id="verified_name"></h5>
        <h5 class="" id="verified_wallet_address"></h5>


        <form action="" class="card-form align-to-center" style="margin-top: 8px;">
            <div class="input-group mb-3" id="money_send_amount_div">
                <span class="input-group-text" id="money_send_currency_span" style="height: 40px;">
                    <img id="inr_logo" src="/img/inr.webp" alt="" width="35px" height="35px">
                    INR
                </span>
                <input inputmode="numeric" class="form-control text-light font-weight-600" id="money_send_amount_input"
                    aria-label="Sizing example input" value="500" aria-describedby="inputGroup-sizing-sm"
                    style="height: 40px;" disabled>
            </div>

            <div class="row">
                <!-- Purpose dropdown -->
                <div class="col-xs-6 form-field__control goodluckdubugingit65446453" id="money_sending_remarks_div">
                    <input style="width: 200px;" id="money_sending_purpose" type="text" class="form-field__input2"
                        value="Withdrawal" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;" disabled>
                    <label style="width: 200px;" for="money_sending_purpose" class="form-field__label2"
                        style="padding-top: 15px; padding-bottom: 0px;">Purpose</label>
                </div>

                <!-- Remarks -->
                <div class="col-xs-6 form-field__control goodluckdubugingit65546542" id="money_sending_remarks_div">
                    <input style="width: 200px;" id="money_sending_remarks" type="text" class="form-field__input2"
                        value="train ticket NMX to KGP" style="padding-bottom: 4px; padding-top: 4px; margin-top: 15px;"
                        disabled>
                    <label style="width: 200px;" for="money_sending_remarks" class="form-field__label2"
                        style="padding-top: 15px; padding-bottom: 0px;">Remarks</label>
                </div>
            </div>

            <div class="column">
                <div class="container d-flex flex-grow-1 justify-content-center align-items-center"
                    id="pin-input-container">
                    <div id="inputs" class="inputs">
                        <input id="pin-input1" class="input" type="password" inputmode="numeric" maxlength="1"
                            pattern="\d*" />
                        <input id="pin-input2" class="input" type="password" inputmode="numeric" maxlength="1"
                            pattern="\d*" />
                        <input id="pin-input3" class="input" type="password" inputmode="numeric" maxlength="1"
                            pattern="\d*" />
                        <input id="pin-input4" class="input" type="password" inputmode="numeric" maxlength="1"
                            pattern="\d*" />
                        <input id="pin-input5" class="input" type="password" inputmode="numeric" maxlength="1"
                            pattern="\d*" />
                        <input id="pin-input6" class="input" type="password" inputmode="numeric" maxlength="1"
                            pattern="\d*" />
                    </div>
                </div>
                <div class="enter-pin-text d-flex flex-grow-1 justify-content-center align-items-center">Please Enter
                    KuberKosh PIN here</div>
                <br>
                <div class="forgot-pin d-flex flex-grow-1 justify-content-center align-items-center"> <a href="#"
                        class="forgot-pin"> Forgot KuberKosh PIN? </a></div>
            </div>

            <script>
                const inputs = document.querySelectorAll("#inputs .input");
                inputs.forEach(input => {
                    input.addEventListener("input", function (e) {
                        const val = e.target.value;
                        if (isNaN(val) || val.length === 0) {
                            e.target.value = "";
                        } else {
                            const next = e.target.nextElementSibling;
                            if (next) {
                                next.focus();
                            }
                        }
                    });

                    input.addEventListener("keyup", function (e) {
                        if (e.key === "Backspace" || e.key === "Delete") {
                            e.target.value = "";
                            const prev = e.target.previousElementSibling;
                            if (prev) {
                                prev.focus();
                            }
                        }
                    });
                });
            </script>

            <div id="money_send_btn_div">
                <button style="margin: 60px 174px 0 174px;width: 154px;" href="#"
                    class="btn btn-primary bg-gradient text-light font-weight-300" id="money_send_btn">CONFIRM</button>
            </div>
        </form>
    </div>


    <!-- <div id="withdrawConfirmDiv" class="card card1 align-to-center position-relative" style=" display: none;"> -->
    <div id="withdrawConfirmDiv" class="card card1 align-to-center position-absolute"
        style="margin-left: 30%; margin-top: 7%; display: none;">

        <img id="receiverProfilePic" src="img/transparent.png" class="rounded-circle receiver-profile-pic "
            alt="receivers profile pic" width="100px" height="75px">

        <!-- <h5 id="verified_name"></h5> -->
        <?php
        echo '<h5 id= "verified_name" class="user-name align-to-center">' . $_SESSION["first_name"] . '' . $_SESSION["last_name"] . '</h5>';
        ?>

        <h3 id="trnxMessage"
            style="width: 500px; height: 30px; position: absolute; margin-left: 190px; margin-top: 280px;">Transaction
            Successful</h3>

        <h5 id="bankName"></h5>
        <br><br>
        <h5 id="accountNo"></h5>
        <br><br>
        <h5 id="money_withdraw_amount"></h5>
        <br><br>
        <h5 id="trnx_Id" style="color: var(--background-mode, #FFF);
        font-family: Inter;
        font-size: 0.9375rem;
        font-style: normal;
        font-weight: 500;
        line-height: normal;"> </h5>

        <!-- <dotlottie-player id="success_animation" src="https://lottie.host/cfb05086-a402-4113-b111-84766aa6af49/j58fgJqsSv.json" background="transparent" speed="1" style="width: 300px; height: 300px; position: absolute; margin-top: 160px;" autoplay="false"></dotlottie-player> -->

        <div id="testdiv" style="width: 300px; height: 300px; position: absolute; margin-top: 10px;">
            <!-- <dotlottie-player  id = "success_animation" src="https://lottie.host/cfb05086-a402-4113-b111-84766aa6af49/j58fgJqsSv.json" background="transparent" speed="1" style="width: 300px; height: 300px; position: absolute; margin-top: 160px;" ></dotlottie-player> -->
        </div>



        <div id="dwnld_receipt_btn_div">
            <button type="button" id="dwnld_receipt_btn" href="#"
                class="btn btn-primary bg-gradient idkwhattonameit34645 text-light font-weight-300"
                style="margin: 60px 174px 0 -90px; width: 184px;">Download Receipt</button>
            <!-- style="margin: 30px 174px 0 174px; width: 184px;" -->
            <!-- <button href="#" class="btn btn-primary bg-gradient  text-light font-weight-300" id="money_send_btn">CONFIRM</button> -->

        </div>
        <a id="shareBtn" href=""><img src="/img/shareIcon.svg" alt="Share Icon" id="share_icon"></a>
    </div>



    </div>


    <script>
        function showModal(label, message) {
            var modalElement = document.getElementById('failedModal');
            var failedModalLabel = document.getElementById('failedModalLabel');
            failedModalLabel.textContent = label;
            var failedModalMessage = document.getElementById('failedModalMessage');
            failedModalMessage.textContent = message;
            var myModal = new bootstrap.Modal(modalElement);
            myModal.show();
        }

        function replaceDivWithVerificationDiv() {
            var parentNode = document.getElementById('assumedBody');
            var originalDiv = document.getElementById('requestDiv');
            var newDiv = document.getElementById('sendVerifyDiv');
            parentNode.replaceChild(newDiv, originalDiv);
            newDiv.style.display = 'flex';
        }

        function replaceDivWithConfirmationDiv() {
            var parentNode = document.getElementById('assumedBody');
            var originalDiv = document.getElementById('sendVerifyDiv');
            var newDiv = document.getElementById('withdrawConfirmDiv');
            parentNode.replaceChild(newDiv, originalDiv);
            newDiv.style.display = 'flex';
        }

        document.getElementById('withdrawMoneyButton').addEventListener('click', function (event) {
            event.preventDefault();

            var money_withdraw_amount_input = document.getElementById('money_withdraw_amount_input');

            var money_withdrawing_remarks = document.getElementById('money_withdrawing_remarks');
            var bankSelect = document.getElementById('bankSelect');

            var amountToSend = parseFloat(money_withdraw_amount_input.value);
            var trnxRemarks = money_withdrawing_remarks.value.trim();
            var bankAccountId = bankSelect.value;

            if (isNaN(amountToSend) || amountToSend <= 0) {
                showModal("Failed:", "Please enter a valid amount to withdraw.");
                return;
            }

            if (bankAccountId === "") {
                showModal("Failed:", "Please select a bank account.");
                return;
            }

            var xhrValidateTransferAmount = new XMLHttpRequest();
            xhrValidateTransferAmount.open('POST', 'php/ajaxVerifyTransferAmount.php');
            xhrValidateTransferAmount.setRequestHeader('Content-Type', 'application/json');

            var dataToSend = JSON.stringify({ amountToSend: amountToSend });
            // alert('Data being sent to server: ' + dataToSend);
            xhrValidateTransferAmount.send(dataToSend);

            xhrValidateTransferAmount.onload = function () {
                if (xhrValidateTransferAmount.status === 200) {
                    var response = JSON.parse(xhrValidateTransferAmount.responseText);
                    // alert('Response from server: ' + JSON.stringify(response));

                    if (!response.hasOwnProperty('error') && response.valid) {
                        replaceDivWithVerificationDiv();




                        var xhrGetBankDetails = new XMLHttpRequest();
                        xhrGetBankDetails.open('POST', 'php/ajaxGetBankDetails.php');
                        xhrGetBankDetails.setRequestHeader('Content-Type', 'application/json');
                        var dataToSend = JSON.stringify({ bankAccountId: bankAccountId });
                        xhrGetBankDetails.send(dataToSend);
                        xhrGetBankDetails.onload = function () {
                            if (xhrGetBankDetails.status === 200) {
                                var response = JSON.parse(xhrGetBankDetails.responseText);

                                document.getElementById('verified_name').innerText = response.bankName;
                                document.getElementById('verified_wallet_address').innerText = "Account Number: " + response.accountNumber;
                            }
                        }



                        document.getElementById('pin-input1').focus();
                        document.getElementById('money_send_amount_input').value = response.amountToSend;
                        document.getElementById('money_sending_remarks').value = trnxRemarks;

                        var money_send_btn = document.getElementById('money_send_btn');
                        money_send_btn.addEventListener('click', function (event) {
                            event.preventDefault();

                            // alert('confirm btn clicked');
                            var pin = "";
                            for (let i = 1; i <= 6; i++) {
                                var pinInput = document.getElementById('pin-input' + i);
                                pin += pinInput.value.trim();
                            }

                            var hashedString = sha256(pin);

                            function sha256(ascii) {
                                function rightRotate(value, amount) {
                                    return (value >>> amount) | (value << (32 - amount));
                                };

                                var mathPow = Math.pow;
                                var maxWord = mathPow(2, 32);
                                var lengthProperty = 'length';
                                var i, j;
                                var result = '';

                                var words = [];
                                var asciiBitLength = ascii[lengthProperty] * 8;

                                var hash = sha256.h = sha256.h || [];
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

                                ascii += '\x80';
                                while (ascii[lengthProperty] % 64 - 56) ascii += '\x00';
                                for (i = 0; i < ascii[lengthProperty]; i++) {
                                    j = ascii.charCodeAt(i);
                                    if (j >> 8) return;
                                    words[i >> 2] |= j << ((3 - i) % 4) * 8;
                                }
                                words[words[lengthProperty]] = ((asciiBitLength / maxWord) | 0);
                                words[words[lengthProperty]] = (asciiBitLength);

                                for (j = 0; j < words[lengthProperty];) {
                                    var w = words.slice(j, j += 16);
                                    var oldHash = hash;
                                    hash = hash.slice(0, 8);

                                    for (i = 0; i < 64; i++) {
                                        var i2 = i + j;
                                        var w15 = w[i - 15], w2 = w[i - 2];

                                        var a = hash[0], e = hash[4];
                                        var temp1 = hash[7]
                                            + (rightRotate(e, 6) ^ rightRotate(e, 11) ^ rightRotate(e, 25))
                                            + ((e & hash[5]) ^ ((~e) & hash[6]))
                                            + k[i]
                                            + (w[i] = (i < 16) ? w[i] : (
                                                w[i - 16]
                                                + (rightRotate(w15, 7) ^ rightRotate(w15, 18) ^ (w15 >>> 3))
                                                + w[i - 7]
                                                + (rightRotate(w2, 17) ^ rightRotate(w2, 19) ^ (w2 >>> 10))
                                            ) | 0);
                                        var temp2 = (rightRotate(a, 2) ^ rightRotate(a, 13) ^ rightRotate(a, 22))
                                            + ((a & hash[1]) ^ (a & hash[2]) ^ (hash[1] & hash[2]));

                                        hash = [(temp1 + temp2) | 0].concat(hash);
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


                            // AJAX request to TransferMoneyW2B

                            var xhrTransferMoneyW2B = new XMLHttpRequest();
                            xhrTransferMoneyW2B.open('POST', 'php/ajaxTransferMoneyW2B.php');
                            xhrTransferMoneyW2B.setRequestHeader('Content-Type', 'application/json');
                            // alert('3');
                            // alert('money_withdraw_amount: ' + amountToSend);
                            // alert('bankAccountId: ' + bankAccountId);
                            // alert('hashedPINEnteredByUser: ' + hashedString);
                            // alert('money_withdrawing_remarks: ' + trnxRemarks);

                            var dataToSend = JSON.stringify({ money_withdraw_amount: amountToSend, bankAccountId: bankAccountId, hashedPINEnteredByUser: hashedString, money_withdrawing_remarks: trnxRemarks });
                            // alert('4');

                            // alert('Data being sent to server : ' + dataToSend); // Debugging: Log data being sent to server
                            xhrTransferMoneyW2B.send(dataToSend);
                            xhrTransferMoneyW2B.onload = function () {
                                // alert('5');


                                if (xhrTransferMoneyW2B.status === 200) {
                                    // alert('status: 200');
                                    // console.log('status: 200');
                                    // console.log('debug', xhrTransferMoneyW2B.status); // Debugging: Log data being sent to server
                                    // alert('debug'+ xhrTransferMoneyW2B.status);       // Debugging: Log data being sent to server

                                    var response = JSON.parse(xhrTransferMoneyW2B.responseText);

                                    // alert('Response from server' + JSON.stringify(response)); // Debugging: Log response from server

                                    if (!response.hasOwnProperty('error') && response.success) {
                                        //alert('Success: Transaction Id = ' + response.trnxId);
                                        replaceDivWithConfirmationDiv()
                                        //alert(response);
                                        // Populate confirmation page with transaction details
                                        document.getElementById('trnxMessage').innerText = response.trnxMessage;
                                        document.getElementById('trnxMessage').style.color = '#4ECB71'; // Change the color to green
                                        document.getElementById('verified_name').style.color = '#4ECB71';
                                        document.getElementById('bankName').innerText = response.bankName;
                                        document.getElementById('accountNo').innerText = `Account No: ${response.account_number}`;
                                        document.getElementById('money_withdraw_amount').innerText = `INR: ${response.money_withdraw_amount}`;
                                        document.getElementById('trnx_Id').innerText = `Transaction ID: ${response.trnxId.substring(0, 19)}`;


                                        dwnldRec = document.getElementById('dwnld_receipt_btn');
                                        dwnldRec = document.getElementById('dwnld_receipt_btn');

                                        var dwnld_receipt_btn = document.getElementById('dwnld_receipt_btn');
                                        dwnld_receipt_btn.addEventListener('click', function () {
                                            // Get transaction ID and amount from input fields
                                            var transactionId = response.trnxId;
                                            var amount = response.money_withdraw_amount;

                                            // Make sure transaction ID and amount are not empty

                                            // if (transactionId.trim() === '' || amount.trim() === '') {
                                            //     //alert('Please enter transaction ID and amount.');
                                            //     return;
                                            // }

                                            // Create a new XMLHttpRequest object
                                            var xhr = new XMLHttpRequest();

                                            // Configure the AJAX request
                                            xhr.open('POST', 'php/ajaxReceiptGenerator.php', true);
                                            xhr.responseType = 'blob'; // Set the response type to blob

                                            // Define the success callback function
                                            xhr.onload = function () {
                                                if (xhr.status === 200) {
                                                    // Create a blob URL from the response data
                                                    var blob = new Blob([xhr.response], { type: 'application/pdf' });
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
                                                    console.error('Error downloading receipt:', xhr.status);
                                                }
                                            };

                                            // Define the error callback function
                                            xhr.onerror = function () {
                                                console.error('Error downloading receipt:', xhr.statusText);
                                            };

                                            // Send the AJAX request with the transaction ID and amount as data
                                            var formData = new FormData();
                                            formData.append('transactionId', transactionId);
                                            formData.append('amount', amount);
                                            xhr.send(formData);
                                        });



                                    }
                                }
                            }


                        });
                    } else {
                        showModal("Error:", "Failed to validate transaction.");
                    }
                } else {
                    showModal("Error:", "Failed to validate transaction.");                    
                }
            };
        });

    </script>
</body>