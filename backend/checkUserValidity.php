<?php

/**
 * Script for user session validation.
 */

include_once "database.php";
session_start();

/**
 * Validates user session and retrieves user details.
 *
 * Redirects to login if no valid session. Otherwise, returns User object.
 *
 * @return User The user object for the valid session.
 */
function checkUserValidity(): User
{
    if (!isset($_SESSION['guid'])) {
        header("Location: ../../frontend/views/login.php");
        die();
    }

    $user = queryUser($_SESSION['guid']);

    if (empty($user->guid)) {
        header("location:../../frontend/views/login.php");
        die();
    }

    return $user;
}