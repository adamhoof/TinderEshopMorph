<?php

include "../../backend/basicRequirementsValidator.php";
include "../../backend/database.php";

$data = array(
    "guid" => "",
    "password" => "",
    "password_verify" => ""
);

$errors = array();

if(isset($_POST["submit"])){
    if(!isset($_POST["guid"])){
        $errors["guid"] = "GUID is required field";
    }

    $data["guid"] = $_POST["guid"];
    if (!inputLengthValid($data["guid"])) {
        $errors["guid"] = "GUID must be between 3 and 255 characters long";
    }

    if (!isset($_POST["password"])) {
        $errors["password"] = "Password is required field";
    }

    if (!isset($_POST["password"])) {
        $errors["password"] = "Password is required field";
    }

    $data["password"] = $_POST["password"];
    if (!inputLengthValid($data["password"])) {
        $errors["password"] = "Password must be between 3 and 255 characters long";
    }

    if (!isset($_POST["password_verify"])) {
        $errors["password_verify"] = "Password verify is required field";
    }

    $data["password_verify"] = $_POST["password_verify"];
    if (!inputLengthValid($data["password_verify"])) {
        $errors["password_verify"] = "Password verify must be between 3 and 255 characters long";
    }

    if($data["password"] !== $data["password_verify"]){
        $errors["password_match"] = "Passwords do not match";
    }

    if(userAlreadyExists($data["guid"])){
        $errors["guid"] = "User with this GUID already exists";
    }

    if(empty($errors)){
        registerUser($data["guid"], $data["password"]);
        header("location:../../backend/registrationSuccessful.php");
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
    <form method="post" action="registration_form.php" id="registration_form">

        <div class="user_details">

            <div class="input_box">
                <span class="details">GUID</span>
                <label for="guid"></label>

                <input type="text" name="guid" id="guid" tabindex="1" autofocus value="<?php echo htmlspecialchars($data['guid']); ?>">
                <?php if (isset($errors['guid'])) echo "<p class='error'>" . htmlspecialchars($errors['guid']) . "</p>"; ?>            </div>

            <div class="input_box">
                <span class="details">Password</span>
                <label for="password_input"></label>
                <input id="password_input" type="password" class="input_field" name="password">
                <?php if (isset($errors['password'])) echo "<p class='error'>" . htmlspecialchars($errors['password']) . "</p>"; ?>
            </div>

            <div class="input_box">
                <span class="details">Password again</span>
                <label for="verify_password_input"></label>
                <input id="verify_password_input" type="password" class="input_field" name="password_verify">
                <span id="password_error" class="error"></span>
                <?php if (isset($errors['password_verify'])) echo "<p class='error'>" . htmlspecialchars($errors['password_verify']) . "</p>"; ?>
                <?php if (isset($errors['password_match'])) echo "<p class='error'>" . htmlspecialchars($errors['password_match']) . "</p>"; ?>
            </div>

            <div class="input_box">
                <span class="details">Already have an account? <a href="login.html">Login</a></span>

            </div>

            <div class="button">
                <input type="submit" value="Register" name="submit">
            </div>

        </div>

    </form>

</main>


</body>
</html>
