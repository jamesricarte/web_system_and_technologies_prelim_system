<?php
    require_once('../../database/database.php');
    session_start();
    
    if(empty($_SESSION['id'])) {
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
    $student_id = $data['id'];

    $stmt = $conn->prepare("DELETE from students WHERE student_id = ?");
    $stmt->bind_param('i', $student_id);

    if ($stmt->execute()) {
        echo "Status updated successfully.";

        $_SESSION['delete_student_success'] = true;
    } else {
        echo "Error updating status: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid data received.";
}
?>