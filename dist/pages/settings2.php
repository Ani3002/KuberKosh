<?php
include_once 'php/database.php'; // Include the database.php file
include "php/google-auth.php";

// Establish database connection
global $connect_kuberkosh_db;

$userId = $_SESSION['user_id']; // Works only if a user session exists

// Retrieve banks data
$banks = getRegisteredBanksIdAndName($connect_kuberkosh_db);

// Retrieve branches data
$branches = getBranchesIdLocationIfscAndFKregBankId($connect_kuberkosh_db);

// Fetch Wallet details
$walletDetails = fetchWalletDetails($connect_kuberkosh_db, $userId);


$userDetails = getUserDetails($connect_kuberkosh_db, $userId);


// Fetch bank_user_id from Bank Table
$bankUserId = getBankUserId($connect_kuberkosh_db, $userId);
if (empty($bankUserId)) {
    $setBank_user_id = "INSERT INTO Bank (user_id) VALUES ($userId)";
    $stmt = $connect_kuberkosh_db->prepare($setBank_user_id);
    $stmt->execute();

    $bankUserId = getBankUserId($connect_kuberkosh_db, $userId);
}

// Fetch bank account id for the specified bank User ID
$bankAccountId = getBankAccountId($connect_kuberkosh_db, $bankUserId);

//TMP TMP TMP TMP TMP TMP TMP TMP TMP TMP 
$bankAccountDetails = getBankAccountDetails($connect_kuberkosh_db, $bankUserId);
// Check if bank account details are available
if (!empty($bankAccountDetails)) {
    $html = '<table class="table table-bordered table-striped">';
    $html .= '<thead class="thead-dark">';
    $html .= '<tr>';
    $html .= '<th scope="col">Bank Name</th>';
    $html .= '<th scope="col">Account Number</th>';
    $html .= '<th scope="col">IFSC Code</th>';
    $html .= '<th scope="col" style="width: 100px;">Delete</th>'; // Set the width here
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    foreach ($bankAccountDetails as $account) {
        $bankAccountId = htmlspecialchars($account['bank_account_id']);
        $bankName = htmlspecialchars($account['bank_name']);
        $accountNumber = htmlspecialchars($account['account_number']);
        $ifscCode = htmlspecialchars($account['ifsc_code']);


        $html .= "<tr>";
        $html .= "<td>$bankName</td>";
        $html .= "<td>$accountNumber</td>";
        $html .= "<td>$ifscCode</td>";
        $html .= "<td style=\"width: 100px; text-align: center;\">"; // Set the width here
        $html .= '<form method="post" style="display:inline;">';

        // Hidden inputs to pass account details
        $html .= '<input type="hidden" name="accountIdToDelete" value="' . $bankAccountId . '">';

        $html .= '<button type="submit" name="deleteBankSettings" class="btn btn-outline-danger" style="width: 35px; height: 35px; padding: 0;">';
        $html .= '<img src="img/trash.svg" alt="Delete" style="width: 20px; height: 20px;" class="trash-icon">';
        $html .= '</button>';

        $html .= '</form>';
        $html .= "</td>";
        $html .= "</tr>";
    }

    $html .= '</tbody>';
    $html .= '</table>';
} else {
    // No bank account details found
    $html = '<p>No bank account details available.</p>';
}


// Check if the delete form is submitted
if (isset($_POST['deleteBankSettings'])) {
    // Get the account ID and other details from the form
    $accountIdToDelete = $_POST['accountIdToDelete'];

    // Validate the form input
    if (!empty($accountIdToDelete)) {
        // Delete the bank account from the database
        $sql_deleteAccount = "DELETE FROM bank_accounts WHERE bank_account_id = '$accountIdToDelete'";
        if (mysqli_query($connect_kuberkosh_db, $sql_deleteAccount)) {
            echo '<script>alert("Bank account deleted successfully.");</script>';
            // echo '<script>window.location.reload();</script>';
        } else {
            echo "Error deleting account: " . mysqli_error($connect_kuberkosh_db);
        }
    } else {
        echo '<script>alert("Invalid account details.");</script>';
    }
}





// echo '<script>alert("bankAccountId: ' . $bankAccountId . '");</script>';             // Debugging


// Encode data to JSON
$jsonBanks = json_encode($banks);
$jsonBranches = json_encode($branches);
$jsonBankAccountId = json_encode($bankAccountId);
$jsonWalletDetails = json_encode($walletDetails);
$jsonBankUserId = json_encode($bankUserId);
$jsonBankAccountDetails = json_encode($bankAccountDetails);


// Output bank details as JSON
// header('Content-Type: application/json');
// echo json_encode($bankAccountId);


// Check if the bank branch form is submitted
if (isset($_POST['submitBankSettings'])) {
    // Get the selected bank and branch from the form
    $selectedBankId = $_POST['regBank_id'];
    $selectedBranch = $_POST['branch'];
    $enteredAccountNumber = $_POST['acno'];

    // Validate the form inputs
    if (!empty($selectedBankId) && !empty($selectedBranch) && !empty($enteredAccountNumber)) {
        // Get the IFSC code based on the selected bank and branch
        $ifsc = getIFSC($connect_kuberkosh_db, $selectedBankId, $selectedBranch);

        // Get the bank name based on the selected bank ID
        $bankName = getBankName($connect_kuberkosh_db, $selectedBankId);

        // Insert the new bank account into the database
        $sql_updateIFSC = "INSERT INTO bank_accounts (bank_user_id, account_number, ifsc_code, bank_name, account_balance) VALUES ('$bankUserId', '$enteredAccountNumber', '$ifsc', '$bankName', 0)";
        if (mysqli_query($connect_kuberkosh_db, $sql_updateIFSC)) {
            // Check if there is a default bank account set for the user
            $defaultBankAccountId = getDefaultBankAccountId($connect_kuberkosh_db, $userId);
            if (empty($defaultBankAccountId)) {
                // Get the newly inserted bank account ID
                $bankAccountId = getBankAccountId($connect_kuberkosh_db, $bankUserId);

                // Update the default bank account ID for the user
                updateDefaultBankAccountId($connect_kuberkosh_db, $bankAccountId, $userId);
            }
        } else {
            echo "Error updating IFSC: " . mysqli_error($connect_kuberkosh_db);
        }
    } else {
        echo '<script>alert("All fields are required.")</script>';
    }
}







// Conditional Statements to check if wallet address exists in db
// if exists add wallet detail to $jsonWalletDetails = json_encode($walletDetails)
// else create wallet address from email id.

// Conditional Statements to check if wallet address exists in db
if (!empty($walletDetails['wallet_address'])) {
    // Wallet address exists in the database
    $jsonWalletDetails = json_encode($walletDetails);
} else {
    // Create wallet address from email
    $email = $_SESSION['email_address'];
    $parts = explode('@', $email);
    $walletAddress = $parts[0] . '@kkosh'; // Replace everything after @ with "kkosh"

    // Function to insert this new wallet address into the database
    insertWalletAddress($connect_kuberkosh_db, $userId, $walletAddress);

    // Constructing a new array containing the wallet details
    $newWalletDetails = array(
        'wallet_id' => null, // Assuming this will be auto-generated by the database
        'user_id' => $userId,
        'wallet_address' => $walletAddress,
        'wallet_pin' => null // Yet to be handelled 
    );

    // Encode the new wallet details as JSON
    $jsonWalletDetails = json_encode($newWalletDetails);



}





?>

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




<div class="content tab-card align-to-center container">
    <div class="tab position-relative nav nav-tabs">
        <button class="tablinks nav-link active" onclick="showSettingsDetails(event, 'userDetails')"
            id="defaultOpen">User Details</button>
        <button class="tablinks nav-link" onclick="showSettingsDetails(event, 'bankSettings')">Bank Settings</button>
        <button class="tablinks nav-link" onclick="showSettingsDetails(event, 'walletSettings')">Wallet
            Settings</button>
        <!-- <button class="tablinks nav-link" onclick="showSettingsDetails(event, 'changePassword')">Change Password</button> -->
        <button class="tablinks nav-link" onclick="showSettingsDetails(event, 'manage2FA')">Manage 2FA</button>
    </div>
    <!-- HTML code -->
    <!-- Tab content -->
    <div id="userDetails" class="tabcontent active">
        <h3 class="text-primary">User Details</h3>
        <div class="form-grid">
            <div class="form-group1">
                <label>NAME</label>
                <input type="text" id="name"
                    value="<?php echo $userDetails['first_name'], ' ', $userDetails['last_name']; ?>" readonly>
            </div>
            <div class="form-group1">
                <label>PAN</label>
                <input type="text" id="pan" value="<?php echo $userDetails['pan']; ?>" readonly>
                <span class="edit-link" onclick="toggleEdit(this)">EDIT</span>
            </div>
            <div class="form-group1">
                <label>DATE OF BIRTH (DD/MM/YYYY)</label>
                <input type="text" id="dob"
                    value="<?php echo isset($userDetails['dob']) && !is_null($userDetails['dob']) ? date('d/m/Y', strtotime($userDetails['dob'])) : ''; ?>"
                    readonly>
                <span class="edit-link" onclick="toggleEdit(this)">EDIT</span>
            </div>
            <div class="form-group1">
                <label>GENDER</label>
                <input type="text" id="gender" value="<?php echo $userDetails['gender']; ?>" readonly>
                <span class="edit-link" onclick="toggleEdit(this)">EDIT</span>
            </div>
            <div class="form-group1">
                <label>MOBILE NUMBER</label>
                <input type="text" id="mobile" value="<?php echo $userDetails['mobile']; ?>" readonly>
                <span class="edit-link" onclick="toggleEdit(this)">EDIT</span>
            </div>
            <div class="form-group1">
                <label>EMAIL</label>
                <input type="text" id="email" value="<?php echo $userDetails['email']; ?>" readonly>
            </div>
            <div class="form-group1">
                <label>SECONDARY EMAIL</label>
                <input type="text" id="secondaryEmail" value="<?php echo $userDetails['secondary_email']; ?>" readonly>
                <span class="edit-link" onclick="toggleEdit(this)">EDIT</span>
            </div>
            <div class="form-group1">
                <label>USER ID</label>
                <input type="text" id="userId" value="<?php echo $userDetails['user_id']; ?>" readonly>
            </div>
        </div>
    </div>

    <script>
        function updateUserDetails() {
            // Collect the updated user details
            const dobInput = document.getElementById('dob').value;
            const formattedDOB = formatDOB(dobInput); // Format DOB to yyyy-mm-dd

            const userDetails = {
                userId: document.getElementById('userId').value,
                pan: document.getElementById('pan').value,
                dob: formattedDOB, // Use formatted date of birth
                gender: document.getElementById('gender').value,
                mobile: document.getElementById('mobile').value,
                secondaryEmail: document.getElementById('secondaryEmail').value,
            };

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'php/ajaxUserDetailsEdit.php');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Handle the response from the server
                        console.log(xhr.responseText);
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            showModal('Success', 'User details updated successfully');
                            setFieldsReadonly(true);
                            resetEditLinks();
                        } else {
                            showModal('Update Failed', response.message);
                        }
                    } else {
                        showModal('Error', 'An error occurred while updating user details.');
                    }
                }
            };
            xhr.send(JSON.stringify(userDetails));
        }

        function formatDOB(dob) {
            // Assuming dob is in dd/mm/yyyy format
            const parts = dob.split('/');
            if (parts.length !== 3) {
                return ''; // Handle invalid format gracefully
            }
            const formattedDOB = parts[2] + '-' + parts[1] + '-' + parts[0]; // yyyy-mm-dd format
            return formattedDOB;
        }


        function toggleEdit(element) {
            const input = element.previousElementSibling;
            if (input.readOnly) {
                input.readOnly = false;
                input.style.pointerEvents = 'auto';
                element.textContent = 'SUBMIT';
            } else {
                if (validateFields()) {
                    updateUserDetails();
                    input.readOnly = true;
                    input.style.pointerEvents = 'none';
                    element.textContent = 'EDIT';
                }
            }
        }

        function validateFields() {
            const pan = document.getElementById('pan').value;
            const dob = document.getElementById('dob').value;
            const mobile = document.getElementById('mobile').value;
            const secondaryEmail = document.getElementById('secondaryEmail').value;

            // PAN validation
            if (pan && !/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test(pan)) {
                showModal('Invalid PAN', 'PAN should be 10 characters long and in capital letters.');
                return false;
            }

            // DOB validation (DD/MM/YYYY format)
            if (dob && !/^\d{2}\/\d{2}\/\d{4}$/.test(dob)) {
                showModal('Invalid Date of Birth', 'Date of Birth should be in DD/MM/YYYY format.');
                return false;
            }

            // Mobile validation
            if (mobile && !/^\d{10}$/.test(mobile)) {
                showModal('Invalid Mobile Number', 'Mobile number should be a valid 10-digit number.');
                return false;
            }

            // Secondary Email validation
            if (secondaryEmail && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(secondaryEmail)) {
                showModal('Invalid Secondary Email', 'Secondary email should be a valid email address.');
                return false;
            }

            return true;
        }

        function setFieldsReadonly(readOnly) {
            document.getElementById('pan').readOnly = readOnly;
            document.getElementById('dob').readOnly = readOnly;
            document.getElementById('gender').readOnly = readOnly;
            document.getElementById('mobile').readOnly = readOnly;
            document.getElementById('secondaryEmail').readOnly = readOnly;

            document.getElementById('pan').style.pointerEvents = readOnly ? 'none' : 'auto';
            document.getElementById('dob').style.pointerEvents = readOnly ? 'none' : 'auto';
            document.getElementById('gender').style.pointerEvents = readOnly ? 'none' : 'auto';
            document.getElementById('mobile').style.pointerEvents = readOnly ? 'none' : 'auto';
            document.getElementById('secondaryEmail').style.pointerEvents = readOnly ? 'none' : 'auto';
        }

        function resetEditLinks() {
            const editLinks = document.querySelectorAll('.edit-link');
            editLinks.forEach(link => {
                link.textContent = 'EDIT';
            });
        }

    </script>





    <div id="bankSettings" class="tabcontent">
        <h3 class="text-primary">Linked Accounts</h3>

        <div id="LinkedAccounts" class="mb-4">
        </div>

        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#linkBankModal">
        Link New Bank Account
    </button> -->

        <div style="margin: auto auto auto 770px">
            <button type="button" class="btn btn-primary" id="linkBankBtn">
                Link New Bank Account
            </button>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="linkBankModal" tabindex="-1" role="dialog" aria-labelledby="linkBankModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="linkBankModalLabel">Link New Bank to KuberKosh</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form id="linkBankForm" method="post">
                            <div id="selectIFSC" class="form-group">
                                <p>Select your Bank Name:</p>
                                <select id='bankDropdown' name="regBank_id" class="form-control" style="    height: 45px;
    width: 450px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.10);
    padding: 0 15 0 15px;
    color: #fff;"></select>
                                <p class="mt-1">Select your Bank Branch:</p>

                                <select id='branchDropdown' name="branch" class="form-control" style="    height: 45px;
    width: 450px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.10);
    padding: 0 15 0 15px;
    color: #fff;"></select>
                            </div>
                            <div id="selectACNO" class="form-group" style="    height: 45px;
    width: 450px;
    /* border-radius: 10px; */
    /* background: rgba(255, 255, 255, 0.05); */
    /* border: 1px solid rgba(255, 255, 255, 0.10); */
    /* padding: 0 15 0 15px; */
    color: #fff;">
                                <p class="mt-1">Enter your bank account number:</p>
                                <input type="text" name="acno" id="acnoInput" class="form-control"
                                    placeholder="Enter Bank Account Number">
                            </div>
                            <input type="submit" name="submitBankSettings" value="Submit" class="btn btn-primary mt-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="walletSettings" class="tabcontent">
        <div id="walletAddressContainer">
            <h3 class="text-primary">Change wallet address</h3>

            <p id="walletAddress" class="mb-2"></p>
            <button id="changeWalletAddressBtn" class="btn btn-secondary btn-sm">Change Wallet Address</button>
            <form id="changeWalletAddressForm" class="mt-2" style="display: none;">
                <div class="input-group" style="    height: 50px;
    width: 450px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.10);
    padding: 0 15 0 15px;
    color: #fff;">
                    <input type="text" id="inputNewWalletAddress" class="form-control"
                        placeholder="Enter new wallet address">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <br>
        <hr>
        <br>
        <h3 class="text-primary">Change wallet PIN</h3>

        <div id="walletPINContainer">
            <p id="walletPIN" class="mb-2"></p>
            <button id="changeWalletPINBtn" class="btn btn-secondary btn-sm">Change Wallet PIN</button>
            <form id="changeWalletPINForm" class="mt-2" style="display: none;">
                <div class="mb-3">
                    <input type="password" id="inputCurrentPIN" class="form-control"
                        placeholder="Enter current wallet PIN">
                </div>
                <div class="mb-3">
                    <input type="password" id="inputNewPIN" class="form-control" placeholder="Enter new wallet PIN">
                </div>
                <div class="mb-3">
                    <input type="password" id="inputConfirmNewPIN" class="form-control"
                        placeholder="Confirm new wallet PIN">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- <div id="changePassword" class="tabcontent">
            <h3>Change Password</h3>
            <p>Change Password details will be here</p>
        </div> -->

    <div id="manage2FA" class="tabcontent">
        <h3>Manage 2FA</h3>
        <p id="totpStatus">Status: TOTP is disabled</p>
        <button id="enableTOTPBtn" class="btn btn-secondary" onclick="enableTOTP()">Enable TOTP</button>
        <button id="disableTOTPBtn" class="btn btn-danger" onclick="disableTOTP()" style="display: none;">Disable
            TOTP</button>
        <div id="totpContainer" style="display: none;">
            <!-- QR code and OTP verification input field will be dynamically loaded here -->
        </div>
    </div>
</div>

<script>
    // Function to check TOTP status
    function checkTOTPStatus() {
        fetch('php/ajaxCheckTOTP.php')
            .then(response => response.json())
            .then(data => {
                if (data.TOTPenabled) {
                    document.getElementById('totpStatus').textContent = 'Status: TOTP is enabled';
                    document.getElementById('enableTOTPBtn').style.display = 'none';
                    document.getElementById('disableTOTPBtn').style.display = 'block';
                } else {
                    document.getElementById('totpStatus').textContent = 'Status: TOTP is disabled';
                    document.getElementById('enableTOTPBtn').style.display = 'block';
                    document.getElementById('disableTOTPBtn').style.display = 'none';
                }
            })
            .catch(error => console.error('Error checking TOTP status:', error));
    }

    // Function to enable TOTP
    function enableTOTP() {
        // Show the TOTP container
        document.getElementById('totpContainer').style.display = 'block';

        // Fetch QR code and OTP verification input field
        fetch('php/ajaxGenerateTOTP.php')
            .then(response => response.json())
            .then(data => {
                if (data.TOTPenabled) {
                    alert("TOTP already exists, cannot setup new TOTP");
                } else {
                    // Inject the fetched HTML into the container
                    document.getElementById('totpContainer').innerHTML = `
                            <h2>QR Code</h2>
                            <p><img src="data:image/png;base64,${data.qr_code}" alt="QR Code" width="200" height="200"></p>
                            <p>Secret Key: ${data.secret_key}</p>
                            <h2>Verify Code</h2>
                            One-time password: <input type="number" name="otp" id="otp" required />
                            <input type="button" value="Verify" onclick="verify_otp();" />
                        `;
                }
            })
            .catch(error => console.error('Error fetching TOTP data:', error));
    }

    // Function to verify OTP
    function verify_otp() {
        let otp = document.getElementById('otp').value;
        fetch('php/enableTOTP.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ otp: otp })
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.result === true) {
                    alert("Valid One Time Password. TOTP has been enabled successfully.");
                    checkTOTPStatus();
                } else {
                    alert(data.message || "Invalid One Time Password.");
                }
            })
            .catch(error => console.error('Error verifying OTP:', error));
    }

    // Function to disable TOTP
    function disableTOTP() {
        if (confirm("Are you sure you want to disable TOTP?")) {
            fetch('php/ajaxDisableTOTP.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.result === true) {
                        alert("TOTP has been disabled successfully.");
                        checkTOTPStatus();
                    } else {
                        alert(data.message || "Failed to disable TOTP.");
                    }
                })
                .catch(error => console.error('Error disabling TOTP:', error));
        }
    }

    // Initial check of TOTP status
    checkTOTPStatus();
</script>
<!-- </div> -->



<!-- </div> -->





<script>

    document.getElementById("defaultOpen").click();


    // Bank Settings Tab   Bank Settings Tab   Bank Settings Tab   Bank Settings Tab   Bank Settings Tab   Bank Settings Tab   Bank Settings Tab   Bank Settings Tab   Bank Settings Tab   Bank Settings Tab   
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //

    <?php
    echo "var banks = $jsonBanks; \n";
    echo "var branches = $jsonBranches; \n";
    echo "var userId = $userId; \n"
        ?>
    function showSettingsDetails(evt, settingsName) {
        if (settingsName === "bankSettings") {
            loadBanks();
        }
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab

        document.getElementById(settingsName).style.display = "block";
        evt.currentTarget.className += " active";
    }










    function loadBanks() {
        var select = document.getElementById("bankDropdown");
        select.onchange = updateBranches;

        // Add default "Select Bank" option
        select.options[0] = new Option("Select Bank", "");
        // select.options[0].disabled = true;
        // select.options[0].selected = true;

        for (var i = 0; i < banks.length; i++) {
            select.options[i + 1] = new Option(banks[i].val, banks[i].regBank_id);
        }
    }

    function updateBranches() {
        var bankDropdown = this;
        var bankid = this.value;


        var branchDropdown = document.getElementById("branchDropdown");
        branchDropdown.options.length = 0; //delete all options if any present

        // Add default "Select Location" option
        branchDropdown.options[0] = new Option("Select Location", "");
        // branchDropdown.options[0].disabled = true;
        // branchDropdown.options[0].selected = true;

        for (var i = 0; i < branches[bankid].length; i++) {
            branchDropdown.options[i + 1] = new Option(branches[bankid][i].val, branches[bankid][i].branch_id);
        }
    }


    // Get the JSON string containing bank details and Parse the JSON string to JavaScript object
    // var bankAccountId = <//?php echo json_encode($bankAccountId); ?>;
    var bankAccountId = <?php echo $jsonBankAccountId; ?>;
    var bankUserId = <?php echo $jsonBankUserId; ?>;
    var bankAccountDetails = <?php echo $jsonBankAccountDetails; ?>;


    // Select the div where Linked bank account details will be displayed
    var linkedAccountsElement = document.getElementById("LinkedAccounts");
    linkedAccountsElement.innerHTML = "<?php echo addslashes($html); ?>";





    function checkLinkedAccounts(userId) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/ajaxCheckLinkedAccounts.php');
        xhr.setRequestHeader('Content-Type', 'application/json');

        var dataToSend = JSON.stringify({ bankUserId: bankUserId });
        xhr.send(dataToSend);

        xhr.onload = function () {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    if (response.linkedAccounts >= 6) {
                        showModal("Failed:", "Cannot add more than 6 accounts");
                    } else {
                        openAddBankAccountModal();
                    }
                } else {
                    showModal("Failed:", "Failed to check linked accounts.");
                }
            } else {
                showModal("Failed:", "An error occurred while processing your request.");
            }
        };
    }

    function showModal(label, message) {
        var modalElement = document.getElementById('failedModal');
        var failedModalLabel = document.getElementById('failedModalLabel');
        failedModalLabel.textContent = label;
        var failedModalMessage = document.getElementById('failedModalMessage');
        failedModalMessage.textContent = message;
        var myModal = new bootstrap.Modal(modalElement);
        myModal.show();
    }

    function openAddBankAccountModal() {
        // Logic to open the modal containing the form to add a new bank account
        var modal = document.getElementById('linkBankModal');
        var myModal = new bootstrap.Modal(modal);
        myModal.show();
    }

    document.getElementById('linkBankBtn').addEventListener('click', function () {
        var userId = // Get user ID from session or wherever it's stored
            checkLinkedAccounts(userId);
    });





    document.getElementById('linkBankForm').addEventListener('submit', function (event) {
        var bankDropdown = document.getElementById('bankDropdown').value;
        var branchDropdown = document.getElementById('branchDropdown').value;
        var acnoInput = document.getElementById('acnoInput').value;

        if (!bankDropdown) {
            showModal('Failed', 'Please select your bank name.');
            event.preventDefault();
        } else if (!branchDropdown) {
            showModal('Failed', 'Please select your bank branch.');
            event.preventDefault();
        } else if (!acnoInput) {
            showModal('Failed', 'Please enter your bank account number.');
            event.preventDefault();
        } else if (isNaN(acnoInput)) {
            showModal('Failed', 'The bank account number must be a number.');
            event.preventDefault();
        }
    });







    // Wallet Settings Tab   Wallet Settings Tab   Wallet Settings Tab   Wallet Settings Tab   Wallet Settings Tab   Wallet Settings Tab   Wallet Settings Tab   
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    // Parse the JSON data
    var walletDetails = JSON.parse('<?php echo $jsonWalletDetails; ?>');

    // Get the wallet address from the parsed JSON
    var walletAddress = walletDetails.wallet_address;


    // As the wallet details are stored in a variable called walletDetails
    var walletAddressElement = document.getElementById('walletAddress');
    walletAddressElement.textContent = 'Wallet address: ' + walletDetails.wallet_address;


    // Get elements
    // var walletAddressElement = document.getElementById('walletAddress');
    var changeWalletAddressBtn = document.getElementById('changeWalletAddressBtn');
    var changeWalletAddressForm = document.getElementById('changeWalletAddressForm');
    var newWalletAddressInput = document.getElementById('inputNewWalletAddress');

    // Display current wallet address
    walletAddressElement.textContent = 'Wallet address: ' + walletDetails.wallet_address;

    // Show change wallet form on button click
    changeWalletAddressBtn.addEventListener('click', function () {
        changeWalletAddressForm.style.display = 'block';
    });

    // Handle form submission to change the wallet address
    changeWalletAddressForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission

        // Get new wallet address from input
        var walletAddress = newWalletAddressInput.value.trim();

        // Client-side validation
        if (!walletAddress) {
            alert('Please enter a new wallet address');
            return;
        }
        // Server-side validation via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/ajaxCheckWalletAddress.php');
        xhr.setRequestHeader('Content-Type', 'application/json');

        var dataToSend = JSON.stringify({ walletAddress: walletAddress });
        // alert('Data being sent to server: ' + dataToSend); // Debugging: Log data being sent to server
        xhr.send(dataToSend);

        xhr.onload = function () {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                // alert('Response from server: ' + JSON.stringify(response)); // Debugging: Log response from server
                if (response.valid) {
                    // Valid wallet address, proceed to update database
                    updateWalletAddress(walletAddress, userId);
                    // alert('updated');
                } else {
                    alert('The provided wallet address is not available or already exists in the database');
                }
            } else {
                alert('Error occurred while checking wallet address. Please try again.');
            }
        };


    });

    // Function to update wallet address in the database
    function updateWalletAddress(inputNewWalletAddress, userId) {
        // AJAX request to update wallet address in the database
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/php/ajaxUpdateWalletAddress.php');     // i have no idea why response is 404 if /php/ is not added.
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Wallet address updated successfully
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    walletAddressElement.textContent = 'Wallet address: ' + inputNewWalletAddress;
                    changeWalletAddressForm.style.display = 'none';
                    newWalletAddressInput.value = '';
                    alert('Wallet address updated successfully');
                } else {
                    alert('Failed to update wallet address. Please try again.');
                }
            }
            else {
                alert('Error occurred while updating wallet address. Please try again.');
            }
        };
        xhr.send(JSON.stringify({ inputNewWalletAddress: inputNewWalletAddress, userId: userId }));
    }


    // JavaScript code to handle setting or changing wallet PIN functionality

    document.addEventListener('DOMContentLoaded', function () {
        var changeWalletPINBtn = document.getElementById('changeWalletPINBtn');
        var changeWalletPINForm = document.getElementById('changeWalletPINForm');

        // Get wallet details from JSON
        var walletDetails = <?php echo $jsonWalletDetails; ?>;

        // Check if wallet PIN is null
        var walletPIN = walletDetails.wallet_pin;
        if (walletPIN === null) {
            // Wallet PIN is null, show form to set new PIN
            changeWalletPINBtn.textContent = 'Set Wallet PIN';
            createSetPINForm();
        } else {
            // Wallet PIN exists, show form to change PIN
            changeWalletPINBtn.textContent = 'Change Wallet PIN';
            createChangePINForm();
        }

        // Function to create form for setting new PIN
        function createSetPINForm() {
            changeWalletPINForm.innerHTML = `
            <input type="password" id="inputNewPIN" placeholder="Enter new wallet PIN"><br>
            <input type="password" id="inputConfirmNewPIN" placeholder="Confirm new wallet PIN"><br>
            <button type="submit">Submit</button>
        `;
            changeWalletPINForm.style.display = 'none';
            changeWalletPINBtn.addEventListener('click', function () {
                changeWalletPINForm.style.display = 'block';
            });
        }

        // Function to create form for changing existing PIN
        function createChangePINForm() {
            changeWalletPINForm.innerHTML = `
            <input type="password" id="inputCurrentPIN" placeholder="Enter current wallet PIN"><br>
            <input type="password" id="inputNewPIN" placeholder="Enter new wallet PIN"><br>
            <input type="password" id="inputConfirmNewPIN" placeholder="Confirm new wallet PIN"><br>
            <button type="submit">Submit</button>
        `;
            changeWalletPINForm.style.display = 'none';
            changeWalletPINBtn.addEventListener('click', function () {
                changeWalletPINForm.style.display = 'block';
            });
        }

        // Handle form submission to set or change the wallet PIN
        changeWalletPINForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent form submission

            // Retrieve input values
            var currentPIN = document.getElementById('inputCurrentPIN') ? document.getElementById('inputCurrentPIN').value.trim() : '';
            var newPIN = document.getElementById('inputNewPIN').value.trim();
            var confirmNewPIN = document.getElementById('inputConfirmNewPIN').value.trim();

            // Perform client-side validation
            if (currentPIN && (!newPIN || !confirmNewPIN)) {
                alert('All fields are required.');
                return;
            }

            // Perform client-side validation for new PIN
            if (newPIN !== confirmNewPIN) {
                alert('New PIN and Confirm New PIN do not match.');
                return;
            }

            // AJAX request to set or change wallet PIN
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/php/updateWalletPIN.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    alert(response.message);
                    if (response.success) {
                        // Reset form and hide it
                        changeWalletPINForm.reset();
                        changeWalletPINForm.style.display = 'none';
                    }
                } else {
                    alert('Error occurred while updating wallet PIN. Please try again.');
                }
            };
            // Send the request with form data
            // var formData = 'currentPIN=' + encodeURIComponent(currentPIN) +
            //                 '&newPIN=' + encodeURIComponent(newPIN) +
            //                 '&confirmNewPIN=' + encodeURIComponent(confirmNewPIN);
            // xhr.send(formData);

            xhr.send(JSON.stringify({ currentPIN: currentPIN, newPIN: newPIN, confirmNewPIN: confirmNewPIN, userId: userId }));

        });
    });





</script>
</body>

</html>