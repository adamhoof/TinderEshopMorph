<?php

function userAlreadyExists($guid) : bool
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
function registerUser($guid, $password): void
{
    $conn = new mysqli("localhost", "myuser", "mypassword", "mydatabase", "3306");
    if ($conn->connect_error) {
        echo "FUCKBASE";
        die("Connection failed: " . $conn->connect_error);
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $picUrl = "d";
    $stmt = $conn->prepare("INSERT INTO users (guid, password, picture_picture_url) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $guid, $password_hash, $picUrl);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
