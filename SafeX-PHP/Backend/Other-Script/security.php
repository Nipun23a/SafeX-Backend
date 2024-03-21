<?php


// Check if the user is not logged in or doesn't have the required role
if (!isset($_SESSION["user_role"])) {
    header("Location: login.php"); // Redirect to login page
}


?>