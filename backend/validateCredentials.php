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

function validateGuidAndPasswordInput($input): array
{
    $errors = array();

    if (!isset($input["guid"])) {
        $errors["guid"] = "GUID is required field";
    } elseif (!inputLengthValid($input["guid"])) {
        $errors["guid"] = "GUID must be between 3 and 255 characters long";
    }

    if (!isset($input["password"])) {
        $errors["password"] = "Password is required field";
    } elseif (!inputLengthValid($input["password"])) {
        $errors["password"] = "Password must be between 3 and 255 characters long";
    }

    return $errors;
}

function validatePasswords($input) : array{
    $errors = array();

    if (!isset($input["password_verify"])) {
        $errors["password_verify"] = "Password verify is required field";
    } elseif (!inputLengthValid($input["password_verify"])) {
        $errors["password_verify"] = "Password verify must be between 3 and 255 characters long";
    }

    if ($input["password"] !== $input["password_verify"]) {
        $errors["password_match"] = "Passwords do not match";
    }

    return $errors;
}
