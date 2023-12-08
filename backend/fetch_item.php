<?php

include_once "Item.php";
include_once "database.php";

session_start();
if (!isset($_SESSION['guid'])) {
    header("Location: login.php");
    die();
}

$buyer_guid = $_SESSION['guid'];

$item = Item::emptyItem();
$item = fetchItem($buyer_guid);

echo json_encode($item);

?>
