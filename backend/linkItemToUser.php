<?php

include_once "item.php";
include_once "database.php";

session_start();
$guid = $_SESSION["guid"];
$user_id = queryUser($guid)->id;

$content = file_get_contents('php://input');
$data = json_decode($content, true);

$itemId = $data["itemId"];

linkItemToUser($user_id, $itemId);

echo "done";

?>