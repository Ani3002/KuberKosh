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
        <div class="d-flex">
            <h5 id="wd">Wallet Details</h5>
            <h5 id="sa">Spend Analysis</h5>
        </div>
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
                        <input id="dashBankBal" type="password" class="hiddenBalance" value="" placeholder="balance">
                    </div>
                    <span id="dashEyeBtnBank" class="eye-button" onmousedown="showBankBalance()"
                        onmouseup="hideBankBalance()" onmouseleave="hideBankBalance()">
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
                    <span id="dashEyeBtn" class="eye-button" onmousedown="showWalletBalance()"
                        onmouseup="hideWalletBalance()" onmouseleave="hideWalletBalance()">
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
    <div id="dashDivTwo" class="card dashDivCard2 align-to-center position-relative">
        <div id="a21" class="d-flex gap-1">
            <div>
                <h5 id="ob">Overview Balance</h5>
                <div class="d-flex">
                    <h5 id="dateRange">Last Week:</h5>
                    <span id="dateRangeAmnt">$5000.00</span>
                </div>
            </div>
            <div>
                <select id="dashDateSelect" name="bank_account_id" class="dashLabelContent">
                    <option value="1_week">1 Week</option>
                    <option value="2_weeks">2 Weeks</option>
                    <option value="1_month">1 Month</option>
                    <option value="2_months">2 Months</option>
                    <option value="6_months">6 Months</option>
                </select>
                <div class="d-flex">
                    <h5 id="presentAmnt">$6000.00</h5>
                    <span id="percentageChange">6 %</span>
                </div>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="overviewBalanceChart"></canvas>
        </div>
    </div>



        <div id="dashDivThree" class="card dashDivCard3 align-to-center position-relative">

            <h5 id="recentTransactions">Recent Transactions</h5>
            <div id="cardWrapperDiv">

                <div class="card card2 transaction-card">
                    <div class="card-header transaction-header">
                        <div class="d-flex align-items-center dashTransactions">
                            <img src="<?php //if $transaction['credit']  src= "img/up.svg"    if transaction debit    down.svg ?>"
                                class="rounded-circle me-1" width="35px" height="35px">
                            <div class="d-flex gap-1">
                                <div id="dashTrnxType" class="fw-bold">
                                    Received
                                </div>
                                <span id="dashTrnxTime" class="fw-normal">
                                    16:45
                                </span>
                                <span id="dashTrnxDate" class="fw-normal">
                                    07 May
                                </span>
                                <span id="dashTrnxAmnt" class="fw-normal">
                                    +500.00
                                </span>
                                <span id="dashTrnxStatus" class="fw-normal">
                                    Successful
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to fetch transactions
        function sendAjaxRequest(start, end) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'php/ajaxRenderDashTransactions.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            var dataToSend = JSON.stringify({ startDate: start, endDate: end });
            xhr.send(dataToSend);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    displayTransactions(response.page);
                } else {
                    alert('Error occurred while fetching transactions. Please try again.');
                }
            };
        }



        // Function to display transactions
        function displayTransactions(htmlContent) {
            document.getElementById('cardWrapperDiv').innerHTML = htmlContent;
        }

        // Calculate the date range (1 week)
        function getDateRange() {
            var endDate = new Date();
            var startDate = new Date();
            startDate.setDate(endDate.getDate() - 7);

            var formatDate = date => date.toISOString().split('T')[0];
            return { start: formatDate(startDate), end: formatDate(endDate) };
        }

        // Fetch transactions for the last week
        var dateRange = getDateRange();
        sendAjaxRequest(dateRange.start, dateRange.end);
    });
</script>


<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script>
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

    document.getElementById('sa').addEventListener('click', function () {
        window.location.href = 'https://google.com'; // Replace with your target URL
    });

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
</script>

<script>
        function fetchChartData() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'php/ajaxFetchChartData.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    updateDoughnutChart(response.labels, response.data);
                    generateCustomLegend(doughnutChart);
                }
            };
            xhr.send();
        }

        function updateDoughnutChart(labels, data) {
            doughnutChart.data.labels = labels;
            doughnutChart.data.datasets[0].data = data;
            doughnutChart.update();
        }

        function generateCustomLegend(chart) {
            const legendContainer = document.getElementById('chartLegend');
            const items = chart.data.labels.map((label, index) => {
                return `
                    <div class="custom-legend-item">
                        <div class="custom-legend-box" style="background-color:${chart.data.datasets[0].backgroundColor[index]}"></div>
                        <div>
                            <div class="custom-legend-label">${label}</div>
                            <div class="custom-legend-label"> ${chart.data.datasets[0].data[index]}%</div>
                        </div>
                    </div>
                `;
            }).join('');
            legendContainer.innerHTML = items;
        }

        // Initialize Doughnut Chart
        var ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
        var doughnutChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: [], // Initial empty labels
                datasets: [{
                    data: [], // Initial empty data
                    backgroundColor: ['#4CAF50', '#FFC107', '#2196F3', '#F44336', '#9C27B0', '#849599'],
                    hoverBackgroundColor: ['#66BB6A', '#FFCA28', '#42A5F5', '#EF5350', '#AB47BC', '##97abaf']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '45%',
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false
                    }
                }
            }
        });

        // Fetch chart data and update the chart
        fetchChartData();
    </script>

<script>
const totalValue = 100;
let chartInstance;

function updateChart(dataValues, labels) {
    const fillData = dataValues;
    const backgroundData = dataValues.map(() => totalValue);

    const data = {
        labels: labels,
        datasets: [
            {
                label: 'Filled',
                data: fillData,
                backgroundColor: 'rgba(73, 77, 173, 1)',
                borderColor: 'rgba(73, 77, 173, 1)',
                borderWidth: 0,
                barThickness: 10,
                borderRadius: {
                    topLeft: 10,
                    topRight: 10,
                    bottomLeft: 10,
                    bottomRight: 10
                },
            },
            {
                label: 'Empty',
                data: backgroundData,
                backgroundColor: '#FFFFFF',
                borderColor: '#FFFFFF',
                borderWidth: 0,
                barThickness: 10,
                borderRadius: {
                    topLeft: 10,
                    topRight: 10
                },
            }
        ]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stacked: false,
                    ticks: {
                        color: '#FFF'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0)'
                    }
                },
                x: {
                    stacked: true,
                    ticks: {
                        color: '#FFF'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: false,
                    text: 'Overview Balance',
                    color: '#FFF',
                    font: {
                        size: 20
                    }
                }
            }
        }
    };

    const ctxBar = document.getElementById('overviewBalanceChart').getContext('2d');
    
    if (chartInstance) {
        chartInstance.destroy();
    }
    
    chartInstance = new Chart(ctxBar, config);
}

document.getElementById('dashDateSelect').addEventListener('change', function() {
    const dateRange = this.value;

    var xhrFetchTransactionSummary = new XMLHttpRequest();
    xhrFetchTransactionSummary.open('POST', 'php/ajaxFetchTransactionSummary.php');
    xhrFetchTransactionSummary.setRequestHeader('Content-Type', 'application/json');
    var dataToSend = JSON.stringify({dateRange: dateRange });
    xhrFetchTransactionSummary.send(dataToSend);

    xhrFetchTransactionSummary.onload = function () {
        if (xhrFetchTransactionSummary.status === 200) {
            const response = JSON.parse(xhrFetchTransactionSummary.responseText);
            const {averagePrevious, averageCurrent, percentageChange, dataValues, labels} = response;

            document.getElementById('dateRange').innerText = dateRange;
            document.getElementById('dateRangeAmnt').innerText = `₹${averagePrevious.toFixed(2)}`;
            document.getElementById('presentAmnt').innerText = `₹${averageCurrent.toFixed(2)}`;
            document.getElementById('percentageChange').innerText = `${percentageChange.toFixed(2)} %`;

            updateChart(dataValues, labels);
        } else {
            alert('Failed to fetch data');
        }
    };
});

// Trigger initial load
document.getElementById('dashDateSelect').dispatchEvent(new Event('change'));  
</script>





<!-- <script>










// Initialize Bar Chart


// const totalValue = 100;
// const dataValues = [56, 45, 62, 73, 88, 56, 10, 63, 20, 8, 62, 73, 90];
// const fillData = dataValues;
// const backgroundData = dataValues.map(value => totalValue);

// const data = {
// labels: ['06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18'],
// datasets: [
// {
// label: 'Filled',
// data: fillData,
// backgroundColor: 'rgba(73, 77, 173, 1)',
// borderColor: 'rgba(73, 77, 173, 1)',
// borderWidth: 0,
// barThickness: 10,
// borderRadius: {
// topLeft: 10,
// topRight: 10,
// bottomLeft: 10,
// bottomRight: 10
// },
// },
// {
// label: 'Empty',
// data: backgroundData,
// backgroundColor: '#FFFFFF',
// borderColor: '#FFFFFF',
// borderWidth: 0,
// barThickness: 10,
// borderRadius: {
// topLeft: 10,
// topRight: 10
// },
// }
// ]
// };

// const config = {
// type: 'bar',
// data: data,
// options: {
// scales: {
// y: {
// beginAtZero: true,
// stacked: false,
// ticks: {
// color: '#FFF'
// },
// grid: {
// color: 'rgba(0, 0, 0, 0)'
// }
// },
// x: {
// stacked: true,
// ticks: {
// color: '#FFF'
// },
// grid: {
// display: false
// }
// }
// },
// plugins: {
// legend: {
// display: false
// },
// title: {
// display: false,
// text: 'Overview Balance',
// color: '#FFF',
// font: {
// size: 20
// }
// }
// }
// }
// };

// const ctxBar = document.getElementById('overviewBalanceChart').getContext('2d');
// const overviewBalanceChart = new Chart(ctxBar, config);
</script> -->