<?php
include_once "../../backend/basicRequirementsValidator.php";
include_once "../../backend/database.php";

session_start();
// Redirect to login page if the user is not logged in
if (!isset($_SESSION["guid"])) {
    header("location:login.php");
    die();
}

// Retrieve user data from the database
$guid = $_SESSION["guid"];
$user = queryUser($guid);
$errors = array();

if (empty($user->guid)) {
    header("location:login.php");
    die();
}

if (isset($_POST["submit"])) {
    $updatedUser = User::emptyUser();

    if (!isset($_POST["guid"])) {
        $errors["guid"] = "GUID is required field";
    }

    $updatedUser->guid = $_POST["guid"];
    if (!inputLengthValid($updatedUser->guid)) {
        $errors["guid"] = "GUID must be between 3 and 255 characters long";
    }

    if (!isset($_POST["password"])) {
        $errors["password"] = "Password is required field";
    }

    $updatedUser->password = $_POST["password"];
    if (!inputLengthValid($updatedUser->password)) {
        $errors["password"] = "Password must be between 3 and 255 characters long";
    }

    $potentiallyExistingUser = queryUser($updatedUser->guid);
    if (!empty($potentiallyExistingUser->guid) && $potentiallyExistingUser->guid !== $user->guid) {
        $errors["guid"] = "User with this GUID already exists";
    }

    if (empty($errors)) {
        updateUser($user->guid, $updatedUser);
        rename("../../backend/user_pictures/".$user->guid, "../../backend/user_pictures/".$updatedUser->guid);
        $_SESSION["guid"] = $updatedUser->guid;
        //TODO: change pic location
        header("location:../../backend/userDataUpdateSuccessful.php");
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/top_nav.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/user_information.css">
    <script src="../js/user_information.js"></script>
    <title>User info</title>
</head>

<body>

<nav class="top_nav">
    <a href="main_page.php">Home</a>
    <a href="sell.php">Sell</a>
    <a href="transaction_history.php">Transaction history</a>
    <a href="logout.php">Logout</a>
</nav>

<main>

    <form method="post" action="user_information.php">

        <div id="edit_enable_box">
            <label for="edit_checkbox">Enable editing</label>
            <input id="edit_checkbox" type="checkbox" name="enable_edit">
        </div>

        <div class="title">User info</div>

        <div class="user_details">

            <div class="input_box">
                <label for="profile_pic">Profile picture</label>
                <br>
                <img src="<?php echo htmlspecialchars("../../backend/user_pictures/".$guid."/profile_pic.gif") ?>" alt="profile picture">
                <input type="file" name="sell_item_pic" id="profile_pic" accept="image/png" class="disableable"
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