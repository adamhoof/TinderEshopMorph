<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wantit</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/mainPage.css">
    <link rel="stylesheet" href="../css/topNav.css">
    <script src="../js/mainPage.js"></script>
</head>
<body>
<nav class="top_nav">
    <a href="sell.php">Sell</a>
    <a href="userInformation.php">User info</a>
    <a href="transactionHistory.php">Transaction history</a>
    <?php
    if (isset($_SESSION["guid"])) {
        echo '<a href="logout.php">Logout</a>';
    } else {
        echo '<a href="login.php">Login</a>';
    }
    ?>
</nav>

<main>

    <div class="item_details">

        <div id="item_name" class="item_detail title"></div>

        <div id="print_image_placeholder">Image placeholder</div>
        <div id="item_image" class="item_detail">
            <img id="item_img" src="bord4.png" alt="Item image">
        </div>

        <div id="item_price" class="item_detail"></div>

        <div id="item_seller" class="item_detail"></div>

        <div id="item_category" class="item_detail"></div>

        <div class="buttons">
            <button id="buy_item_button">Buy</button>

            <button id="next_item_button">Next</button>
        </div>

    </div>

</main>

</body>
</html>
