<?php
include_once 'php/database.php'; // Include the database.php file
include "php/google-auth.php";

// Establish database connection
global $databaseConnection;

$userId = $_SESSION['user_id']; // Works only if a user session exists

// Retrieve banks data
$banks = getRegisteredBanksIdAndName($databaseConnection);

// Retrieve branches data
$branches = getBranchesIdLocationIfscAndFKregBankId($databaseConnection);

// Fetch bank details for the specified user ID
$bankDetails = getBankDetails($databaseConnection, $userId);


// Encode data to JSON
$jsonBanks = json_encode($banks);
$jsonBranches = json_encode($branches);
$jsonBankDetails = json_encode($bankDetails);

// Output bank details as JSON
// header('Content-Type: application/json');
// echo json_encode($bankDetails);


// Check if the bank branch form is submitted
if (isset ($_POST['submitBankSettings'])) {
    // Get the selected bank and branch from the form
    // $selectedBank = $_POST['bank'];
    $selectedBank = getBankName($databaseConnection, $_POST['regBank_id']);
    $selectedBranch = $_POST['branch'];

    $enteredAcountNumber = $_POST['acno'];


    // Get the IFSC code based on the selected bank and branch
    $ifsc = getIFSC($databaseConnection, $selectedBank, $selectedBranch);

    // Update the Bank table with the retrieved IFSC code
    $userId = $_SESSION['user_id']; // Works only if a user session exists

    // Call the function to check if user ID exists in the bank
    $bankUserId = getBankUserId($databaseConnection, $userId);
    echo $bankUserId;

    // If the bank user ID is empty, it means the user ID is also not there
    if (empty ($bankUserId)) {
        // Insert the user ID into the bank table
        $query = "INSERT INTO Bank (user_id) VALUES ($userId)";
        $insertUserId = $databaseConnection->query($query);
        if ($insertUserId === TRUE) {
            echo '<script>alert("User ID added successfully.")</script>';
        } else {
            echo '<script>alert("Error adding user ID")</script>';
        }
    } else {
        echo '<script>alert("User ID already exists in the bank.")</script>';
    }


    $sql_updateIFSC = "UPDATE Bank SET bank1_IFSC = '$ifsc', bank1_acno = '$enteredAcountNumber', bank1_name = '$selectedBank' WHERE user_id = '$userId'";
    if (mysqli_query($databaseConnection, $sql_updateIFSC)) {
        echo '<script>alert("IFSC code updated successfully")</script>';
        echo "updated IFSC: " . $userId;
    } else {
        echo "Error updating IFSC: " . mysqli_error($databaseConnection);
    }


    $defaultAccount = getDefaultAccountNumber($databaseConnection, $userId);

    // If default account is empty, set bank1_acno as default
    if (empty ($defaultAccount)) {

        // Update the Bank table with the entered account number as the default account
        $sql_updateDefaultAccount = "UPDATE Bank SET default_account = '$enteredAcountNumber' WHERE user_id = '$userId'";
        if (mysqli_query($databaseConnection, $sql_updateDefaultAccount)) {
            echo '<script>alert("Default account updated successfully")</script>';
        } else {
            echo "Error updating default account: " . mysqli_error($databaseConnection);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Page</title>

    <style>
        /* Add your CSS styles here */
        /* Navbar styles */
        /* Navbar styles */
        /* Navbar styles */
        /* Navbar styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            flex-wrap: wrap;
            /* Allow items to wrap onto multiple lines */
            margin-left: 200px;
            /* Adjust this according to your sidebar width */
            padding: 20px;
        }

        .navbar .navbar-links {
            display: flex;
            flex-wrap: wrap;
            /* Allow items to wrap onto multiple lines */
            justify-content: center;
            /* Center items horizontally */
        }

        .navbar a,
        .navbar button {
            margin: 0 10px;
            color: white;
            /* Set link text color to white */
            text-decoration: none;
            /* Remove underline */
        }

        .navbar button {
            margin: 0 10px;
            color: black;
            /* Set link text color to white */
            text-decoration: none;
            /* Remove underline */
        }

        /* Profile section */
        .navbar .profile {
            display: flex;
            align-items: center;
        }




        /* Side left page styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 200px;
            background-color: #f0f0f0;
            padding-top: 60px;
            /* Adjust this according to your navbar height */
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .sidebar li:last-child {
            border-bottom: none;
        }

        .sidebar li a {
            color: #333;
            text-decoration: none;
        }

        .sidebar li a:hover {
            background-color: #ddd;
        }

        /* Main content styles */
        .content {
            margin-left: 200px;
            /* Adjust this according to your sidebar width */
            padding: 20px;

        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            KuberKosh
        </div>
        <div class="navbar-links">
            <a href="#">About</a>
            <a href="#">Features</a>
            <a href="#">Support</a>
            <button>Language</button>
            <div class="profile">
                <!-- <span>Name</span> -->
                <?php
                echo '<span>' . $_SESSION["first_name"] . ' ' . $_SESSION['last_name'] . '</span>';

                echo '<img src="' . $_SESSION['profile_picture'] . '" class="img-responsive img-circle img-thumbnail" />';
                ?>
                <!-- <img src="profile-picture.jpg" alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%;"> -->
            </div>
        </div>
    </div>

    <!-- Side left page -->
    <div class="sidebar">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Send Money</a></li>
            <li><a href="#">Receive Money</a></li>
            <li><a href="#">Add Money</a></li>
            <li><a href="#">Withdraw Money</a></li>
            <li><a href="#">Transactions</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <!-- Tab links -->
    <div class="content">

        <div class="tab">
            <button class="tablinks" onclick="showSettingsDetails(event, 'userDetails')" id="defaultOpen">User
                Detials</button>
            <button class="tablinks" onclick="showSettingsDetails(event, 'bankSettings')">Bank Settings</button>
            <button class="tablinks" onclick="showSettingsDetails(event, 'walletSettings')">Wallet Settings</button>
            <button class="tablinks" onclick="showSettingsDetails(event, 'changePassword')">Change Password</button>
            <button class="tablinks" onclick="showSettingsDetails(event, 'manage2FA')">Manage 2FA</button>

        </div>

        <!-- Tab content -->
        <div id="userDetails" class="tabcontent">
            <h3>User Details</h3>
            <p>User details will be here</p>
        </div>

        <div id="bankSettings" class="tabcontent">
            <h3>Linked Accounts</h3>

            <div id="bankDetails">
                <!-- Bank details will be populated here dynamically -->
            </div>

            <h3>Link New Bank to KuberKosh</h3>

            <form method="post" action="">
                <div id="selectIFSC">
                    <p>Select your Bank name and Bank Branch:</p>
                    <select id='bankSelect' name="regBank_id">
                    </select>

                    <select id='branchSelect' name="branch">
                    </select>
                    <input type="text" name="ifsc" id="ifscInput" placeholder="Enter IFSC Manually">
                </div>
                <div id="selectACNO">
                    <p>Enter your bank account number:</p>
                    <input type="text" name="acno" id="acnoInput" placeholder="Enter Bank Account Number">
                </div>
                <input type="submit" name="submitBankSettings" value="Submit">
            </form>
        </div>

        <div id="walletSettings" class="tabcontent">
            <h3>wallet Settings</h3>
            <p>Your Wallet ID: </p>
            <p> Change wallet ID</p>
            <p>Set wallet pin</p>
            <p>Change wallet pin</p>
        </div>

        <div id="changePassword" class="tabcontent">
            <h3>changePassword</h3>
            <p>changePassword details will be here</p>
        </div>

        <div id="manage2FA" class="tabcontent">
            <h3>manage2FA</h3>
            <p>manage2FA will be here</p>
        </div>

    </div>





    <script>

        document.getElementById("defaultOpen").click();

        <?php
        echo "var banks = $jsonBanks; \n";
        echo "var branches = $jsonBranches; \n";
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
            var select = document.getElementById("bankSelect");
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
            var bankSelect = this;
            var bankid = this.value;


            var branchSelect = document.getElementById("branchSelect");
            branchSelect.options.length = 0; //delete all options if any present

            // Add default "Select Location" option
            branchSelect.options[0] = new Option("Select Location", "");
            // branchSelect.options[0].disabled = true;
            // branchSelect.options[0].selected = true;

            for (var i = 0; i < branches[bankid].length; i++) {
                branchSelect.options[i + 1] = new Option(branches[bankid][i].val, branches[bankid][i].branch_id);
            }
        }

        // Get the JSON string containing bank details and Parse the JSON string to JavaScript object
        var bankDetails = <?php echo json_encode($bankDetails); ?>;


        // Select the div where bank details will be displayed
        var bankDetailsDiv = document.getElementById("bankDetails");

        // Construct HTML based on bank details
        var html = "";

        // Check if bank1_name, bank1_acno, and bank1_IFSC have data
        if (bankDetails.bank1_name && bankDetails.bank1_acno && bankDetails.bank1_IFSC) {
            html += "<p>First Linked Account:</p>";
            html += "<p>Name: " + bankDetails.bank1_name + "</p>";
            html += "<p>Account Number: " + bankDetails.bank1_acno + "</p>";
            html += "<p>IFSC: " + bankDetails.bank1_IFSC + "</p>";
        } else {
            html += "<p>No bank linked</p>";
        }

        // Check if bank2_name, bank2_acno, and bank2_IFSC have data
        if (bankDetails.bank2_name && bankDetails.bank2_acno && bankDetails.bank2_IFSC) {
            html += "<br>";
            html += "<p>Second Linked Account:</p>";
            html += "<p>Name: " + bankDetails.bank2_name + "</p>";
            html += "<p>Account Number: " + bankDetails.bank2_acno + "</p>";
            html += "<p>IFSC: " + bankDetails.bank2_IFSC + "</p>";
        }

        // Set the HTML content of the bankDetailsDiv
        bankDetailsDiv.innerHTML = html;

        
    </script>
</body>

</html>