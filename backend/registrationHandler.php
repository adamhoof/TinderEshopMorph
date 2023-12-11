<?php

include_once "checkLength.php";
include_once "database.php";
include_once "inputFieldsValidator.php";
include_once "user.php";
function processRegistration(): array
{
    $user = User::emptyUser();
    $errors = array();

    if (isset($_POST["submit"])) {
        $user->guid = $_POST["guid"];
        $user->password = $_POST["password"];

        $errors = array_merge(
            validateGuidAndPasswordInput($_POST),
            validatePasswordsInput($_POST),
            validatePictureInput($_FILES, "profile_pic"));

        if (userExists($user->guid)) {
            $errors["guid"] = "User with this GUID already exists";
        }

        if (empty($errors)) {
            $userId = registerUser($user);
            $userDir = "../../backend/userPictures/" . $userId . "/";
            if (!file_exists($userDir)) {
                mkdir($userDir, recursive: true);
            }
            $profilePicturePath = $userDir . "profile_picture.gif";
            move_uploaded_file($_FILES['profile_pic']['tmp_name'], $profilePicturePath);
            header("location:../../frontend/views/registrationSuccessful.php");
            die();
        }
    }
    return array('user' => $user, 'errors' => $errors);
}