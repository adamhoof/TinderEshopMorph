<?php
include_once "user.php";
include_once "item.php";
function userExists($guid) : bool
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

function queryUser($guid) : User {
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

function updateUser($currentGuid, User $user):void {
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

function categoryExists($category) : bool{
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

function insertItem(Item $item): void
{
    $conn = new mysqli("localhost", "myuser", "mypassword", "mydatabase", "3306");
    if ($conn->connect_error) {
        error_log("Failed cock");
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO items (name, price, seller_guid, item_picture_url) VALUES (?,?,?,?)");
    $stmt->bind_param("sdss", $item->name, $item->price, $item->seller_guid, $item->picUrl);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
