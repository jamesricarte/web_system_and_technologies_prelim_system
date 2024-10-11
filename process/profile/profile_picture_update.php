<?php
require_once('../../database/database.php');
session_start();

if (empty($_SESSION['id'])) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_id = $_SESSION['id'];
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0) {
        $targetDir = "../../images/user_profile_pictures/" . $reg_id . "/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $fileName = basename($_FILES['profile_picture']['name']);
        $targetFile = $targetDir . $fileName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES['profile_picture']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            $_SESSION['file_image'] = false;
            header('Location: ../../pages/profile.php');
            exit;
        }

        if ($_FILES['profile_picture']['size'] > 20971520) {
            $uploadOk = 0;
            $_SESSION['file_size'] = false;
            header('Location: ../../pages/profile.php');
            exit;
        }

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            $uploadOk = 0;
            $_SESSION['file_format'] = false;
            header('Location: ../../pages/profile.php');
            exit;
        }

        if ($uploadOk === 1) {
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
                $stmt = $conn->prepare("UPDATE registration SET profile_picture = ? WHERE reg_id = ?");
                $stmt->bind_param('si', $fileName, $reg_id);

                if ($stmt->execute()) {
                    $_SESSION['profile_update_success'] = true;
                    header('Location: ../../pages/profile.php');
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "No file uploaded or upload error.";
        }
    }
}

mysqli_close($conn);
exit;
