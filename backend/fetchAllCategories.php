<?php

include_once "database.php";
include_once "item.php";

$categories = fetchAllCategories();

echo json_encode($categories);