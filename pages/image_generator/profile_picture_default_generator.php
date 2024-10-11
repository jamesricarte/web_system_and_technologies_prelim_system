<?php
// require_once('../../database/database.php');
// session_start();
if (empty($_SESSION['id'])) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

phpinfo();

$stmt_user_nav = $conn->prepare("SELECT registration.first_name, registration.profile_picture
    FROM login
    JOIN registration ON login.reg_id = registration.reg_id
    WHERE login.reg_id = ?");
$stmt_user_nav->bind_param("i", $_SESSION['id']);
$stmt_user_nav->execute();
$stmt_user_nav->bind_result($user_first_name, $profile_picture);
$stmt_user_nav->fetch();
$stmt_user_nav->close();

$colors = ['#FF5733', '#33FF57', '#3357FF', '#F033FF', '#33FFF0', '#FFD700'];

$randomColorKey = array_rand($colors);
$randomColor = $colors[$randomColorKey];

$firstName = $user_first_name;
$firstLetter = strtoupper(substr($firstName, 0, 1));

function hexToRgb($hex)
{
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 6) {
        list($r, $g, $b) = [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
    } else {
        list($r, $g, $b) = [hexdec(substr($hex, 0, 1) . substr($hex, 0, 1)), hexdec(substr($hex, 1, 1) . substr($hex, 1, 1)), hexdec(substr($hex, 2, 1) . substr($hex, 2, 1))];
    }
    return [$r, $g, $b];
}

list($r, $g, $b) = hexToRgb($randomColor);

$image = imagecreatetruecolor(200, 200);

$backgroundColor = imagecolorallocate($image, $r, $g, $b);
imagefill($image, 0, 0, $backgroundColor);

$textColor = imagecolorallocate($image, 255, 255, 255);

$fontSize = 100;
$fontFile = '../../assets/fonts/arial.TTF';
$bbox = imagettfbbox($fontSize, 0, $fontFile, $firstLetter);
$x = (200 - ($bbox[2] - $bbox[0])) / 2;
$y = (200 - ($bbox[5] - $bbox[1])) / 2;
imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontFile, $firstLetter);

$sessionFolder = '../../images/user_profile_pictures/' . $_SESSION['id'];

if (!is_dir($sessionFolder)) {
    mkdir($sessionFolder, 0777, true);
}

$filename = $sessionFolder . '/' . $firstName . 'default_profile.jpg';

if (imagejpeg($image, $filename)) {
    echo "Image created and saved as: $filename";

    imagedestroy($image);

    $stmt = $mysqli->prepare("UPDATE registration SET profile_picture = ? WHERE reg_id = ?");
    $stmt->bind_param('si', $filename, $_SESSION['id']);
    if ($stmt->execute()) {
        echo "Update database success!";
    }
}
