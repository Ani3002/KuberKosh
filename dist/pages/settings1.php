<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <script src="js/bundle.js"></script>  <!-- // bootstrap is bought in with bundle.js -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">


    <style>
        .content {
            /* margin: auto; */
            margin-top: 100px;
            margin-left: 250px;
            position: relative;
            z-index: 10; /* Content should be above the background image */
            padding: 20px;
        }
        .tab {
            overflow: hidden;
            background-color: #f1f1f1;
        }
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }
        .tab button:hover {
            background-color: #ddd;
        }

        .tab button.active {
            background-color: #ccc;
        }

        .tabcontent {
            display: none;
            padding: 6px 12px;
            border-top: none;
        }
    </style>
</head>

<body>
    <!-- Backgroung Image  Backgroung Image  Backgroung Image  Backgroung Image  Backgroung Image  Backgroung Image   -->
    <img class = "bg-img" src="/img/Background.webp" alt="background image">

