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
if (!isset($_SESSION['guid'])) {
    header("Location: login.php");
    die();
}

$buyer_guid = $_SESSION['guid'];
$buyerId = queryUser($buyer_guid)->id;

$item = Item::emptyItem();
$item = fetchItem($buyerId);

echo json_encode($item);

?>
