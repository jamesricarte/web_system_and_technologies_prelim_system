<?php
    require_once('../../database/database.php');
    session_start();

    if(empty($_SESSION['id'])) {
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $student_id = mysqli_real_escape_string($conn, $_POST["student_id"]);
        $first_name =  mysqli_real_escape_string($conn, $_POST["first_name"]);
        $last_name =  mysqli_real_escape_string($conn, $_POST["last_name"]);
        $middle_name =  mysqli_real_escape_string($conn, $_POST["middle_name"]);
        $status =  mysqli_real_escape_string($conn, $_POST["status"]);
        $school_id =  mysqli_real_escape_string($conn, $_POST["school_id"]);
        $course =  mysqli_real_escape_string($conn, $_POST["course"]);
        $year_level =  mysqli_real_escape_string($conn, $_POST["year_level"]);

        $stmt_update = $conn->prepare("UPDATE students SET first_name = ?, last_name = ?, middle_name = ?, school_id = ?, course = ?, year_level = ?, status = ? WHERE student_id = ?");
        $stmt_update->bind_param("sssiiiii", $first_name, $last_name, $middle_name, $school_id, $course, $year_level, $status, $student_id);

        if ($stmt_update->execute()) {

            $_SESSION["update_student_success"] = true;
            $stmt_update->close();

            header('Location: ../../pages/dashboard.php');
            exit;
        } else {
            $_SESSION["update_student_success"] = false;

            echo "Error: " . $stmt_update . "<br>" . mysqli_error($conn);
            $stmt_update->close();
        }
    }

    mysqli_close($conn);
    exit;
?>