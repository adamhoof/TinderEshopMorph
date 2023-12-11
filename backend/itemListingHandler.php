<?php

include_once "checkLength.php";
include_once "database.php";
include_once "item.php";
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
        header("location:login.php");
        die();
    }

    return $user;
}

function processItemListing(): array
{
    $user = validateUser();
    $item = Item::emptyItem();
    $errors = array();

    if (isset($_POST["submit"])) {
        $errors = validateItemNameInput($_POST);
        $item->name = $_POST["sell_item_name"];

        $errors = array_merge($errors, validateItemPriceInput($_POST));
        $item->price = $_POST["sell_item_price"];

        $errors = array_merge($errors, validateItemSelectedCategories($_POST, $item));

        $errors = array_merge($errors, validatePictureInput($_FILES, "sell_item_pic"));;

        if (empty($errors)) {
            $item->seller_id = $user->id;
            $itemId = insertItem($item);

            $itemPictureDir = "../../backend/itemPictures/" . "$itemId" . "/";
            if (!file_exists($itemPictureDir)) {
                mkdir($itemPictureDir, recursive: true);
            }

            $newItemPicPath = $itemPictureDir . "item_picture.gif";
            move_uploaded_file($_FILES["sell_item_pic"]["tmp_name"], $newItemPicPath);

            header("location:itemInsertSuccessful.php");
            die();
        }
    }
    return array('item' => $item, 'errors' => $errors);
}

?>

