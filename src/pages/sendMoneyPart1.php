<?php
include_once 'php/database.php'; // Include the database.php file
include "php/google-auth.php";

// Establish database connection
global $connect_kuberkosh_db;

$userId = $_SESSION['user_id']; // Works only if a user session exists
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Money</title>
    <script src="js/bundle.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <!-- <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" /> -->




    <!-- CDN was used here for the dropdown menu only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script 0src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->



    

</head>

<body>
    <!-- Backgroung Image  Backgroung Image  Backgroung Image  Backgroung Image  Backgroung Image  Backgroung Image   -->
    <img class = "bg-img" src="/img/Background.webp" alt="background image">
