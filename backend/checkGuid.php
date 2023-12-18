<?php

/**
 * Script to check if a user exists based on the provided GUID.
 *
 * This script responds to a POST request with a GUID and checks
 * if a user with that GUID exists in the database.
 */

include_once "database.php";

if (isset($_POST['guid'])) {
    $guid = $_POST['guid'];

    /**
     * Check if the user exists in the database.
     *
     * This function is defined in 'database.php'.
     * It checks the existence of a user by their GUID.
     *
     * @param string $guid The GUID to check for in the database.
     * @return bool Returns true if the user exists, false otherwise.
     */
    if (userExists($guid)) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }
}