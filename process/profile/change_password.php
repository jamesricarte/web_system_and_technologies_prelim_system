<?php
    require_once('../../database/database.php');
    session_start();

    if(empty($_SESSION['id'])) {
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $reg_id = $_SESSION['id'];
        $current_password = mysqli_real_escape_string($conn, $_POST["current_password"]);
        $new_password =  mysqli_real_escape_string($conn, $_POST["new_password"]);
        $confirm_password =  mysqli_real_escape_string($conn, $_POST["confirm_password"]);

        if ($new_password === $confirm_password) {
            $stmt = $conn->prepare("SELECT password FROM login WHERE reg_id = ?");
            $stmt->bind_param('i', $reg_id);
            $stmt->execute();
            $stmt->bind_result($hashed_password);

            if ($stmt->fetch()) {

                $stmt->close();

                if (password_verify($current_password, $hashed_password)) {

                    if (!password_verify($new_password, $hashed_password)) {
                        $update_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                        $stmt_update = $conn->prepare("UPDATE login SET password = ? WHERE reg_id = ?");
                        $stmt_update->bind_param('si', $update_hashed_password, $reg_id);

                        if ($stmt_update->execute()) {
                            $_SESSION['update_password_success'] = true;
                            header('Location: ../../pages/profile.php');

                            $stmt_update->close();
                        } else {
                            $_SESSION['update_password_success'] = false;
                            $_SESSION['form_data'] = $_POST;
                            echo "Error: " . $stmt_update . "<br>" . mysqli_error($conn);

                            $stmt_update->close();
                        }
                    } else {
                        $_SESSION['same_password'] = true;
                        $_SESSION['form_data'] = $_POST;
                        header('Location: ../../pages/profile.php');
                    }

                } else {
                    $_SESSION['match_password'] = false;
                    $_SESSION['form_data'] = $_POST;
                    header('Location: ../../pages/profile.php');
                }
            } else {
                echo "Error: " . $stmt . "<br>" . mysqli_error($conn);
                $stmt->close();
            }
        } else {
            $_SESSION['confirm_password'] = false;
            $_SESSION['form_data'] = $_POST;
            header('Location: ../../pages/profile.php');
        }
    }

    mysqli_close($conn);
    exit;
?>