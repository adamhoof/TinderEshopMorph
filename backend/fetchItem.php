<?php

include_once "item.php";
include_once "database.php";

$buyer_guid = $_SESSION['guid'] ?? null;
$buyerId = queryUser($buyer_guid)->id;

$item = Item::emptyItem();
$item = fetchItem($buyerId, $buyerId != -1);

echo json_encode($item);

?>
