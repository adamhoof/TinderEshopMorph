<?php

include_once "../../backend/basicRequirementsValidator.php";
include_once "../../backend/database.php";

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

    if (!isset($_POST["password_verify"])) {
        $errors["password_verify"] = "Password verify is required field";
    }

    $passwordVerify = $_POST["password_verify"];
    if (!inputLengthValid($passwordVerify)) {
        $errors["password_verify"] = "Password verify must be between 3 and 255 characters long";
    }

    if ($user->password !== $passwordVerify) {
        $errors["password_match"] = "Passwords do not match";
    }

    if (userExists($user->guid)) {
        $errors["guid"] = "User with this GUID already exists";
    }

    if (!isset($_FILES["profile_pic"])) {
        $errors["profile_pic"] = "Picture is required field";
    } elseif ($_FILES["profile_pic"]["size"] > 3000000) {
        $errors["profile_pic"] = "Picture must be smaller than 1MB";
    }

    $fileType = "";
    if ($_FILES["profile_pic"]["error"] == UPLOAD_ERR_NO_FILE) {
        $errors["profile_pic"] = "Picture is required";
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($finfo, $_FILES['profile_pic']['tmp_name']);

        $allowedTypes = ["image/png", "image/jpeg", "image/gif", "image/jpg"];
        if (!in_array($fileType, $allowedTypes)) {
            $errors["profile_pic"] = "Picture must be a png, jpeg, gif or jpg";
        }
        finfo_close($finfo);
    }

    if (empty($errors)) {
        registerUser($user);
        $userDir = "../../backend/user_pictures/";
        if (!file_exists($userDir)) {
            mkdir($userDir);
        }

        $newFilePath = $userDir . $user->guid . ".gif";
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $newFilePath);
        header("location:../../backend/registrationSuccessful.php");
        die();
    }

}

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
                <!--<span class="details">GUID</span>-->
                <label for="guid">GUID</label>

                <input type="text" name="guid" id="guid" tabindex="1" autofocus
                       value="<?php echo htmlspecialchars($user->guid); ?>">
                <?php if (isset($errors['guid'])) echo "<p class='error'>" . htmlspecialchars($errors['guid']) . "</p>"; ?>
            </div>

            <div class="input_box">
                <!--<span class="details">Password</span>-->
                <label for="password_input">Password</label>
                <input id="password_input" type="password" class="input_field" name="password" tabindex="2">
                <?php if (isset($errors['password'])) echo "<p class='error'>" . htmlspecialchars($errors['password']) . "</p>"; ?>
            </div>

            <div class="input_box">
                <!--<span class="details">Password again</span>-->
                <label for="verify_password_input">Password again</label>
                <input id="verify_password_input" type="password" class="input_field" name="password_verify"
                       tabindex="3">
                <span id="password_error" class="error"></span>
                <?php if (isset($errors['password_verify'])) echo "<p class='error'>" . htmlspecialchars($errors['password_verify']) . "</p>"; ?>
                <?php if (isset($errors['password_match'])) echo "<p class='error'>" . htmlspecialchars($errors['password_match']) . "</p>"; ?>
            </div>

            <div class="input_box">
                <label for="profile_pie">Picture</label>
                <input type="file" name="profile_pic" id="profile_pie" accept="image/png" tabindex="4">
                <?php if (isset($errors['profile_pic'])) echo "<p class='error'>" . htmlspecialchars($errors['profile_pic']) . "</p>"; ?>


            </div>

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
