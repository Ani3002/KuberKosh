<?php
include_once 'php/database.php'; // Include the database.php file
include_once 'php/functions.php';

global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

$userId = $_SESSION['user_id']; // Works only if a user session exists

$userBanks = getUserBanks($connect_kuberkosh_db, $userId);
?>


<div id="assumedBody" class="container">
    <div id="dashDivOne" class="card dashDivCard1 position-relative">
        <h5 id="wd">Wallet Details</h5>
        <div class="d-flex gap-0">
            <div>
                <h5 id="nameLabel" class="label">Name</h5>
                <h5 id="dashUserName" class="dashLabelContent">
                    <?php echo $_SESSION["first_name"] . ' ' . $_SESSION['last_name'] ?>
                </h5>
                <h5 id="walletAddressLabel" class="label">Wallet Address</h5>
                <h5 id="dashWalletAddress" class="dashLabelContent">
                    <?php echo fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_address']; ?>
                </h5>
            </div>
            <div>
                <h5 id="bankNameLabel" class="label">Bank Name</h5>
                <h5 id="bankName" class="dashLabelContent"></h5>
                <h5 id="bankAccNoLabel" class="label">Account Number</h5>
                <h5 id="bankAccNo" class="dashLabelContent"></h5>
            </div>
            <div id="dashBankSelectDiv">
                <select id="dashBankSelect" name="bank_account_id" class="dashLabelContent">
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




                <h5 id="dashCheckBankBal" class="dashLabelContent">Bank Balance</h5>
                <div class="d-flex">
                    <div>
                        <input id="dashBankBal" type="password" class="hiddenBalance"
                            value=""
                            placeholder="balance">
                    </div>
                    <span id="dashEyeBtnBank" class="eye-button" onmousedown="showBankBalance()" onmouseup="hideBankBalance()"
                        onmouseleave="hideBankBalance()">
                        👁️
                    </span>
                </div>










                <h5 id="dashCheckBal" class="dashLabelContent">Wallet Balance</h5>
                <div class="d-flex">
                    <div>
                        <input id="dashWalletBal" type="password" class="hiddenBalance"
                            value="<?php echo fetchWalletBalance($connect_kuberkosh_db, $connect_wallet_transactions_db, $userId); ?> "
                            placeholder="balance">
                    </div>
                    <span id="dashEyeBtn" class="eye-button" onmousedown="showWalletBalance()" onmouseup="hideWalletBalance()"
                        onmouseleave="hideWalletBalance()">
                        👁️
                    </span>
                </div>
            </div>
            <div id="doughnutChartDiv" style="flex; width: 150px; height: 150px;">
                <canvas id="doughnutChart"></canvas>
            </div>
            <div id="chartLegend" class="custom-legend">
                <div class="custom-legend-item">
                    <div class="custom-legend-box"></div>
                    <div>
                        <div class="custom-legend-label"></div>
                        <div class="custom-legend-label"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="d-flex">
        <div id="dashDivTwo" class="card dashDivCard2 align-to-center position-relative"></div>
        <div id="dashDivThree" class="card dashDivCard3 align-to-center position-relative"></div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>


    // Function to fetch and update bank details
    function updateBankDetails() {
        var dashBankSelect = document.getElementById('dashBankSelect');
        var bankAccountId = dashBankSelect.value;

        

        var xhrGetBankDetails = new XMLHttpRequest();
        xhrGetBankDetails.open('POST', 'php/ajaxGetBankDetails.php');
        xhrGetBankDetails.setRequestHeader('Content-Type', 'application/json');
        var dataToSend = JSON.stringify({ bankAccountId: bankAccountId });
        xhrGetBankDetails.send(dataToSend);
        xhrGetBankDetails.onload = function () {
            if (xhrGetBankDetails.status === 200) {
                var response = JSON.parse(xhrGetBankDetails.responseText);

                // Strip the comma and everything after it
                var bankName = response.bankName.split(',')[0];

                document.getElementById('bankName').innerText = bankName;
                document.getElementById('bankAccNo').innerText = response.accountNumber;
                document.getElementById('dashBankBal').value = response.accountBalance;
            }
        }
    }

    // Add event listener to monitor changes in the dashBankSelect dropdown
    document.getElementById('dashBankSelect').addEventListener('change', updateBankDetails);
    // Run the function on page load
    window.onload = updateBankDetails;

    function showWalletBalance() {
        document.getElementById("dashWalletBal").type = "text";
    }

    function hideWalletBalance() {
        document.getElementById("dashWalletBal").type = "password";
    }
    function showBankBalance() {
        document.getElementById("dashBankBal").type = "text";
    }

    function hideBankBalance() {
        document.getElementById("dashBankBal").type = "password";
    }

    function copyToClipboard(elementId) {
        var copyText = document.getElementById(elementId);
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        document.execCommand("copy");

        // Optionally, you can show a tooltip or some feedback to the user
        alert("Copied the text: " + copyText.value);
    }

    // Initialize Chart.js Doughnut Chart
    var ctx = document.getElementById('doughnutChart').getContext('2d');
    var doughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Installment', 'Restaurant', 'Rent', 'Food', 'Investment'],
            datasets: [{
                data: [24, 21, 28, 18, 9],
                backgroundColor: ['#4CAF50', '#FFC107', '#2196F3', '#F44336', '#9C27B0'],
                hoverBackgroundColor: ['#66BB6A', '#FFCA28', '#42A5F5', '#EF5350', '#AB47BC']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Allows you to control the chart dimensions
            // cutoutPercentage: 50, // Adjust this value to control the size of the inner cutout
            cutout: '45%', // Adjust this value to control the size of the inner cutout

            plugins: {
                legend: {
                    display: false,
                    position: 'right', // 'top', 'left', 'bottom', 'right'
                    labels: {
                        fontSize: 12, // Adjust the font size of the labels
                        boxWidth: 25 // Adjust the width of the color box next to each label
                    }
                },
                title: {
                    display: false,
                    text: 'Expense Breakdown',
                    fontSize: 16 // Adjust the title font size
                }
            }
        }
    });

    function generateCustomLegend(chart) {
        const legendContainer = document.getElementById('chartLegend');
        const items = chart.data.labels.map((label, index) => {
            return `
                    <div class="custom-legend-item">
                        <div class="custom-legend-box" style="background-color:${chart.data.datasets[0].backgroundColor[index]}"></div>
                        <div >
                            <div class="custom-legend-label">${label}</div>
                            <div class="custom-legend-label"> ${chart.data.datasets[0].data[index]}%</div>
                        </div>
                    </div>
                `;
        }).join('');
        legendContainer.innerHTML = items;
    }

    generateCustomLegend(doughnutChart);
</script>