<?php

include_once "database.php";

if (isset($_POST['guid'])) {
    $guid = $_POST['guid'];

    if (userExists($guid)) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }
}