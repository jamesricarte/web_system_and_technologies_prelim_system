<?php
session_start();

if (isset($_SESSION["confirm_password"])) {
    if ($_SESSION["confirm_password"] == false) {
        echo "<script> window.onload = function() {
            document.querySelector('.warning.password').style.display = 'initial'; 
            }
            </script>";

        $_SESSION["confirm_password"] = null;
    }
}

if (isset($_SESSION["email_already_taken"])) {
    echo "<script> window.onload = function() {
            document.querySelector('.warning.username').style.display = 'initial'; 
            }
            </script>";;

    $_SESSION["email_already_taken"] = null;
}

$faculty_id = bin2hex(random_bytes(4));
$form_data = $_SESSION["form_data"] ?? [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="styles/auth/form-style.css">
    <link rel="stylesheet" href="styles/default.css">

</head>

<body>
    <form class="register_form" action="process/auth/register.php" method="post">
        <h3>Please Register</h3>
        <p class="warning username">The username was already taken!</p>
        <p class="warning email">The email was already taken!</p>
        <p class="warning password">The password confirmation does not match!</p>

        <div class="faculty_container">
            <div class="input_set first">
                <label for="faculty_id">Faculty ID:</label>
                <input class="faculty_id" type="text" placeholder="Faculty ID" id="faculty_id" value="<?php echo $faculty_id; ?>" disabled required>
                <input type="hidden" name="faculty_id" id="faculty_id" value="<?php echo $faculty_id; ?>" required>
            </div>
            <div class="input_set second">
                <label for="email">Email:</label>
                <input class="email" type="email" placeholder="Email" name="email" id="email" required value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>">
            </div>

        </div>

        <label for="first_name">First Name:</label>
        <input class="name" type="text" placeholder="First Name" name="first_name" id="first_name" required value="<?php echo htmlspecialchars($form_data['first_name'] ?? ''); ?>">

        <div class="names_container">
            <div class="input_set first">
                <label for="last_name">Last Name:</label>
                <input class="name" type="text" placeholder="Last Name" name="last_name" id="last_name" required value="<?php echo htmlspecialchars($form_data['last_name'] ?? ''); ?>">
            </div>

            <div class="input_set second">
                <label for="middle_name">Middle Name:</label>
                <input class="name" type="text" placeholder="Middle Name" name="middle_name" id="middle_name" required value="<?php echo htmlspecialchars($form_data['middle_name'] ?? ''); ?>">
            </div>
        </div>

        <div class="birthday_container">
            <div class="input_set first">
                <label for="birthday">Birthday:</label>
                <input class="birthday" type="date" placeholder="Birthday" name="birthday" id="birthday" required value="<?php echo htmlspecialchars($form_data['birthday'] ?? ''); ?>">
            </div>

            <div class="input_set second">
                <label for="age">Age:</label>
                <input class="age" type="age" placeholder="Age" name="age" id="age" required disabled value="<?php echo htmlspecialchars($form_data['age'] ?? ''); ?>">

                <input class="age-hidden" type="hidden" name="age-hidden" id="age-hidden" required value="<?php echo htmlspecialchars($form_data['age'] ?? ''); ?>">
            </div>
        </div>

        <label for="username">Username:</label>
        <input class="username" type="text" placeholder="Username" name="username" id="username" required value="<?php echo htmlspecialchars($form_data['username'] ?? ''); ?>">

        <div class="password_container">
            <div class="input_set first">
                <label for="password">Password:</label>
                <input class="password" type="password" placeholder="Password" name="password" id="password" required value="<?php echo htmlspecialchars($form_data['password'] ?? ''); ?>">
            </div>
            <div class="input_set second">
                <label for="confirm_password">Confirm Password:</label>
                <input class="password" type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required value="<?php echo htmlspecialchars($form_data['confirm_password'] ?? ''); ?>">
            </div>

        </div>

        <input type="submit" name="signup" value="Sign Up">

        <p>Already have an account? <a href="pages/login.php">Login Here</a></p>
    </form>

    <script defer src="scripts/auth/age_detect.js"></script>
</body>

</html>

<?php unset($_SESSION['form_data']); ?>