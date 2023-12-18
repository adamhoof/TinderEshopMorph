<?php

include_once "../../backend/registrationHandler.php";

$result = processRegistration();
$user = $result['user'];
$errors = $result['errors'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/form.css">
    <script src="../js/registration.js"></script>
</head>
<body>

<main>
    <div class="title">Register</div>
    <form method="post" action="registration.php" id="registration_form" enctype="multipart/form-data">

        <div class="user_details">

            <div class="input_box">
                <label for="guid">GUID</label>

                <input type="text" name="guid" id="guid" tabindex="1" autofocus
                       value="<?php echo htmlspecialchars($user->guid); ?>">
                <?php if (isset($errors['guid'])) echo "<p class='error'>" . htmlspecialchars($errors['guid']) . "</p>"; ?>
            </div>

            <div class="input_box">
                <label for="password_input">Password</label>
                <input id="password_input" type="password" class="input_field" name="password" tabindex="2">
                <?php if (isset($errors['password'])) echo "<p class='error'>" . htmlspecialchars($errors['password']) . "</p>"; ?>
            </div>

            <div class="input_box">
                <label for="verify_password_input">Password again</label>
                <input id="verify_password_input" type="password" class="input_field" name="password_verify"
                       tabindex="3">
                <span id="password_error" class="error"></span>
                <?php if (isset($errors['password_verify'])) echo "<p class='error'>" . htmlspecialchars($errors['password_verify']) . "</p>"; ?>
                <?php if (isset($errors['password_match'])) echo "<p class='error'>" . htmlspecialchars($errors['password_match']) . "</p>"; ?>
            </div>

            <div class="input_box">
                <label for="profile_pie">Picture</label>
                <input type="file" name="profile_pic" id="profile_pie" accept="image/png, image/jpg, image/jpeg, image/gif" tabindex="4">
                <?php if (isset($errors['profile_pic'])) echo "<p class='error'>" . htmlspecialchars($errors['profile_pic']) . "</p>"; ?>

            </div>

            <p id="required_fields">All fields are required</p>

            <div class="input_box">
                <span class="details">Already have an account? <a href="login.php">Login</a></span>

            </div>

            <div class="button">
                <input type="submit" value="Register" name="submit" tabindex="5">
            </div>

        </div>

    </form>

</main>

</body>

</html>