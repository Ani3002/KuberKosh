<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <script src="js/bundle.js"></script> <!-- // bootstrap is bought in with bundle.js -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="moment.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <style>
        .tab-card {
            margin: 20px;
        }

        .tab {
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .tab button {
            background-color: #f1f1f1;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 5px 18px;
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
            padding: 20px;
            border-top: none;
        }

        .tabcontent.active {
            display: block;
        }

        .modal-content {
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.500);
            backdrop-filter: blur(10px);
            border: 5px solid rgba(0, 0, 0, 0.600);
        }

        .modal-header {
            background: rgba(0, 0, 0, 0.500);

            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            color: white;
        }

        .modal-body {
            background: rgba(0, 0, 0, 0.500);

            color: white;
        }

        .modal-footer {
            background: rgba(0, 0, 0, 0.500);

            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;

        }

    .trash-icon {
        filter: invert(22%) sepia(99%) saturate(6158%) hue-rotate(353deg) brightness(96%) contrast(108%);
        transition: filter 0.3s;
    }

    .btn-outline-danger:hover .trash-icon {
        filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(235deg) brightness(100%) contrast(101%);
    }







        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #1c1c1c;
            border-radius: 8px;
        }
        .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-group label {
            flex: 1;
        }
        .form-group input {
            flex: 2;
            padding: 5px;
            background-color: #2a2a2a;
            border: none;
            color: white;
            border-radius: 4px;
        }
        .form-group .edit-link {
            color: #00bcd4;
            text-decoration: none;
        }
        .form-group .edit-link:hover {
            text-decoration: underline;
        }


    </style>
</head>

<body>
    <!-- Backgroung Image  Backgroung Image  Backgroung Image  Backgroung Image  Backgroung Image  Backgroung Image   -->
    <img class="bg-img" src="/img/Background.webp" alt="background image">