<?php

/**
 * Fetches all categories and outputs them as a JSON array.
 *
 * This script includes the necessary files for database operations
 * and invokes the function fetchAllCategories to retrieve all categories.
 * The result is then encoded into JSON format and output.
 */

include_once "database.php";
include_once "item.php";

$categories = fetchAllCategories();

echo json_encode($categories);