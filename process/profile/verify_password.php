<?php
    require_once('../../database/database.php');
    session_start();

    if(empty($_SESSION['id'])) {
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password =  mysqli_real_escape_string($conn, $_POST["password"]);

        $stmt = $conn->prepare("SELECT password FROM login WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($hashed_password);

        if($stmt->fetch()) {
            if (password_verify($password, $hashed_password)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false]);
        }
    }

    mysqli_close($conn);
    exit;
?>