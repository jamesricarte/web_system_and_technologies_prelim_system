<?php
require_once('../../database/database.php');
session_start();

if (empty($_SESSION['id'])) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_id = $_SESSION["id"];
    $first_name =  mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last_name =  mysqli_real_escape_string($conn, $_POST["last_name"]);
    $middle_name =  mysqli_real_escape_string($conn, $_POST["middle_name"]);
    $school_id =  mysqli_real_escape_string($conn, $_POST["school_id"]);
    $course =  mysqli_real_escape_string($conn, $_POST["course"]);
    $year_level =  mysqli_real_escape_string($conn, $_POST["year_level"]);

    $stmt_insert = $conn->prepare("INSERT INTO students (reg_id, first_name, last_name, middle_name, school_id, course, year_level) VALUES (? ,? ,?, ? ,? ,?, ?)");
    $stmt_insert->bind_param("isssiii", $reg_id, $first_name, $last_name, $middle_name, $school_id, $course, $year_level);

    if ($stmt_insert->execute()) {

        $student_id = $stmt_insert->insert_id;

        $stmt_insert->close();

        $stmt_add_subject = $conn->prepare("INSERT INTO student_schedules (student_id, schedule_id)
        SELECT ?, schedules.schedule_id
        FROM schedules
        WHERE schedules.course_id = ?");
        $stmt_add_subject->bind_param("ii", $student_id, $course);

        if ($stmt_add_subject->execute()) {

            $_SESSION["add_student_success"] = true;

            $stmt_add_subject->close();

            header('Location: ../../pages/dashboard.php');
        } else {

            $_SESSION["add_student_success"] = false;

            echo "Error: " . $stmt_add_subject . "<br>" . mysqli_error($conn);
            $stmt_add_subject->close();
        }
    } else {
        $_SESSION["add_student_success"] = false;

        echo "Error: " . $stmt_insert . "<br>" . mysqli_error($conn);
        $stmt_insert->close();
    }
}

mysqli_close($conn);
exit;
