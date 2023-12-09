<?php

include_once "database.php";
include_once "Item.php";

$categories = fetchAllCategories();

echo json_encode($categories);

?>
