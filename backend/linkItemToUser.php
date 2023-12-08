<?php

include_once "Item.php";
include_once "database.php";

session_start();
$guid = $_SESSION["guid"];

$content = file_get_contents('php://input');
$data = json_decode($content, true);

$itemId = $data["itemId"];

linkItemToUser($guid, $itemId);

?>