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
    WHERE login.reg_id = ?");
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

$stmt_student = $conn->prepare("SELECT first_name, last_name, middle_name, school_id, course, year_level FROM students WHERE student_id = ?");
$stmt_student->bind_param("i", $_GET['studentId']);
$stmt_student->execute();
$stmt_student->bind_result($student_first_name, $student_last_name, $student_middle_name, $school_id, $course, $year_level);
if (!$stmt_student->fetch()) {
    header('Location: dashboard.php');
}
$stmt_student->close();

$stmt_student_schedules = $conn->prepare("SELECT student_schedules.student_schedule_id, subjects.catalog_number, subjects.descriptive_title, subjects.units, blocks.block_name, schedules.start_time, schedules.end_time, schedules.day_of_week, rooms.room_name, teachers.first_name, teachers.last_name, teachers.middle_name
FROM student_schedules
JOIN students ON student_schedules.student_id = students.student_id
JOIN schedules ON student_schedules.schedule_id = schedules.schedule_id
JOIN subjects ON schedules.subject_id = subjects.subject_id
JOIN blocks ON schedules.block_id = blocks.block_id
JOIN rooms ON schedules.room_id = rooms.room_id
JOIN teachers ON schedules.teacher_id = teachers.teacher_id
WHERE student_schedules.student_id = ?");
$stmt_student_schedules->bind_param('i', $_GET['studentId']);
$stmt_student_schedules->execute();
$stmt_student_schedules->bind_result($student_schedule_id, $catalog_number, $descriptive_title, $units, $block_name, $start_time, $end_time, $day_of_week, $room_name, $teacher_first_name, $teacher_last_name, $teacher_middle_name);
$student_schedules = [];
while ($stmt_student_schedules->fetch()) {
    $student_schedules[] = [
        'student_schedule_id' => $student_schedule_id,
        'catalog_number' => $catalog_number,
        'descriptive_title' => $descriptive_title,
        'units' => $units,
        'block_name' => $block_name,
        'start_time' => $start_time,
        'end_time' => $end_time,
        'day_of_week' => $day_of_week,
        'room_name' => $room_name,
        'teacher_full_name' => $teacher_first_name . " " . $teacher_middle_name . " " . $teacher_last_name
    ];
}
$stmt_student_schedules->close();

$stmt_schedules = $conn->prepare("SELECT schedules.schedule_id, subjects.catalog_number, subjects.descriptive_title, blocks.block_name, schedules.start_time, schedules.end_time, schedules.day_of_week, rooms.room_name, teachers.first_name, teachers.last_name, teachers.middle_name
FROM schedules
JOIN subjects ON schedules.subject_id = subjects.subject_id
JOIN blocks ON schedules.block_id = blocks.block_id
JOIN rooms ON schedules.room_id = rooms.room_id
JOIN teachers ON schedules.teacher_id = teachers.teacher_id
");
$stmt_schedules->execute();
$stmt_schedules->bind_result($schedule_id, $catalog_number, $descriptive_title, $block_name, $start_time, $end_time, $day_of_week, $room_name, $teacher_first_name, $teacher_last_name, $teacher_middle_name);

$schedules = [];
while ($stmt_schedules->fetch()) {
    $schedules[] = [
        'schedule_id' => $schedule_id,
        'catalog_number' => $catalog_number,
        'descriptive_title' => $descriptive_title,
        'block_name' => $block_name,
        'start_time' => $start_time,
        'end_time' => $end_time,
        'day_of_week' => $day_of_week,
        'room_name' => $room_name,
        'teacher_full_name' => $teacher_first_name . " " . $teacher_middle_name . " " . $teacher_last_name
    ];
}

$stmt_schedules->close();
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
                        <h2><?php echo $student_first_name . " " . $student_middle_name . " " . $student_last_name ?></h2>
                        <p>School ID: <?php echo $school_id ?></p>
                        <p>Course: <?php echo $course ?></p>
                        <p>Year Level: <?php echo $year_level ?></p>
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
                            <?php foreach ($student_schedules as $schedule) {
                                $time = $schedule['start_time'] . "-" . $schedule['end_time'] . " " . $schedule['day_of_week'];
                                echo "<tbody>
                                <tr>
                                    <td>{$schedule['catalog_number']}</td>
                                    <td>{$schedule['descriptive_title']}</td>
                                    <td>{$schedule['units']}</td>
                                    <td>{$schedule['block_name']}</td>
                                    <td>{$time}</td>
                                    <td>{$schedule['room_name']}</td>
                                    <td>{$schedule['teacher_full_name']}</td>
                                </tr>
                            </tbody>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <div class="edit_subjects_modal">
        <div class="buttons_container">
            <button class="add_schedule_button">Add</button>
            <form class="delete_subject_form" action="../process/student_subjects/delete_subject.php" method="post">
                <input type="hidden" name="student_schedule_id">
                <input type="hidden" name="student_id" value="<?php echo $_GET['studentId'] ?>">
                <button type="submit" class="delete_schedule_button disable" disabled>Delete</button>
            </form>
        </div>
        <table>
            <?php foreach ($student_schedules as $schedule) {
                $time = $schedule['start_time'] . "-" . $schedule['end_time'] . " " . $schedule['day_of_week'];

                echo "<tbody>
                    <tr data-schedule-id='{$schedule['student_schedule_id']}'>
                        <td>{$schedule['catalog_number']}</td>
                        <td>{$schedule['descriptive_title']}</td>
                        <td>{$schedule['units']}</td>
                        <td>{$schedule['block_name']}</td>
                        <td>{$time}</td>
                        <td>{$schedule['room_name']}</td>
                        <td>{$schedule['teacher_full_name']}</td>
                    </tr>
                </tbody>";
            }
            ?>
        </table>
        <img class="x_icon" src="../images/icons/x_icon.png">
    </div>

    <div class="add_subject_modal">
        <form action="../process/student_subjects/add_subject.php" method="post">
            <input type="hidden" name="student_id" value="<?php echo $_GET['studentId'] ?>">
            <select name="schedule_id">
                <?php
                foreach ($schedules as $schedule) {
                    echo '<option value="' . $schedule['schedule_id'] . '">' . $schedule['catalog_number'] . " " . $schedule['descriptive_title'] . " " . $schedule['block_name'] . " " . $schedule['teacher_full_name'] . '</option>';
                }
                ?>
            </select>
            <button class="add_subject_modal_add_button" type="submit">Add Subject</button>
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