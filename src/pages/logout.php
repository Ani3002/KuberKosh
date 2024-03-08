<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h5>Session ID: <?php echo session_id(); ?></h5>    
</body>
</html>

<?php
session_start();

echo "Logout page";
// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired page
header("Location: index.php?home");
exit();
?>
