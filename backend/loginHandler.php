<?php
include_once "checkLength.php";
include_once "database.php";
include_once "user.php";
include_once "inputFieldsVaidator.php";

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
?>
