<?php

/**
 * Handles the user information update process.
 *
 * This script includes necessary files for input validation and user information updating.
 * It defines a function to process updates to user information, including validation,
 * saving updated user details, and handling profile picture updates.
 */

include_once "checkLength.php";
include_once "database.php";
include_once "user.php";
include_once "inputFieldsValidator.php";
include_once "checkUserValidity.php";

/**
 * Processes the user information update form submission.
 *
 * Validates input data, updates the user's information if validation passes,
 * uploads the new profile picture, and redirects to a success page.
 * Returns an array with user data and any validation errors.
 *
 * @return array Array containing the user object and any validation errors.
 */

function processUserInformationUpdate(): array
{
    $user = checkUserValidity();
    $updatedUser = User::emptyUser();
    $errors = array();

    if (isset($_POST["submit"])) {
        $updatedUser->guid = $_POST["guid"];
        $updatedUser->password = $_POST["password"];

        $errors = array_merge(validateGuidAndPasswordInput($_POST), validatePictureInput($_FILES, "profile_picture"));

        $potentiallyExistingUser = queryUser($updatedUser->guid);
        if (!empty($potentiallyExistingUser->guid) && $potentiallyExistingUser->guid !== $user->guid) {
            $errors["guid"] = "User with this GUID already exists";
        }

        if (empty($errors)) {
            updateUser($user->guid, $updatedUser);
            $_SESSION["guid"] = $updatedUser->guid;
            $userDir = "../../backend/userPictures/" . $user->id. "/";
            if (!file_exists($userDir)) {
                mkdir($userDir, 0777, true);
            }

            $profilePicturePath = $userDir . "profile_picture.gif";
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicturePath);

            header("location:../../frontend/views/userInformationUpdateSuccessful.php");
            die();
        }
    }
    return array('user' => $user, 'errors' => $errors);
}