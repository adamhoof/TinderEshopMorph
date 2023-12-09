<?php
include_once "checkLength.php";
include_once "database.php";
include_once "user.php";
include_once "validateCredentials.php";

session_start();
function attemptLogin($guid, $password): array
{
    $userProfile = queryUser($guid);
    if (empty($userProfile->guid)) {
        return array("guid" => "User with this GUID does not exist");
    } elseif (!password_verify($password, $userProfile->password)) {
        return array("password" => "Password is incorrect");
    }
    return array();
}

function processLogin() {
    $user = User::emptyUser();
    $errors = array();

    if (isset($_POST["submit"])) {
        $user->guid = $_POST["guid"];

        $errors = validateBasicCredentials($_POST);

        if (empty($errors)) {
            $user->password = $_POST["password"];
            $errors = attemptLogin($user->guid, $user->password);
            if (empty($errors)) {
                $_SESSION["guid"] = $user->guid;
                header("location:../../frontend/views/main_page.php");
                exit();
            }
        }
    }

    return array('user' => $user, 'errors' => $errors);
}
?>
