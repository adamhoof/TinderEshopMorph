<?php
include_once "../../backend/loginHandler.php";

$result = processLogin();
$user = $result['user'];
$errors = $result['errors'];
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
                <span class="details">Do not have an account? <a href="registration.php">Register</a></span>

            </div>

            <div class="button">
                <input type="submit" value="Login" name="submit">
            </div>

        </div>


    </form>

</main>

</body>

</html>