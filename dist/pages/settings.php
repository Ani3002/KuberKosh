<?php
include_once 'php/database.php'; // Include the database.php file
include "php/google-auth.php";

// Function to retrieve banks data
function getBanksData($db) {
    $banks = array();

    $query = "SELECT regBank_id, bank_name FROM registeredBanks";
    $result = $db->query($query);

    while ($row = $result->fetch_assoc()) {
        $banks[] = array("regBank_id" => $row['regBank_id'], "val" => $row['bank_name']);
    }

    return $banks;
}

// Function to retrieve branches data
function getBranchesData($db) {
    $branches = array();

    $query = "SELECT regBank_id, brunch_id, brunchLocation FROM bank_brunches";
    $result = $db->query($query);

    while ($row = $result->fetch_assoc()) {
        $branches[$row['regBank_id']][] = array("regBank_id" => $row['regBank_id'], "val" => $row['brunchLocation']);
    }

    return $branches;
}

// Establish database connection
global $databaseConnection;

// Retrieve banks data
$banks = getBanksData($databaseConnection);

// Retrieve branches data
$branches = getBranchesData($databaseConnection);

// Encode data to JSON
$jsonBanks = json_encode($banks);
$jsonBranches = json_encode($branches);


// Function to retrieve IFSC code based on bank name and location
function getIFSC($db, $bankName, $location) {
    $query = "SELECT ifsc FROM bank_brunches WHERE brunchLocation = '$location'";
    $result = $db->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['ifsc'];
    } else {
        return ""; // If no IFSC found, return empty string
    }
}


// Check if the bank branch form is submitted
if (isset($_POST['submitBankBranch'])) {
    // Get the selected bank and branch from the form
    $selectedBank = $_POST['bank'];
    $selectedBranch = $_POST['branch'];

    // Get the IFSC code based on the selected bank and branch
    $ifsc = getIFSC($databaseConnection, $selectedBank, $selectedBranch);

    // Update the Bank table with the retrieved IFSC code
    $userId = $_SESSION['user_id']; // Works only if a user session exists

    $sql_updateIFSC = "UPDATE Bank SET bank1_IFSC = '$ifsc' WHERE user_id = '$userId'";
    if (mysqli_query($databaseConnection, $sql_updateIFSC)) {
        echo '<script>alert("IFSC code updated successfully    user_id:")</script>';
        echo "updated IFSC: " . $userId;
    } else {
        echo "Error updating IFSC: " . mysqli_error($databaseConnection);
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
            flex-wrap: wrap; /* Allow items to wrap onto multiple lines */
            margin-left: 200px; /* Adjust this according to your sidebar width */
            padding: 20px;
        }

        .navbar .navbar-links {
            display: flex;
            flex-wrap: wrap; /* Allow items to wrap onto multiple lines */
            justify-content: center; /* Center items horizontally */
        }

        .navbar a, .navbar button {
            margin: 0 10px;
            color: white; /* Set link text color to white */
            text-decoration: none; /* Remove underline */
        }
        .navbar button {
            margin: 0 10px;
            color: black; /* Set link text color to white */
            text-decoration: none; /* Remove underline */
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
            padding-top: 60px; /* Adjust this according to your navbar height */
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
            margin-left: 200px; /* Adjust this according to your sidebar width */
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
                echo '<span>'.$_SESSION["first_name"].' '.$_SESSION['last_name']. '</span>';
                
                echo '<img src="'.$_SESSION['profile_picture'].'" class="img-responsive img-circle img-thumbnail" />';
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
            <button class="tablinks" onclick="showSettingsDetails(event, 'userDetails')"  id="defaultOpen">User Detials</button>
            <button class="tablinks" onclick="showSettingsDetails(event, 'bankSettings')">Bank Settings</button>
            <button class="tablinks" onclick="showSettingsDetails(event, 'changePassword')">Change Password</button>
            <button class="tablinks" onclick="showSettingsDetails(event, 'manage2FA')">Manage 2FA</button>

        </div>

        <!-- Tab content -->
        <div id="userDetails" class="tabcontent">
            <h3>User Details</h3>
            <p>User details will be here</p>
        </div>

        <div id="bankSettings" class="tabcontent">
            <h3>Register your Bank</h3>
            <p>Select your Bank name and Bank Branch</p>
            <form method="post" action="">
                <div>
                    <select id='bankSelect' name="bank">
                    </select>

                    <select id='branchSelect' name="branch">
                    </select>
                    <input type="text" name="ifsc" id="ifscInput" placeholder="Enter IFSC Manually">
                </div>
                <input type="submit" name="submitBankBranch" value="Submit">
            </form>
        </div>

        <div id="changePassword" class="tabcontent">
            <h3>changePassword</h3>
            <p>changePassword details will be here</p>
        </div>

        <div id="manage2FA" class="tabcontent">
            <h3>manage2FA</h3>
            <p>manage2FA  will be here</p>
        </div>

        
    </div>





    <script>
        
        document.getElementById("defaultOpen").click();

        <?php
        echo "var banks = $jsonBanks; \n";
        echo "var branches = $jsonBranches; \n";
        ?>

        function showSettingsDetails(evt, settingsName) 
        {
            if (settingsName === "bankSettings") {
                loadBanksBranches();
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
        
        function loadBanksBranches() {
            var select = document.getElementById("bankSelect");
            select.onchange = updateBranches;

            // Add default "Select Bank" option
            select.options[0] = new Option("Select Bank", "");
            select.options[0].disabled = true;
            select.options[0].selected = true;

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
            branchSelect.options[0].disabled = true;
            branchSelect.options[0].selected = true;

            for (var i = 0; i < branches[bankid].length; i++) {
                branchSelect.options[i + 1] = new Option(branches[bankid][i].val, branches[bankid][i].branch_id);
            }
        }

    </script>
</body>
</html>
