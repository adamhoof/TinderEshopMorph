<?php

include_once "../../backend/updateUserInformationHandler.php";

$result = processUserInformationUpdate();
$user = $result["user"];
$errors = $result["errors"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/topNav.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/userInformation.css">
    <script src="../js/userInformation.js"></script>
    <title>User info</title>
</head>

<body>

<nav class="top_nav">
    <a href="mainPage.php">Home</a>
    <a href="sell.php">Sell</a>
    <a href="transactionHistory.php">Transaction history</a>
    <a href="logout.php">Logout</a>
</nav>

<main>

    <form method="post" action="userInformation.php" enctype="multipart/form-data">

        <div id="edit_enable_box">
            <label for="edit_checkbox">Enable editing</label>
            <input id="edit_checkbox" type="checkbox" name="enable_edit">
        </div>

        <div class="title">User info</div>

        <div class="user_details">

            <div class="input_box">
                <label for="profile_picture">Profile picture</label>
                <br>
                <img src="<?php echo htmlspecialchars("../../backend/userPictures/".$user->id."/profile_picture.gif") ?>" alt="profile picture">
                <input type="file" name="profile_picture" id="profile_picture" accept="image/png, image/jpg, image/jpeg, image/gif" class="disableable"
                       tabindex="1" autofocus>
            </div>

            <div class="input_box">
                <label for="guid">GUID</label>
                <input type="text" name="guid" id="guid" autofocus class="disableable" tabindex="2"
                       value="<?php echo htmlspecialchars($user->guid); ?>">
                <?php if (isset($errors["guid"])) echo "<p class='error'>" . htmlspecialchars($errors["guid"]) . "</p>"; ?>
            </div>

            <div class="input_box">
                <label for="password_input">Password</label>
                <input id="password_input" type="password" class="input_field disableable" name="password" tabindex="3">
                <?php if (isset($errors["password"])) echo "<p class='error'>" . htmlspecialchars($errors["password"]) . "</p>"; ?>
            </div>

            <div class="button">
                <input type="submit" value="Save" class="disableable" id="save_button" name="submit">
            </div>

        </div>

    </form>

</main>

</body>
</html>