<?php

include_once "database.php";
function checkUserValidity(): User
{
    session_start();
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
