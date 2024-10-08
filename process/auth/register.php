<?php
require_once('../../database/database.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $faculty_id =  mysqli_real_escape_string($conn, $_POST["faculty_id"]);
    $username =  mysqli_real_escape_string($conn, $_POST["username"]);
    $first_name =  mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last_name =  mysqli_real_escape_string($conn, $_POST["last_name"]);
    $middle_name =  mysqli_real_escape_string($conn, $_POST["middle_name"]);
    $email =  mysqli_real_escape_string($conn, $_POST["email"]);
    $birthday =  mysqli_real_escape_string($conn, $_POST["birthday"]);
    $age =  mysqli_real_escape_string($conn, $_POST["age-hidden"]);
    $password =  mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);

    if ($password === $confirm_password) {

        $stmt = $conn->prepare("SELECT * FROM login WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows <= 0) {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt_insert = $conn->prepare("INSERT INTO registration (faculty_id, first_name, last_name, middle_name, email, birthday, age) VALUES (? ,? ,?, ? ,? ,?, ?)");
            $stmt_insert->bind_param("ssssssi", $faculty_id, $first_name, $last_name, $middle_name, $email, $birthday, $age);

            if ($stmt_insert->execute()) {

                $reg_id = $stmt_insert->insert_id;

                $stmt_2nd_table = $conn->prepare("INSERT INTO login (reg_id, username, password) VALUES (?, ?, ?)");
                $stmt_2nd_table->bind_param("iss", $reg_id, $username, $hashed_password);

                if ($stmt_2nd_table->execute()) {

                    $_SESSION["registration_success"] = true;
                    $stmt->close();
                    $stmt_insert->close();
                    $stmt_2nd_table->close();

                    header('Location: ../../pages/login.php');
                } else {
                    echo "Error: " . $stmt_2nd_table . "<br>" . mysqli_error($conn);
                    $stmt->close();
                    $stmt_insert->close();
                    $stmt_2nd_table->close();
                }
            } else {
                echo "Error: " . $stmt_insert . "<br>" . mysqli_error($conn);
                $stmt->close();
                $stmt_insert->close();
            }
        } else {
            $_SESSION["email_already_taken"] = true;
            $_SESSION["form_data"] = $_POST;
            $stmt->close();

            header('Location: ../../index.php');
        }
    } else {
        $_SESSION["confirm_password"] = false;
        $_SESSION["form_data"] = $_POST;

        header('Location: ../../index.php');
    }
}

mysqli_close($conn);
exit;
