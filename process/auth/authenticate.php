<?php
require_once('../../database/database.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameorEmail = mysqli_real_escape_string($conn, $_POST["usernameOrEmail"]);
    $password =  mysqli_real_escape_string($conn, $_POST["password"]);

    $stmt = $conn->prepare("SELECT login.reg_id, login.password 
        FROM login 
        JOIN registration ON login.reg_id = registration.reg_id
        WHERE login.username = ? OR registration.email = ?");
    $stmt->bind_param("ss", $usernameorEmail, $usernameorEmail);
    $stmt->execute();
    $stmt->bind_result($reg_id, $hashed_password);

    if ($stmt->fetch()) {

        if (password_verify($password, $hashed_password)) {
            $_SESSION["authenticate_success"] = true;

            $_SESSION["id"] = $reg_id;

            $stmt->close();

            header("Location: ../../pages/dashboard.php");
        } else {
            $_SESSION["invalid_email_and_password"] = true;
            $_SESSION["form_data"] = $_POST;
            $stmt->close();

            header("Location: ../../pages/login.php");
        }
    } else {
        $_SESSION["invalid_email_and_password"] = true;
        $_SESSION["form_data"] = $_POST;
        $stmt->close();

        header("Location: ../../pages/login.php");
    }
}

mysqli_close($conn);
exit;
