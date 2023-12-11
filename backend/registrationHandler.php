<?php

if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Get outa here</title>';
    echo '</head>';
    echo '<body>';
    echo '<h1>403 - Access forbidden</h1>';
    echo '</body>';
    echo '</html>';
    die();
};

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
            $userDir = "../../backend/user_pictures/" . $userId . "/";
            if (!file_exists($userDir)) {
                mkdir($userDir, recursive: true);
            }
            $profilePicturePath = $userDir . "profile_picture.gif";
            move_uploaded_file($_FILES['profile_pic']['tmp_name'], $profilePicturePath);
            error_log("fuck");
            header("location:registrationSuccessful.php");
            die();
        }
    }
    return array('user' => $user, 'errors' => $errors);
}