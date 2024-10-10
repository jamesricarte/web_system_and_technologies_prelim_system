<?php
require_once('../../database/database.php');
session_start();

if (empty($_SESSION['id'])) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_schedule_id =  mysqli_real_escape_string($conn, $_POST["student_schedule_id"]);
    $student_id =  mysqli_real_escape_string($conn, $_POST["student_id"]);

    $stmt_delete = $conn->prepare("DELETE FROM student_schedules WHERE student_schedule_id = ?");
    $stmt_delete->bind_param("i", $student_schedule_id);

    if ($stmt_delete->execute()) {

        $_SESSION["delete_student_subject_success"] = true;
        $stmt_delete->close();

        header('Location: ../../pages/student_subjects.php?studentId=' . $student_id);
        exit;
    } else {
        $_SESSION["delete_student_subject_success"] = false;

        echo "Error: " . $stmt_delete . "<br>" . mysqli_error($conn);
        $stmt_delete->close();
    }
}

mysqli_close($conn);
exit;
