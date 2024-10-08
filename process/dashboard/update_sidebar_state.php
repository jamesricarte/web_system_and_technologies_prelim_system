<?php
session_start();

if(empty($_SESSION['id'])) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

// Check if the AJAX request is made
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isSidebarMinimized = filter_var($_POST['isSidebarMinimized'], FILTER_VALIDATE_BOOLEAN);
    $_SESSION['isSidebarMinimized'] = $isSidebarMinimized;

    if ($isSidebarMinimized === true || $isSidebarMinimized === false) {
        echo json_encode(['success' => true]);
    }
    
}
?>
