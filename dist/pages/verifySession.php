<?php
// Check if the user ID is not set in the session
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: index.php?login");
    exit; // Stop further execution of the script
}
?>