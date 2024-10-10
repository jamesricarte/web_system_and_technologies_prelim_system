<?php
require_once('../../database/database.php');
session_start();

if (empty($_SESSION['id'])) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $schedule_id =  mysqli_real_escape_string($conn, $_POST["schedule_id"]);
    $student_id =  mysqli_real_escape_string($conn, $_POST["student_id"]);

    $stmt_insert = $conn->prepare("INSERT INTO student_schedules (student_id, schedule_id) VALUES (? ,? )");
    $stmt_insert->bind_param("ii", $student_id, $schedule_id);

    if ($stmt_insert->execute()) {

        $_SESSION["add_student_subject_success"] = true;
        $stmt_insert->close();

        header('Location: ../../pages/student_subjects.php?studentId=' . $student_id);
        exit;
    } else {
        $_SESSION["add_student_subject_success"] = false;

        echo "Error: " . $stmt_insert . "<br>" . mysqli_error($conn);
        $stmt_insert->close();
    }
}

mysqli_close($conn);
exit;
