<?php

include_once "../../backend/itemListingHandler.php";

$result = processItemListing();
$item = $result["item"];
$errors = $result["errors"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sell Item</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/sell.css">
    <link rel="stylesheet" href="../css/topNav.css">
    <script src="../js/sell.js"></script>
</head>
<body>

<nav class="top_nav">
    <a href="mainPage.php">Home</a>
    <a href="userInformation.php">User info</a>
    <a href="transactionHistory.php">Transaction history</a>
    <a href="logout.php">Logout</a>
</nav>

<main>

    <div class="title">Sell your item!</div>
    <form method="post" action="sell.php" id="sell_form" enctype="multipart/form-data">

        <div class="item_details">

            <div class="input_box">
                <label for="item_name">Name</label>
                <input type="text" name="sell_item_name" id="item_name" tabindex="1" autofocus
                       value="<?php echo htmlspecialchars($item->name); ?>">
                <?php if (isset($errors["sell_item_name"])) {
                    echo "<p class = 'error'> " . htmlspecialchars($errors["sell_item_name"]) . "</p>";
                } ?>
            </div>

            <div class="input_box">
                <label for="item_price">Price</label>
                <input type="text" name="sell_item_price" id="item_price" tabindex="2"
                       value="<?php echo htmlspecialchars($item->price); ?>">
                <?php if (isset($errors["sell_item_price"])) {
                    echo "<p class = 'error'> " . htmlspecialchars($errors["sell_item_price"]) . "</p>";
                } ?>
            </div>

            <div class="input_box">
                <label for="item_pic">Picture</label>
                <input type="file" name="sell_item_pic" id="item_pic" accept="image/png, image/jpg, image/jpeg, image/gif" tabindex="3">
                <?php if (isset($errors['sell_item_pic'])) echo "<p class='error'>" . htmlspecialchars($errors['sell_item_pic']) . "</p>"; ?>
            </div>

            <div class="input_box">

                <label for="categories">Choose <strong>1 - 4</strong> categories</label>
                <br>
                <select name="sell_item_categories" id="categories" multiple>
                    <?php
                    $categories = fetchAllCategories();
                    foreach ($categories as $category) {
                        echo "<option name='$category' value='$category'>$category</option>";
                    }
                    ?>
                </select>
            </div>

            <div id="selected_categories"></div>

            <?php if (isset($errors["sell_item_categories"])) {
                echo "<p class = 'error'> " . htmlspecialchars($errors["sell_item_categories"]) . "</p>";
            } ?>

            <div class="button">
                <input type="submit" value="Insert listing" name="submit">
            </div>

        </div>

    </form>

</main>

</body>
</html>
