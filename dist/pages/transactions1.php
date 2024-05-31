<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <script src="js/bundle.js"></script>  <!-- // bootstrap is bought in with bundle.js -->
    <link href="css/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Include local Bootstrap Icons CSS -->
    <script src="js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #121212;
            color: #fff;
        }



        .transactions_div {
            height: 500px; /* Set the desired fixed height */
            overflow-y: auto;
            overflow-x: hidden;
            padding: 10px;
            /* border: 1px solid #ddd; Optional: For better visibility of the container */
            /* background-color: #fff; Optional: Set background color */
        }
        
        .transaction-content {
            display: flex;
            flex-direction: column;
            gap: 10px; /* Space between cards */
        }

        .transaction-card {
            border: 1px solid #ddd; /* Optional: For better visibility of each card */
            border-radius: 5px; /* Optional: Rounded corners */
            /* background-color: #f9f9f9; Optional: Set background color for cards */
        }

        .transaction-header {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* background-color: #e9ecef; Optional: Header background color */
            border-bottom: 1px solid #ddd; /* Optional: Border for header */
        }

        .transaction-details {
            padding: 10px;
            /* background-color: #fff; Optional: Details background color */
        }






        .container-div{
            margin-top: 1500px;
        }

        .transaction-card {
            background-color: #1e1e1e00;
            border: none;
            border-radius: 0;
            /* margin-bottom: 1rem; */
            color: #fff;
        }
        .transactions_div_card{
            width: 69rem;
            height: 32rem;
            background-color: #1c1c1c99;
            color: #fff;
            border-radius: 1rem;

        }

        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .transaction-details {
            padding: 1rem;
        }

        .transaction-details p {
            margin: 0;
        }

        .transaction-details .optional {
            color: #b3b3b3;
        }

        .btn-toggle {
            color: #b3b3b3;
            background-color: transparent;
            border: none;
        }

        .btn-toggle:focus {
            box-shadow: none;
        }

        .arrow-btn {
            display: flex;
            align-items: center;
            margin-left: 10px;
            z-index: 1000;
        }

        .arrow-btn i {
            transition: transform 0.3s ease;
            z-index: 1000;

        }

        .arrow-btn.collapsed i {
            transform: rotate(0deg);
        }

        .arrow-btn:not(.collapsed) i {
            transform: rotate(180deg);
        }

        .transaction-info {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .transaction-info div {
            margin-right: 10px;
        }

        .text-end {
            text-align: right;
            margin-right: 10px;
        }

        .scrollable-transactions {
            max-height: 400px;
            overflow-y: auto;
            padding: 1rem;
        }
    </style>
</head>

<body>
    <!-- Backgroung Image  Backgroung Image  Backgroung Image  Backgroung Image  Backgroung Image  Backgroung Image   -->
    <img class = "bg-img" src="/img/Background.webp" alt="background image">

