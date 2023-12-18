<?php

/**
 * Links an item to a user in database - creates connection between users and items to simulate user bought items.
 *
 * This script retrieves the user's ID based on their GUID from the session,
 * reads the item ID from the incoming JSON payload, and links the item to the user.
 */

include_once "item.php";
include_once "database.php";

session_start();
$guid = $_SESSION["guid"];

/**
 * Retrieves the user ID based on GUID.
 */
$user_id = queryUser($guid)->id;

/**
 * Decodes the incoming JSON data to get the item ID.
 */
$content = file_get_contents('php://input');
$data = json_decode($content, true);

$itemId = $data["itemId"];

/**
 * Links the item to the user in the database.
 */
linkItemToUser($user_id, $itemId);

echo "done";
