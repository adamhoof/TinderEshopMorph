<?php

include_once "checkLength.php";
include_once "database.php";
include_once "user.php";
include_once "inputFieldsValidator.php";

function validateUser(): User
{
    session_start();
    if (!isset($_SESSION['guid'])) {
        header("Location: login.php");
        die();
    }

    $user = queryUser($_SESSION['guid']);

    if (empty($user->guid)) {
        header("location:../../frontend/views/login.php");
        die();
    }

    return $user;
}

function processUserInformationUpdate(): array
{
    $user = validateUser();
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
                mkdir($userDir, recursive: true);
            }

            $profilePicturePath = $userDir . "profile_picture.gif";
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicturePath);

            header("location:../../frontend/views/userInformationUpdateSuccessful.php");
            die();
        }
    }
    return array('user' => $user, 'errors' => $errors);
}
