<?php

session_start();

if (!isset($_SESSION['guid'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: ../frontend/views/login.php");
    die(); // Make sure to call exit after a redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="../css/global.css">
</head>
<body>

<main>

    <h1>Update successful</h1>
    <a href="mainPage.php">Main page</a>

</main>


</body>
</html>

