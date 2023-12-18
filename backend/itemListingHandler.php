<?php

/**
 * Handles the item listing process.
 *
 * This script includes necessary files for item validation and listing.
 * It defines a function to process the listing of an item, including validation
 * and saving item details.
 */

include_once "checkLength.php";
include_once "database.php";
include_once "item.php";
include_once "user.php";
include_once "inputFieldsValidator.php";
include_once "checkUserValidity.php";

/**
 * Processes the listing of an item.
 *
 * Validates item details from POST request, saves the item if valid, and returns
 * the item and any validation errors.
 *
 * @return array Array containing the item and any validation errors.
 */
function processItemListing(): array
{
    $user = checkUserValidity();
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
                mkdir($itemPictureDir, 0777, true);
            }

            $newItemPicPath = $itemPictureDir . "item_picture.gif";
            move_uploaded_file($_FILES["sell_item_pic"]["tmp_name"], $newItemPicPath);

            header("location:itemInsertSuccessful.php");
            die();
        }
    }
    return array('item' => $item, 'errors' => $errors);
}