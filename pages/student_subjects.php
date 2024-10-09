<?php
require_once('../database/database.php');
session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

if (empty($_GET['studentId'])) {
    header('Location: dashboard.php');
}

if (isset($_SESSION['isSidebarMinimized']) && $_SESSION['isSidebarMinimized']) {
    $labelWrapperDisplay = 'none';
} else {
    $labelWrapperDisplay = 'initial';
}

$stmt_user = $conn->prepare("SELECT registration.first_name, registration.profile_picture
    FROM login
    JOIN registration ON login.reg_id = registration.reg_id
    WHERE login.login_id = ?");
$stmt_user->bind_param("i", $_SESSION['id']);
$stmt_user->execute();
$stmt_user->bind_result($user_first_name, $profile_picture);
$stmt_user->fetch();
$stmt_user->close();

if ($profile_picture === null) {
    $profile_picture = '../images/sample_profile.jpg';
} else {
    $profile_picture = '../images/user_profile_pictures/' . $_SESSION['id'] . '/' . $profile_picture;
}

$stmt_student = $conn->prepare("SELECT first_name, last_name, middle_name FROM students WHERE student_id = ?");
$stmt_student->bind_param("i", $_GET['studentId']);
$stmt_student->execute();
$stmt_student->bind_result($student_first_name, $student_last_name, $student_middle_name);
if (!$stmt_student->fetch()) {
    header('Location: dashboard.php');
}
$stmt_student->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Subjects</title>
    <link rel="stylesheet" href="../styles/dashboard/dashboard.css">
    <link rel="stylesheet" href="../styles/default.css">
    <link rel="stylesheet" href="../styles/nav/nav.css">
    <link rel="stylesheet" href="../styles/student_subjects/student_subjects.css">
</head>

<body>

    <?php include('partials/nav.php') ?>

    <main>
        <div class="section_column">
            <div class="left_section">

                <div class="navigation_links selected">
                    <div class="sidebar_icon_wrapper">
                        <img class="home_icon" src="../images/icons/home_icon.png" alt="">
                    </div>
                    <div class="sidebar_label_wrapper" style="display: <?php echo $labelWrapperDisplay; ?> ;">
                        <h5>Dashboard</h5>
                    </div>
                </div>
            </div>

            <div class="right_section">
                <div class="details_container">
                    <div class="details_wrapper">
                        <div class="back_button_wrapper">
                            <a class="back_dashboard_link" href="dashboard.php">
                                <img class="back_icon" src="../images/icons/back_icon.png">
                                <p>Back to Dashboard</p>
                            </a>
                        </div>
                        <p>Student Name:</p>
                        <h2>James Cao Ricarte</h2>
                        <p>School ID: 07110972</p>
                        <p>Course: BSCS</p>
                        <p>Year Level: 3</p>
                        <h3 style="margin-top: 20px; margin-bottom: 5px;">Subjects:</h3>
                        <button class="edit_subjects_button">Edit Subjects</button>

                        <table>
                            <thead>
                                <tr>
                                    <th>Catalog No.</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th>Block</th>
                                    <th>Section</th>
                                    <th>Room</th>
                                    <th>Teacher</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>CC105A</td>
                                    <td>APPLICATION DEVELOPMENT & EMERGING TECHNOLOGIES (MOBILE DEV'T.)</td>
                                    <td>3.0</td>
                                    <td>B</td>
                                    <td>09:30-12:00 MW</td>
                                    <td>317B-GSBM</td>
                                    <td>DETERA, EMMANUEL ISAIAH ZUÑIGA</td>
                                </tr>
                                <tr>
                                    <td>IT ELEC 04 WT</td>
                                    <td>WEB SYSTEMS & TECHNOLOGIES</td>
                                    <td>3.0</td>
                                    <td>B</td>
                                    <td>09:30-12:00 ThSa</td>
                                    <td>318CompL</td>
                                    <td>ALAMO, DHAN DAVISH VERGARA</td>
                                </tr>
                                <tr>
                                    <td>IT PC 311</td>
                                    <td>ADVANCE DATABASE SYSTEMS</td>
                                    <td>3.0</td>
                                    <td>B</td>
                                    <td>13:00-15:30 TF</td>
                                    <td>317A-GSBM</td>
                                    <td>SERRANO, JP REMAR ALITA</td>
                                </tr>
                                <tr>
                                    <td>IT PC 312</td>
                                    <td>NETWORKING 2</td>
                                    <td>3.0</td>
                                    <td>A</td>
                                    <td>15:30-18:00 MW</td>
                                    <td>315CompL</td>
                                    <td>PARILLAS, Victor Jr. Quinzon</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <div class="edit_subjects_modal">
        <button class="add_schedule_button">Add</button>
        <button>Delete</button>
        <table>
            <tbody>
                <tr>
                    <td>CC105A</td>
                    <td>APPLICATION DEVELOPMENT & EMERGING TECHNOLOGIES (MOBILE DEV'T.)</td>
                    <td>3.0</td>
                    <td>B</td>
                    <td>09:30-12:00 MW</td>
                    <td>317B-GSBM</td>
                    <td>DETERA, EMMANUEL ISAIAH ZUÑIGA</td>
                </tr>
                <tr>
                    <td>IT ELEC 04 WT</td>
                    <td>WEB SYSTEMS & TECHNOLOGIES</td>
                    <td>3.0</td>
                    <td>B</td>
                    <td>09:30-12:00 ThSa</td>
                    <td>318CompL</td>
                    <td>ALAMO, DHAN DAVISH VERGARA</td>
                </tr>
                <tr>
                    <td>IT PC 311</td>
                    <td>ADVANCE DATABASE SYSTEMS</td>
                    <td>3.0</td>
                    <td>B</td>
                    <td>13:00-15:30 TF</td>
                    <td>317A-GSBM</td>
                    <td>SERRANO, JP REMAR ALITA</td>
                </tr>
                <tr>
                    <td>IT PC 312</td>
                    <td>NETWORKING 2</td>
                    <td>3.0</td>
                    <td>A</td>
                    <td>15:30-18:00 MW</td>
                    <td>315CompL</td>
                    <td>PARILLAS, Victor Jr. Quinzon</td>
                </tr>
                <tr>
                    <td>IT PC 312</td>
                    <td>NETWORKING 2</td>
                    <td>3.0</td>
                    <td>A</td>
                    <td>15:30-18:00 MW</td>
                    <td>315CompL</td>
                    <td>PARILLAS, Victor Jr. Quinzon</td>
                </tr>
                <tr>
                    <td>IT PC 312</td>
                    <td>NETWORKING 2</td>
                    <td>3.0</td>
                    <td>A</td>
                    <td>15:30-18:00 MW</td>
                    <td>315CompL</td>
                    <td>PARILLAS, Victor Jr. Quinzon</td>
                </tr>
                <tr>
                    <td>IT PC 312</td>
                    <td>NETWORKING 2</td>
                    <td>3.0</td>
                    <td>A</td>
                    <td>15:30-18:00 MW</td>
                    <td>315CompL</td>
                    <td>PARILLAS, Victor Jr. Quinzon</td>
                </tr>
            </tbody>
        </table>
        <img class="x_icon" src="../images/icons/x_icon.png">
    </div>

    <div class="add_subject_modal">
        <form action="">
            <select name="" id="">
                <option value="">CC105</option>
                <option value="">CC106</option>
                <option value="">CC107</option>
                <option value="">CC107</option>
                <option value="">CC107</option>
                <option value="">CC107</option>
            </select>
            <button class="add_subject_add_subject" type="submit">Add Subject</button>
        </form>

        <img class="x_icon" src="../images/icons/x_icon.png">
    </div>

    <div class="background_overlay">

    </div>

    <script defer src="../scripts/dashboard/dashboard.js"></script>
    <script defer src="../scripts/dashboard/profile_dropdown.js"></script>
    <script defer src="../scripts/student_subjects/student_subjects.js"></script>
</body>

</html>