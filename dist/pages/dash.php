<?php //include "php/google-auth.php"?>
<?php
// Check if the user ID is not set in the session
// if (!isset($_SESSION['user_id'])) {
//     // Redirect the user to the login page using JavaScript
//     echo "
//     <script type='text/javascript'>
//         window.location.href = 'index.php?login';
//     </script>
//     ";
//     exit; // Stop further execution of the script
// }



?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login with Google in PHP</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport' />
    <script src="js/bundle.js"></script>
    <script src="js/charts.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" /> -->

    <style>
        .chart-container {
            width: 420px;
            /* 80% */
            /* margin: 0 auto; */
        }

        #wd {
            margin-top: 20px;
            margin-left: 20px;
            width: 10.25rem;
            color: var(--background-mode, #FFF);
            font-family: Inter;
            font-size: 1.25rem;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        #sa {
            margin-top: 20px;
            margin-left: 470px;
            width: 13.25rem;
            color: white;
            /* Change text color to purple */
            font-family: Inter, sans-serif;
            font-size: 1.25rem;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            cursor: pointer;
            /* Indicate that the element is clickable */
        }

        #sa:hover {
            color: rgb(131, 70, 197);

        }

        #nameLabel,
        #bankNameLabel {
            margin: 20 0 0 20px;
        }

        #dashUserName,
        #bankName {
            margin: 10 0 0 20px;
        }

        #walletAddressLabel,
        #bankAccNoLabel {
            margin: 50 0 0 20px;
        }

        #dashWalletAddress,
        #bankAccNo {
            margin: 10 0 0 20px;
        }

        #dashBankSelectDiv {
            width: 50px;

        }

        #dashCheckBal {
            margin: 15 0 0 10px;
        }

        .hiddenBalance {
            appearance: none;
            background: transparent;
            border: 0;

            display: block;
            font-size: 1.2rem;
            outline: 0;
            padding: 0 0 0 0;



            color: var(--background-mode, #FFF);
            font-family: Inter;
            font-size: 0.9375rem;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        #dashCheckBankBal {
            margin: 8 0 0 10px;
        }

        #dashWalletBal,
        #dashBankBal {
            margin: 10 0 0 10px;

        }

        #dashEyeBtn,
        #dashEyeBtnBank {
            margin: 8 0 0 -110px;
        }

        #dashBankSelect {
            margin: 12 50 0 5px;
            /* Styles for the collapsed dropdown */
            height: 30px;
            width: 235px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.10);
            padding: 0 5 0 5px;
            color: #fff;
            /* Text color for the collapsed dropdown */
        }


        #dashBankSelect option {
            /* Styles for the expanded dropdown options */
            background-color: rgba(255, 255, 255, 0.05);
            color: #000000;
            /* Text color for the expanded dropdown options */
        }

        #bankSelect {
            width: 16.25rem;
            height: 1.25rem;
        }

        #bankBalanceLabel {
            margin: 6 0 0 10px;
        }

        .label {
            width: 10.25rem;
            color: #878787;
            font-family: Inter;
            font-size: 0.875rem;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .dashLabelContent {
            width: 11.25rem;
            color: var(--background-mode, #FFF);
            font-family: Inter;
            font-size: 0.875rem;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        #doughnutChartDiv {
            margin: 10 0 0 200px;
        }

        .custom-legend {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            color: white;
        }

        .custom-legend-item {
            width: 35%;
            display: flex;
            align-items: center;
            margin: 5px;
        }

        .custom-legend-box {
            width: 12px;
            height: 12px;
            margin-right: 5px;
        }

        .custom-legend-label {
            font-size: 12px;
        }



        #a21 {
            margin: 10 0 5 5px;

        }

        #ob {
            /* margin: 10 0 10 -130px; */
            width: 14.65044rem;
            height: 1.5rem;
            color: var(--background-mode, #FFF);
            font-family: Poppins;
            font-size: 1.25rem;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        #dashDateSelect {
            margin: 0 0 0 75px;
            /* Styles for the collapsed dropdown */
            /* height: 30px; */
            width: 100px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.10);
            padding: 0 5 0 5px;
            color: #fff;
            /* Text color for the collapsed dropdown */
        }

        #dateRange {
            color: var(--background-mode, #FFF);
            font-family: Poppins;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        #dateRangeAmnt {
            margin: 0 0 0 5px;
            color: var(--background-mode, #37D159);
            font-family: Poppins;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        #presentAmnt {
            margin: 0 0 0 30px;
            /* width: 143.249px; */
            /* height: 36px; */
            flex-shrink: 0;
            color: var(--background-mode, #FFF);
            font-family: Poppins;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            /* line-height: normal; */
        }

        #percentageChange {
            margin: 2 0 0 10px;
            color: #37D159;
            font-family: Poppins;
            font-size: 15px;
            font-style: normal;
            font-weight: 400;
            /* line-height: normal; */
        }

        #recentTransactions {
            margin: 5 0 5 0px;

            #color: var(--background-mode, #FFF);
            font-family: Poppins;
            font-size: 20px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        #dashTrnxType {
            margin: 0 0 0 0px;
        }

        .card2 {
            /* margin: auto; */
            color: #FFF;
            border-radius: 1rem;
            background: #1c1c1c00;
            backdrop-filter: blur(10px);
            flex-shrink: 0;
        }

        #cardWrapperDiv {
            overflow-y: auto;

            /* margin: 30 0 0 0px; */
        }

        #overviewBalanceChart {}
    </style>
</head>

<body>
    <!-- Background Image -->
    <img class="bg-img" src="/img/Background.webp" alt="background image">