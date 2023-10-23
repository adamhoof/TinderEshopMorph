<?php
// Retrieve form data
$name = $_POST['name'];
$guid = $_POST["guid"];
$password = $_POST['password'];
$address = $_POST['address'];
$payment_card_number = $_POST['payment_card_number'];

// Hash the password for storage
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$conn = new mysqli("localhost", "myuser", "mypassword", "mydatabase");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO users (name, guid, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $surname, $email, $hashed_password);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
