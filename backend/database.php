
<?php
include_once "user.php";
include_once "Item.php";
function userExists($guid): bool
{
    $conn = new mysqli("localhost", "myuser", "mypassword", "mydatabase", "3306");
    if ($conn->connect_error) {
        //TODO: notify user?
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT guid FROM users WHERE guid = ?");
    $stmt->bind_param("s", $guid);

    $stmt->execute();

    $stmt->store_result();

    $userExists = $stmt->num_rows > 0;

    $stmt->close();
    $conn->close();

    return $userExists;
}

function queryUser($guid): User
{
    $conn = new mysqli("localhost", "myuser", "mypassword", "mydatabase", "3306");
    if ($conn->connect_error) {
        //TODO: notify user?
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT guid, password, picture_picture_url FROM users WHERE guid = ?");
    $stmt->bind_param("s", $guid);

    $stmt->execute();

    $user = User::emptyUser();
    $stmt->bind_result($user->guid, $user->password, $user->pictureUrl);

    if ($stmt->fetch()) {
        // User found, return the User object
        $stmt->close();
        $conn->close();
        return $user;
    } else {
        // No user found
        $stmt->close();
        $conn->close();
        return User::emptyUser();
    }
}

function registerUser(User $user): void
{
    $conn = new mysqli("localhost", "myuser", "mypassword", "mydatabase", "3306");
    if ($conn->connect_error) {
        echo "FUCKBASE";
        die("Connection failed: " . $conn->connect_error);
    }

    $password_hash = password_hash($user->password, PASSWORD_DEFAULT);
    $picUrl = "d";
    $user->pictureUrl = $picUrl;
    $stmt = $conn->prepare("INSERT INTO users (guid, password, picture_picture_url) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user->guid, $password_hash, $user->pictureUrl);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function updateUser($currentGuid, User $user): void
{
    $conn = new mysqli("localhost", "myuser", "mypassword", "mydatabase", "3306");
    if ($conn->connect_error) {
        echo "FUCKBASE";
        die("Connection failed: " . $conn->connect_error);
    }

    $passwordHash = password_hash($user->password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET guid = ?, password = ?, picture_picture_url = ? WHERE guid = ?");
    $stmt->bind_param("ssss", $user->guid, $passwordHash, $user->pictureUrl, $currentGuid);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

function categoryExists($category): bool
{
    $conn = new mysqli("localhost", "myuser", "mypassword", "mydatabase", "3306");
    if ($conn->connect_error) {
        echo "FUCKBASE";
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT category_id FROM categories WHERE name = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();

    $stmt->store_result();

    $categoryExists = $stmt->num_rows > 0;

    $stmt->close();
    $conn->close();

    return $categoryExists;
}

function insertItem(Item $item): int
{
    $conn = new mysqli("localhost", "myuser", "mypassword", "mydatabase", "3306");
    if ($conn->connect_error) {
        error_log("Failed cock");
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO items (name, price, seller_guid) VALUES (?,?,?)");
    $stmt->bind_param("sds", $item->name, $item->price, $item->seller_guid);
    $stmt->execute();
    $itemId = $stmt->insert_id;
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO item_categories (item_id, category_name) VALUES (?, ?)");
    foreach ($item->categories as $categoryName) {
        $stmt->bind_param("is", $itemId, $categoryName);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    return $itemId;
}

function fetchItem($buyerGUID): ?Item
{
    $conn = new mysqli("localhost", "myuser", "mypassword", "mydatabase", "3306");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("
    SELECT items.* FROM items
    LEFT JOIN user_bought_items ON items.item_id = user_bought_items.item_id
    WHERE seller_guid != ? AND user_bought_items.item_id IS NULL
    ORDER BY RAND()
    LIMIT 1
");

    // Bind parameters and execute
    $stmt->bind_param("s", $buyerGUID);
    if ($stmt->execute() === false) {
        die("Failed to execute statement: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $item = Item::emptyItem();

    if ($row === null) {
        return null;
    }

    $item->itemId = $row["item_id"];
    $item->name = $row["name"];
    $item->price = $row["price"];
    $item->seller_guid = $row["seller_guid"];

    $stmt = $conn->prepare("SELECT category_name FROM item_categories WHERE item_id = ?");
    $stmt->bind_param("i", $item->itemId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        array_push($item->categories, $row["category_name"]);
    }
/*    error_log(var_export($item, true));*/
    $stmt->close();
    $conn->close();

    return $item;
}

function linkItemToUser($guid, $itemId): void
{
    $conn = new mysqli("localhost", "myuser", "mypassword", "mydatabase", "3306");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO user_bought_items (user_guid, item_id, date_of_purchase) VALUES (?, ?, NOW())");

    $stmt->bind_param("si", $guid, $itemId);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
