<?php
require_once('../database/database.php');
session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
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

$courses = [];
$stmt_courses = $conn->prepare("SELECT course_id, course_name FROM courses");
$stmt_courses->execute();
$stmt_courses->bind_result($course_id, $course_name);
while ($stmt_courses->fetch()) {
    $courses[] = [
        'output_course_id' => $course_id,
        'output_course_name' => $course_name
    ];
};
$stmt_courses->close();

$stmt = $conn->prepare("SELECT students.student_id, students.first_name, students.last_name, students.middle_name, students.school_id, courses.course_name, students.year_level, students.status
     FROM students
     JOIN courses ON students.course = course_id
     LEFT JOIN statuses ON students.status = status_id
     WHERE students.reg_id = ?");
$stmt->bind_param("i", $_SESSION["id"]);
$stmt->execute();
$stmt->bind_result($student_id, $first_name, $last_name, $middle_name, $school_id, $course, $year_level, $status);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/dashboard/dashboard.css">
    <link rel="stylesheet" href="../styles/default.css">
    <link rel="stylesheet" href="../styles/dashboard/table.css">
    <link rel="stylesheet" href="../styles/dashboard/status.css">
    <link rel="stylesheet" href="../styles/dashboard/update_window.css">
    <link rel="stylesheet" href="../styles/dashboard/add_student_modal.css">
    <link rel="stylesheet" href="../styles/nav/nav.css">
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
                <div class="add_student_button_wrapper">
                    <button class="add_student_button">Add Student <b>+</b></button>
                </div>

                <table>
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Student Name</td>
                            <td>School ID</td>
                            <td>Status</td>
                            <td>Course</td>
                            <td>Year Level</td>
                            <td>Operation</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 1;
                        while ($stmt->fetch()) {

                            if (strlen($middle_name) == 1) {
                                $output_middle_name = $middle_name . ".";
                            } else {
                                $output_middle_name = $middle_name;
                            }

                            if ($status == 1) {
                                $output_status = "
                                        <div class='status_button present'>Present</div>
                                        <div class='status_button js-absent'>Absent</div>
                                        <div class='status_button js-late'>Late</div>";
                            } else if ($status == 2) {
                                $output_status = "
                                        <div class='status_button js-present'>Present</div>
                                        <div class='status_button absent'>Absent</div>
                                        <div class='status_button js-late'>Late</div>";
                            } else if ($status == 3) {
                                $output_status = "
                                        <div class='status_button js-present'>Present</div>
                                        <div class='status_button js-absent'>Absent</div>
                                        <div class='status_button late'>Late</div>";
                            } else {
                                $output_status = "
                                        <div class='status_button js-present'>Present</div>
                                        <div class='status_button js-absent'>Absent</div>
                                        <div class='status_button js-late'>Late</div>";
                            }
                            echo
                            "<tr>
                                    <td class='student_id' data-student-id='$student_id'>$student_id</td>
                                    <td>$index</td>
                                    <td data-first-name='$first_name' data-middle-name='$middle_name' data-last-name='$last_name'>$first_name $output_middle_name $last_name</td>
                                    <td data-school-id='$school_id'>$school_id</td>
                                    <td class='status_td' data-status='$status'>
                                        $output_status
                                    </td>
                                    <td data-course='$course'>$course</td>
                                    <td data-year-level='$year_level'>$year_level</td>
                                    <td class='operation_td'>
                                        <div>
                                            <a href='student_subjects.php?studentId=$student_id'>
                                                <button class='view_subjects_button'>View Subjects</button>
                                            </a>
                                        </div>
                                        <div class='icon_wrapper edit'>
                                            <img class='edit_icon' src='../images/icons/edit_icon.png'>
                                            <span class='tooltip edit'>Edit</span>
                                        </div>
                                        <div class='icon_wrapper delete'>
                                            <img class='delete_icon' src='../images/icons/delete_icon.png' alt=''>
                                            <span class='tooltip delete'>Delete</span>
                                        </div>
                                    </td>
                                </tr>";
                            $index++;
                        }
                        ?>

                    </tbody>
                </table>
            </div>

        </div>
    </main>

    <div class="update_window">
        <div class="update_window_wrapper">
            <form class="update_student_form" action="../process/dashboard/update_student.php" method="post">
                <h4 class="edit_details_label">Edit Details:</h4>
                <input type="hidden" name="student_id" id="update_student_id">
                <label for="update_first_name">Student Name:</label>
                <input type="text" placeholder="First Name" name="first_name" id="update_first_name" required>
                <input type="text" placeholder="Last Name" name="last_name" id="update_last_name" required>
                <input type="text" placeholder="Middle Initial or Name" name="middle_name" id="update_middle_name">

                <label for="update_status">Status</label>
                <select name="status" id="update_status" required>
                    <option value="1">Present</option>
                    <option value="2">Absent</option>
                    <option value="3">Late</option>
                </select>

                <label class="school_id_label other_labels" for="update_school_id">School ID:</label>
                <input class="other_inputs" type="text" name="school_id" id="update_school_id" required>
                <label class="other_labels" for="update_course">Course:</label>
                <select class="other_inputs" name="course" id="update_course" required>
                    <?php
                    foreach ($courses as $course) {
                        echo "<option value='" . $course["output_course_id"] . "'>" . $course["output_course_name"] . "</option>";
                    }
                    ?>
                </select>
                <label class="other_labels" for="update_year_level">Year Level:</label>
                <select class="other_inputs" name="year_level" id="update_year_level" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
                <div class="submit_button_wrapper">
                    <button class="update_button" type="submit">Update</but>
                </div>

            </form>

            <img class="x_icon" src="../images/icons/x_icon.png" alt="">

        </div>
    </div>

    <div class="add_student_modal">
        <form class="add_student_form" action="../process/dashboard/add_student.php" method="post">
            <label for="first_name">Student Name:</label>
            <input type="text" placeholder="First Name" name="first_name" id="first_name" required>
            <input type="text" placeholder="Last Name" name="last_name" id="last_name" required>
            <input type="text" placeholder="Middle Initial or Name" name="middle_name" id="middle_name" required>

            <label class="school_id_label other_labels" for="school_id">School ID:</label>
            <input class="other_inputs" type="text" placeholder="School ID" name="school_id" id="school_id" required>

            <label class="other_labels" for="course">Course:</label>
            <select class="other_inputs js-course-loop" name="course" id="course">
                <?php
                foreach ($courses as $course) {
                    echo "<option value='" . $course["output_course_id"] . "'>" . $course["output_course_name"] . "</option>";
                }
                ?>
            </select>

            <label class="other_labels" for="year_level">Year Level:</label>
            <select class="other_inputs" name="year_level" id="year_level">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>

            <button class="add_button" type="submit">Add Student</button>
        </form>

        <img class="x_icon_2" src="../images/icons/x_icon.png" alt="">
    </div>

    <div class="background_overlay">

    </div>

    <script defer src="../scripts/dashboard/dashboard.js"></script>
    <script defer src="../scripts/dashboard/profile_dropdown.js"></script>
    <script defer src="../scripts/dashboard/status.js"></script>
    <script defer src="../scripts/dashboard/update_window_show.js"></script>
    <script defer src="../scripts/dashboard/add_student_modal.js"></script>
</body>

</html>