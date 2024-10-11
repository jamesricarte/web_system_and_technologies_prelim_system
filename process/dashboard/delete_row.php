<?php
require_once('../../database/database.php');
session_start();

if (empty($_SESSION['id'])) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $student_id = $data['id'];

    $stmt = $conn->prepare("DELETE FROM students WHERE student_id = ?");
    $stmt->bind_param('i', $student_id);

    if ($stmt->execute()) {

        $stmt->close();

        $stmt_delete = $conn->prepare("DELETE FROM student_schedules WHERE student_id = ?");
        $stmt_delete->bind_param('i', $student_id);

        if ($stmt_delete->execute()) {

            echo "Status updated successfully.";
            $_SESSION['delete_student_success'] = true;

            $stmt_delete->close();
        } else {
            echo "Error updating status: " . $stmt_delete->error;
        }
    } else {
        echo "Error updating status: " . $stmt->error;
    }

    $conn->close();
} else {
    echo "Invalid data received.";
}
