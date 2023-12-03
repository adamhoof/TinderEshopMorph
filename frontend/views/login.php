<?php
include_once "../../backend/basicRequirementsValidator.php";
include_once "../../backend/database.php";

session_start();

$user = User::emptyUser();
$errors = array();

if (isset($_POST["submit"])) {
    if (!isset($_POST["guid"])) {
        $errors["guid"] = "GUID is required field";
    }

    $user->guid = $_POST["guid"];
    if (!inputLengthValid($user->guid)) {
        $errors["guid"] = "GUID must be between 3 and 255 characters long";
    }

    if (!isset($_POST["password"])) {
        $errors["password"] = "Password is required field";
    }

    $user->password = $_POST["password"];
    if (!inputLengthValid($user->password)) {
        $errors["password"] = "Password must be between 3 and 255 characters long";
    }

    if (empty($errors)) {
        $userProfile = queryUser($user->guid);
        if (empty($userProfile->guid)) {
            $errors["guid"] = "User with this GUID does not exist";
        } else {
            if (password_verify($user->password, $userProfile->password)) {
                $_SESSION["guid"] = $user->guid;
                header("location:../../frontend/views/main_page.php");
            } else {
                $errors["password"] = "Password is incorrect";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wantit Login</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/form.css">
    <script src="../js/login.js"></script>
</head>
<body>

<main>
    <div class="title">Hello there</div>
    <form method="post" action="login.php" id="login_form">
        <div class="user_details">

            <div class="input_box">
                <label for="guid">GUID</label>
                <input type="text" name="guid" id="guid" tabindex="1" autofocus
                       value="<?php echo htmlspecialchars($user->guid); ?>">
                <?php if (isset($errors['guid'])) echo "<p class='error'>" . htmlspecialchars($errors['guid']) . "</p>"; ?>
            </div>

            <div class="input_box">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" tabindex="2">
                <?php if (isset($errors['password'])) echo "<p class='error'>" . htmlspecialchars($errors['password']) . "</p>"; ?>

            </div>

            <div class="input_box">
                <span class="details">Do not have an account? <a href="registration_form.php">Register</a></span>

            </div>

            <div class="button">
                <input type="submit" value="Login" name="submit">
            </div>

        </div>


    </form>

</main>

</body>

</html>