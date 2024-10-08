<?php
    require_once('../../database/database.php');
    session_start();
    
    if(empty($_SESSION['id'])) {
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id']) && isset($data['status'])) {
    $student_id = $data['id'];
    $new_status = $data['status'];

    $stmt = $conn->prepare("UPDATE students SET status = ? WHERE student_id = ?");
    $stmt->bind_param('ii', $new_status, $student_id);

    if ($stmt->execute()) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid data received.";
}
?>