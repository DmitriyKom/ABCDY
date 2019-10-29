<?php

/* Date         Name            Changes
 * 10/27/2019   Andrey          Coding page
 *
 *
 *
 */
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: login.php");
exit;
?>