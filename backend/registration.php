<?php
if (isset($_POST["login"])) {
    echo "cock";
}

/*if (!isset($_POST["submit"])) {
    echo "Not a post method";
}*/


$guid = isset($_POST["guid"]) ? $_POST["guid"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$password_verify = isset($_POST["password_verify"]) ? $_POST["password_verify"] : "";

if (empty($guid) || empty($password) || empty($password_verify)) {
    echo "Form data is missing";
    exit();
}

if ($password != $password_verify) {
    echo "Passwords do not match";
    exit();
}
echo "Hashing password <br>";

$password_hash = password_hash($password, PASSWORD_DEFAULT);

echo "Password hashed";

$conn = new mysqli("localhost", "myuser", "mypassword", "mydatabase", "3306");
if ($conn->connect_error) {
    echo "FUCKBASE";
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

$stmt = $conn->prepare("INSERT INTO users (guid, password_hash) VALUES (?, ?)");
$stmt->bind_param("ss", $guid, $password_hash);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
