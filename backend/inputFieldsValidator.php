<?php

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

function validatePasswordsInput($input): array
{
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

function validatePictureInput($input, $pictureFieldName): array
{
    $errors = array();
    $maxPictureSize = 3000000;

    if (!isset($input[$pictureFieldName])) {
        $errors[$pictureFieldName] = "Picture is required field";
    } elseif ($input[$pictureFieldName]["size"] > $maxPictureSize) {
        $errors[$pictureFieldName] = "Picture must be smaller than" . $maxPictureSize / 1000000 . "MB";
    }

    if ($input[$pictureFieldName]["error"] == UPLOAD_ERR_NO_FILE) {
        $errors[$pictureFieldName] = "Picture is required";
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($finfo, $input[$pictureFieldName]['tmp_name']);

        $allowedTypes = ["image/png", "image/jpeg", "image/gif", "image/jpg"];
        if (!in_array($fileType, $allowedTypes)) {
            $errors[$pictureFieldName] = "Picture must be of type png, jpeg, gif or jpg";
        }
    }

    return $errors;
}
