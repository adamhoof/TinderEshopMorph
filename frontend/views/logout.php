<?php

session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page or home page after logging out
header("location: login.php");
exit;

