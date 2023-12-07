<?php
include_once "../../backend/basicRequirementsValidator.php";
include_once "../../backend/database.php";
include_once "../../backend/item.php";

session_start();
if (!isset($_SESSION['guid'])) {
    header("Location: login.php");
    die();
}

$user = queryUser($_SESSION['guid']);
$item = Item::emptyItem();
$errors = array();

if (empty($user->guid)) {
    header("location:login.php");
    die();
}

if (isset($_POST["submit"])) {

    if (!isset($_POST["sell_item_name"])) {
        $errors["sell_item_name"] = "Name is required field";
    }

    $item->name = $_POST["sell_item_name"];
    if (!inputLengthValid($item->name)) {
        $errors["sell_item_name"] = "Name must be between 3 and 255 characters long";
    }

    if (!isset($_POST["sell_item_price"])) {
        $errors["sell_item_price"] = "Price is required field";
    }


    if (!is_numeric($_POST["sell_item_price"])) {
        $errors["sell_item_price"] = "Price must be a number";
    } else {
        $item->price = floatval($_POST["sell_item_price"]);
    }

    //TODO: handle picture upload
    if (!isset($_POST["sell_item_pic"])) {
        $errors["sell_item_pic"] = "Picture is required field";
    }

    if (!isset($_POST["selected_categories"])) {
        $errors["selected_categories"] = "Categories are required field";
    }

    //ORDER MATTERS HERE xdddddd
    if (empty($_POST["selected_categories"]) || !is_array($_POST["selected_categories"]) || count($_POST["selected_categories"]) > 4 ) {
        $errors["sell_item_categories"] = "You must choose between 1 and 4 categories";
    } else {
        $item->categories = $_POST["selected_categories"];
        foreach ($item->categories as $category) {
            if (!inputLengthValid($category, 5,20) || !categoryExists($category)) {
                //TODO: does not exist in db
                $errors["sell_item_categories"] = "$category is invalid category";
            }
        }
    }

    if (empty($errors)) {
        $item->seller_guid = $user->guid;
        $item->picUrl = "fucktard";
        insertItem($item);
        header("location:../../backend/itemInsertSuccessful.php");
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sell Item</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/sell.css">
    <link rel="stylesheet" href="../css/top_nav.css">
    <script src="../js/sell.js"></script>
</head>
<body>

<nav class="top_nav">
    <a href="main_page.php">Home</a>
    <a href="user_information.php">User info</a>
    <a href="transaction_history.php">Transaction history</a>
    <a href="logout.php">Logout</a>
</nav>

<main>

    <div class="title">Sell your item!</div>
    <form method="post" action="sell.php" id="sell_form">

        <div class="item_details">

            <div class="input_box">
                <label for="item_name">Name</label>
                <input type="text" name="sell_item_name" id="item_name" tabindex="1" autofocus value="<?php echo htmlspecialchars($item->name); ?>">
                <?php if (isset($errors["sell_item_name"])) {echo "<p class = 'error'> " . htmlspecialchars($errors["sell_item_name"]) . "</p>";} ?>
            </div>

            <div class="input_box">
                <label for="item_price">Price</label>
                <input type="text" name="sell_item_price" id="item_price" tabindex="2" value="<?php echo htmlspecialchars($item->price); ?>">
                <?php if (isset($errors["sell_item_price"])) {echo "<p class = 'error'> " . htmlspecialchars($errors["sell_item_price"]) . "</p>";} ?>
            </div>

            <div class="input_box">
                <label for="item_pic">Picture</label>
                <input type="file" name="sell_item_pic" id="item_pic" accept="image/png" tabindex="3">
            </div>

            <div class="input_box">

                <label for="categories">Choose <strong>1 - 4</strong> categories</label>
                <br>
                <select name="sell_item_categories" id="categories" multiple>
                    <option tabindex="4" value="Tee">Tee</option>
                    <option value="sHOES">sHOES</option>
                    <option value="bnig">bnig</option>
                    <option value="pejčka">pejčka</option>
                    <option value="mrdkoška">mrdkoška</option>
                    <option value="kacafir">kacafir</option>
                </select>
            </div>

            <div id="selected_categories"></div>

            <?php if (isset($errors["sell_item_categories"])) {echo "<p class = 'error'> " . htmlspecialchars($errors["sell_item_categories"]) . "</p>";} ?>

            <div class="button">
                <input type="submit" value="Insert listing" name="submit">
            </div>

        </div>

    </form>

</main>

</body>
</html>
