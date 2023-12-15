<?php

session_start();

if (!isset($_SESSION['guid'])) {
    header("Location: login.php");
    die();
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

    <h1>Item listed successful</h1>
    <a href="mainPage.php">Main page</a>

</main>


</body>
</html>
