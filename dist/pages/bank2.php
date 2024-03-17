<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Details</title>
</head>
<body>

<?php
$banks = [
    "Golden Dragon Bank" => [
        "Winterfell" => "GDB0WF42845",
        "Kings Landing" => "GDB0KL58411"
    ],
    "Bank of Tyrell" => [
        "High Garden" => "BOT0HG54321"
    ],
    "Iron Bank" => [
        "Bravos" => "IRB0BR98765",
        "Kings Landing" => "IRB0KL12345"
    ],
    "Bank of the North" => [
        "Winterfell" => "BON0WF56789",
        "Kings Landing" => "BON0KL98765",
        "High Garden" => "BON0HG23456",
        "Bravos" => "BON0BR87654"
    ]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedBank = $_POST["bank"];
    $enteredIFSC = $_POST["ifsc"];

    if (!empty($enteredIFSC) && isset($banks[$selectedBank])) {
        // Extracting details from the entered IFSC
        $bankShort = substr($enteredIFSC, 0, 3);
        $locationCode = substr($enteredIFSC, 5, 2);
        $enteredLocation = array_search($locationCode, array_column($banks[$selectedBank], 0, 1));

        echo "<p>Selected Bank: $selectedBank</p>";
        echo "<p>Entered IFSC: $enteredIFSC</p>";
        echo "<p>Corresponding Location: $enteredLocation</p>";
    }
}
?>

<form method="post" action="">
    <label for="bank">Choose a bank:</label>
    <select name="bank" id="bank" onchange="updateIFSCDropdown(this.value)">
        <?php
        foreach ($banks as $bank => $locations) {
            echo "<option value=\"$bank\">$bank</option>";
        }
        ?>
    </select>

    <br>

    <label for="ifsc">Select or Enter IFSC:</label>
    <select name="ifscDropdown" id="ifscDropdown" onchange="updateIFSCInput(this.value)">
        <option value="" selected disabled>Select IFSC</option>
        <!-- IFSC options will be dynamically populated here -->
    </select>
    <input type="text" name="ifsc" id="ifscInput" style="color: black;">
    <button type="button" onclick="verifyIFSC()">Verify</button>

    <br>

    <input type="submit" value="Submit">
</form>

<script>
    function updateIFSCDropdown(selectedBank) {
        var ifscDropdown = document.getElementById("ifscDropdown");
        var ifscInput = document.getElementById("ifscInput");

        // Clear previous options
        ifscDropdown.innerHTML = "<option value='' selected disabled>Select IFSC</option>";

        // Populate IFSC dropdown based on the selected bank
        var locations = <?php echo json_encode($banks); ?>[selectedBank];
        for (var location in locations) {
            var ifsc = locations[location];
            var option = document.createElement("option");
            option.value = ifsc;
            option.text = location + " (" + ifsc + ")";
            ifscDropdown.add(option);
        }

        // Clear the manual IFSC input
        ifscInput.value = "";
        ifscInput.style.color = "black";
    }

    function updateIFSCInput(selectedIFSC) {
        var ifscInput = document.getElementById("ifscInput");
        var ifscDropdown = document.getElementById("ifscDropdown");

        ifscInput.value = selectedIFSC;
        ifscInput.style.color = "grey";

        // Select the corresponding option in the dropdown
        for (var i = 0; i < ifscDropdown.options.length; i++) {
            if (ifscDropdown.options[i].value === selectedIFSC) {
                ifscDropdown.selectedIndex = i;
                break;
            }
        }
    }

    function clearDropdownSelection() {
        var ifscDropdown = document.getElementById("ifscDropdown");
        ifscDropdown.selectedIndex = 0;
    }

    function verifyIFSC() {
        var ifscInput = document.getElementById("ifscInput");
        var ifscDropdown = document.getElementById("ifscDropdown");

        var enteredIFSC = ifscInput.value;

        // Check if the entered IFSC matches any of the options in the dropdown
        for (var i = 0; i < ifscDropdown.options.length; i++) {
            if (ifscDropdown.options[i].value === enteredIFSC) {
                // Display corresponding details and freeze the input field
                var details = ifscDropdown.options[i].text.split(" ");
                alert("Verified!\nBank: " + details[0] + "\nLocation: " + details[1] + "\nIFSC: " + details[2]);
                ifscInput.readOnly = true;
                break;
            }
        }
    }
</script>

</body>
</html>
