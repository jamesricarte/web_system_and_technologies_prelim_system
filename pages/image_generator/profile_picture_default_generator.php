<?php

$firstName = str_replace(' ', '_',  $user_first_name);
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
$fontFile = '../assets/fonts/arial.TTF';
$bbox = imagettfbbox($fontSize, 0, $fontFile, $firstLetter);
$x = (200 - ($bbox[2] - $bbox[0])) / 2;
$y = (200 - ($bbox[5] - $bbox[1])) / 2;
imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontFile, $firstLetter);

$targetDir = "../images/user_profile_pictures/" . $_SESSION['id'] . "/";

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

$fileName =  $firstName . '_default_profile_picture.jpg';
$targetFile = $targetDir . $fileName;

if (imagejpeg($image, $targetFile)) {
    // echo "Image created and saved as: $fileName";

    $stmt = $conn->prepare("UPDATE registration SET profile_picture = ? WHERE reg_id = ?");
    $stmt->bind_param('si', $fileName, $_SESSION['id']);
    if ($stmt->execute()) {
        // echo "Update database success!";
    } else {
        echo "Error generating custom profile to database!";
    }

    imagedestroy($image);
} else {
    echo "Sorry, there was an error creating the image.";
}
