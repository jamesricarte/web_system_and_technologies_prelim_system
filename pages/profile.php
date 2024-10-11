<?php
require_once('../database/database.php');
session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$stmt_user = $conn->prepare("SELECT registration.reg_id, registration.faculty_id, registration.last_name, registration.middle_name, registration.email, registration.birthday, registration.age, login.username
    FROM login
    JOIN registration ON login.reg_id = registration.reg_id
    WHERE login.reg_id = ?");
$stmt_user->bind_param("i", $_SESSION['id']);
$stmt_user->execute();
$stmt_user->bind_result($reg_id, $faculty_id,  $user_last_name, $user_middle_name, $email, $birthday, $age, $username);
$stmt_user->fetch();
$stmt_user->close();

include('sessions_identifier/profile_sessions.php');

$form_data = $_SESSION['form_data'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../styles/default.css">
    <link rel="stylesheet" href="../styles/nav/nav.css">
    <link rel="stylesheet" href="../styles/profile/profile.css">
    <link rel="stylesheet" href="../styles/profile/profile_edit_controls.css">
    <link rel="stylesheet" href="../styles/profile/confirm_password_modal.css">

</head>

<body>

    <?php include('partials/nav.php') ?>

    <main>
        <div class="section-container profile-picture-section">
            <div class="left">
                <div class="profile-picture-container">
                    <img data-profile-picture-url="<?php echo $profile_picture_path ?>" class="profile_picture" src="<?php echo $profile_picture_path ?>" alt="">
                </div>

                <p class="warning file_image">File is not an image</p>
                <p class="warning file_large">Sorry, your file is too large</p>
                <p class="warning file_format">Sorry, only JPG, JPEG, PNG, PNG & GIF file format is allowed</p>

                <div class="profile_picture_controls_container">
                    <div class="edit_button profile_picture">
                        <img src="../images/icons/simple_edit_icon.png" alt="">
                        <p>Edit</p>
                    </div>

                    <div class="confirm_buttons profile_picture">
                        <button data-form-type="profile_form" class="confirm_change confirm">Save</button>
                        <button class="cancel_change cancel">Cancel</button>
                    </div>
                </div>

                <form class="profile_form" action="../process/profile/profile_picture_update.php" method="POST" enctype="multipart/form-data">
                    <input class="file_input" type="file" name="profile_picture">
                </form>

            </div>
            <div class="right">
                <h1 class="my_profile">My Profile</h1>
                <p class="faculty_id">Faculty Id: <?php echo $faculty_id ?></p>
                <!-- <p class="username">Username: <?php echo $username ?></p> -->
                <form class="profile_details_form" action="../process/profile/profile_details_update.php" method="post">
                    <div class="input_set_container">
                        <div class="input_set">
                            <label for="first_name"> First Name</label>
                            <input class="input_toggle" type="text" name="first_name" value="<?php echo $user_first_name ?>" id="first_name" disabled>
                        </div>
                        <div class="input_set">
                            <label for="last_name">Last Name</label>
                            <input class="input_toggle" type="text" name="last_name" value="<?php echo $user_last_name ?>" id="last_name" disabled>
                        </div>
                    </div>

                    <div class="input_set_container">
                        <div class="input_set">
                            <label for="middle_name">Middle Name</label>
                            <input class="input_toggle" type="text" name="middle_name" value="<?php echo $user_middle_name ?>" id="middle_name" disabled>
                        </div>
                    </div>

                    <div class="input_set_container">
                        <div class="input_set">
                            <label for="birthday">Birthday</label>
                            <input class="input_toggle birthday" type="date" name="birthday" value="<?php echo $birthday ?>" id="birthday" disabled>
                        </div>
                        <div class="input_set">
                            <label for="">Age</label>
                            <input class="age" type="number" value="<?php echo $age ?>" disabled>
                            <input class="age_hidden" type="hidden" name="age_hidden" value="<?php echo $age ?>">
                        </div>
                    </div>

                    <div class="input_set_container">
                        <div class="input_set">
                            <label for="email">Email</label>
                            <input class="input_toggle" type="email" name="email" value="<?php echo $email ?>" id="email" disabled>
                        </div>

                        <div class="input_set">
                            <label for="username">Username</label>
                            <input class="input_toggle" type="text" name="username" value="<?php echo $username ?>" id="username" disabled>
                        </div>
                    </div>
                </form>

                <div class="profile_details_controls_container">
                    <div class="edit_button profile_details">
                        <img src="../images/icons/simple_edit_icon.png" alt="">
                        <p>Edit</p>
                    </div>

                    <div class="confirm_buttons profile_details">
                        <button data-form-type="profile_details_form" class="confirm_details_change confirm disabled" disabled>Save</button>
                        <button class="cancel_details_change cancel">Cancel</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="section-container change-password-section">
            <div class="left">
                <div>
                    <h3>Update Password</h3>
                    <p>Ensure your account is using a long, random password to stay secure.</p>
                </div>
            </div>

            <div class="right">
                <form class="update_password_form" action="../process/profile/change_password.php" method="post">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" value="<?php echo htmlspecialchars($form_data['current_password'] ?? ''); ?>" required>
                    <p class="warning current_password">The password does not match from you current password!</p>
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" value="<?php echo htmlspecialchars($form_data['new_password'] ?? ''); ?>" required>
                    <p class="warning confirm_password">The password confirmation does not match!</p>
                    <p class="warning same_password">The password you enter is the same as your current password!</p>
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" value="<?php echo htmlspecialchars($form_data['confirm_password'] ?? ''); ?>" required>
                    <div class="update_password_button_container">
                        <input class="update_password_button" type="submit" value="Update Password">
                    </div>
                </form>

            </div>
        </div>
    </main>

    <div class="confirm_password_modal">
        <form class="confirm_password_form">
            <h5>For your security, please re-enter your password to continue</h5>
            <p class="warning_prompt password">Wrong password, please try again</p>
            <input class="form_type" type="hidden" name="form_type">
            <input class="username_modal" type="hidden" name="username" value="<?php echo $username ?>">
            <input class="password_modal" type="password" placeholder="Password" required>
            <input type="submit" value="Continue">
        </form>

        <img class="x_icon" src="../images/icons/x_icon.png" alt="">
    </div>

    <div class="background_overlay">
    </div>

    <div class="success_alert profile_picture_update">
        <p>Profile picture was updated successfully!</p>
    </div>
    <div class="success_alert profile_details_update">
        <p>Profile details were updated successfully!</p>
    </div>
    <div class="success_alert password_update">
        <p>Account's password was updated successfully!</p>
    </div>
    <div class="success_alert username_already_taken warning_profile">
        <p>Error updating! Username already taken.</p>
    </div>

    <script defer src="../scripts/dashboard/profile_dropdown.js"></script>
    <script defer src="../scripts/profile/profile.js"></script>
    <script defer src="../scripts/profile/profile_picture_edit.js"></script>
    <script defer src="../scripts/profile/profile_details_edit.js"></script>
    <script defer src="../scripts/profile/confirm_password_modal.js"></script>
</body>

</html>

<?php unset($_SESSION['form_data']); ?>