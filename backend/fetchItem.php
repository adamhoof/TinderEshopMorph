<?php

/**
 * Fetches an item based on the buyer's GUID.
 *
 * This script fetches an item for the buyer identified by the GUID stored in the session.
 * If the buyer's GUID is not found, it fetches an item without user-based conditions.
 * The fetched item is then output as a JSON object.
 */

include_once "item.php";
include_once "database.php";
include_once "checkUserValidity.php";

$buyer_guid = $_SESSION['guid'] ?? -1;

error_log("buyer_guid: " . $buyer_guid);
if ($buyer_guid == -1) {
    echo json_encode(fetchItem($buyer_guid, false));
    die();
}
$user = queryUser($buyer_guid);

echo json_encode(fetchItem($user->id, true));
die();