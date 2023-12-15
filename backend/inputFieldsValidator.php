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
    } else if ($input[$pictureFieldName]["error"] == UPLOAD_ERR_NO_FILE) {
        $errors[$pictureFieldName] = "Picture is required";
    } elseif ($input[$pictureFieldName]["size"] > $maxPictureSize) {
        $errors[$pictureFieldName] = "Picture must be smaller than " . $maxPictureSize / 1000000 . "MB";
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($finfo, $input[$pictureFieldName]['tmp_name']);

        $allowedTypes = ["image/png", "image/jpeg", "image/gif", "image/jpg"];
        if (!in_array($fileType, $allowedTypes)) {
            $errors[$pictureFieldName] = "Picture must be a png, jpeg, gif or jpg";
        }
        finfo_close($finfo);
    }

    return $errors;
}

function validateItemNameInput($input): array
{
    $errors = array();

    if (!isset($input["sell_item_name"])) {
        $errors["sell_item_name"] = "Name is required field";
    } elseif (!inputLengthValid($input["sell_item_name"])) {
        $errors["sell_item_name"] = "Name must be between 3 and 255 characters long";
    }

    return $errors;
}

function validateItemPriceInput($input): array
{
    $errors = array();

    if (!isset($input["sell_item_price"])) {
        $errors["sell_item_price"] = "Price is required field";
    } elseif (!is_numeric($input["sell_item_price"])) {
        $errors["sell_item_price"] = "Price must be a number";
    } else if (floatval($input["sell_item_price"]) < 0 || floatval($input["sell_item_price"]) > PHP_INT_MAX) {
        $errors["sell_item_price"] = "Price must be within range 0 - " . PHP_INT_MAX;
    }
    return $errors;
}

function validateItemSelectedCategories($input, $item): array
{
    $errors = array();

    if (!isset($input["selected_categories"])) {
        $errors["selected_categories"] = "Categories are required field";
    }

    if (empty($input["selected_categories"]) || !is_array($input["selected_categories"]) || count($input["selected_categories"]) > 4) {
        $errors["sell_item_categories"] = "You must choose between 1 and 4 categories";
    } else {
        $item->categories = $input["selected_categories"];
        foreach ($item->categories as $category) {
            if (!inputLengthValid($category, 5, 20) || !categoryExists($category)) {
                $errors["sell_item_categories"] = "$category is invalid category";
            }
        }
    }
    return $errors;
}