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