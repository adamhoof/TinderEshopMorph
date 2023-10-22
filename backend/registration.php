<?php
// Retrieve form data
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];
// ... and other form fields

// Hash the password for storage
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
?>
