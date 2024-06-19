<?php
// Start the session (if not already started)
session_start();

// Check if the user is logged in
if (isset($_SESSION["a_id"])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page or any other desired page
    header("location: 11.4_alumni_login.html"); // Replace with the URL of your login page
    exit();
} else {
    // Redirect the user to the login page if they are not logged in
    header("location: 11.4_alumni_login.html"); // Replace with the URL of your login page
    exit();
}
?>
