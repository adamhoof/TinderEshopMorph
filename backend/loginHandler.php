<?php


/**
 * Handles user login process.
 *
 * This script includes necessary files for user authentication.
 * It contains functions to attempt and process user login.
 */

include_once "checkLength.php";
include_once "database.php";
include_once "user.php";
include_once "inputFieldsValidator.php";

session_start();

/**
 * Attempts to log in with the provided GUID and password.
 *
 * @param string $guid User's GUID.
 * @param string $password User's password.
 * @return array Array of errors or an empty array if login is successful.
 */
function attemptLogin(string $guid, string $password): array
{
    $userProfile = queryUser($guid);
    if (empty($userProfile->guid)) {
        return array("guid" => "User with this GUID does not exist");
    } elseif (!password_verify($password, $userProfile->password)) {
        return array("password" => "Password is incorrect");
    }
    return array();
}

/**
 * Processes the login request.
 *
 * Validates input, attempts to log in, and sets session variables upon success.
 * Redirects to main page if login is successful, returns errors otherwise.
 *
 * @return array Array containing the user object and any validation errors.
 */
function processLogin() : array {
    $user = User::emptyUser();
    $errors = array();

    if (isset($_POST["submit"])) {
        $user->guid = $_POST["guid"];

        $errors = validateGuidAndPasswordInput($_POST);

        if (empty($errors)) {
            $user->password = $_POST["password"];
            $errors = attemptLogin($user->guid, $user->password);
            if (empty($errors)) {
                $_SESSION["guid"] = $user->guid;
                header("location:../../frontend/views/mainPage.php");
                exit();
            }
        }
    }

    return array('user' => $user, 'errors' => $errors);
}