<?php

include_once "item.php";
include_once "database.php";
include_once "checkUserValidity.php";

$user = checkUserValidity();

$item = Item::emptyItem();
$item = fetchItem($user->id, $user->id != -1);

echo json_encode($item);