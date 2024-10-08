<?php
session_start();

if (isset($_SESSION["registration_success"])) {
    echo "<script> alert('Registration Successfull! You can now log in.') </script>";

    $_SESSION["registration_success"] = null;
}

if (isset($_SESSION["invalid_email_and_password"])) {
    if ($_SESSION["invalid_email_and_password"] == true) {
        echo "<script> window.onload = function() {
            document.querySelector('.warning.invalid').style.display = 'initial'; 
            }
            </script>";

        $_SESSION["invalid_email_and_password"] = null;
    }
}

$form_data = $_SESSION["form_data"] ?? [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../styles/auth/form-style.css">
    <link rel="stylesheet" href="../styles/default.css">
</head>

<body>
    <form action="../process/auth/authenticate.php" method="post">
        <h3>Please Login</h3>
        <p class="warning invalid">Invalid Username and Password!</p>

        <label for="usernmae">Username:</label>
        <input class="username" type="text" placeholder="Username" name="usernameOrEmail" id="username" required value="<?php echo htmlspecialchars($form_data['usernameOrEmail'] ?? ''); ?>">

        <label for="password">Password:</label>
        <input class="password" type="password" placeholder="Password" name="password" id="password" required>

        <input type="submit" name="login" value="Login">

        <p>Don't have an account? <a href="../index.php">Register Here</a></p>
    </form>
</body>

</html>

<?php unset($_SESSION['form_data']); ?>