<?php

include_once "../../backend/checkUserValidity.php";
include_once "../../backend/paginationHandler.php";

$user = checkUserValidity();
$pageCount = getPageCount($user, 5);
$requestedPage = $_GET["page"] ?? 1;
if (!is_numeric($requestedPage) || $requestedPage < 1 || $requestedPage > $pageCount) {
    $requestedPage = 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/transactionHistory.css">
    <link rel="stylesheet" href="../css/topNav.css">
    <title>Transaction history</title>
</head>
<body>

<nav class="top_nav">
    <a href="mainPage.php">Home</a>
    <a href="sell.php">Sell</a>
    <a href="userInformation.php">User info</a>
    <a href="logout.php">Logout</a>
</nav>

<main>

    <div class="purchase_details">

        <table>

            <thead>
            <tr>
                <th>Name</th>
                <th>Seller ID</th>
                <th>Price</th>
                <th>Date</th>
            </tr>
            </thead>

            <tbody>
            <?php
            generatePaginatedData($user, $requestedPage);
            ?>
            </tbody>

        </table>

    </div>

    <form action="transactionHistory.php" method="get">
        <?php
        generatePagination($pageCount, $requestedPage);
        ?>
    </form>
</main>

</body>
</html>