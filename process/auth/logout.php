<?php
session_start();

if (empty($_SESSION['id'])) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();

    echo "<script>
        window.location.href = '../../pages/login.php';
        </script>";
} else {
    header('Location: ../../pages/dashboard.php');
}
