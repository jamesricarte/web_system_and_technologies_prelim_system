<?php
    require_once('../../database/database.php');
    session_start();

    if(empty($_SESSION['id'])) {
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $reg_id = $_SESSION['id'];
        $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
        $last_name =  mysqli_real_escape_string($conn, $_POST["last_name"]);
        $middle_name =  mysqli_real_escape_string($conn, $_POST["middle_name"]);
        $birthday =  mysqli_real_escape_string($conn, $_POST["birthday"]);
        $age =  mysqli_real_escape_string($conn, $_POST["age_hidden"]);
        $email =  mysqli_real_escape_string($conn, $_POST["email"]);
        $username =  mysqli_real_escape_string($conn, $_POST["username"]);

        $db_username = null;

        $stmt_check = $conn->prepare("SELECT username FROM login WHERE reg_id = ?");
        $stmt_check->bind_param("i", $reg_id);
        $stmt_check->execute();
        $stmt_check->bind_result($db_username);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($db_username != $username) {
            $stmt = $conn->prepare("SELECT username FROM login WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute() ;
            if ($stmt->fetch()) {
                $stmt->close();
                $_SESSION["username_already_taken"] = true;
                header('Location: ../../pages/profile.php');
                exit;
            }
        }

        $stmt_update = $conn->prepare("UPDATE registration 
        JOIN login ON registration.reg_id = login.reg_id
        SET first_name = ?, last_name = ?, middle_name = ?, birthday = ?, age = ?, email = ?, login.username = ?
        WHERE .registration.reg_id = ?");
        $stmt_update->bind_param("ssssissi", $first_name, $last_name, $middle_name, $birthday, $age, $email, $username, $reg_id);

        if ($stmt_update->execute()) {

            $_SESSION["profile_details_update_success"] = true;
            $stmt_update->close();

            header('Location: ../../pages/profile.php');
        } else {
            $_SESSION["profile_details_update_success"] = false;

            echo "Error: " . $stmt_update . "<br>" . mysqli_error($conn);
            $stmt_update->close();
        }

    }

    mysqli_close($conn);
    exit;
?>