<?php
if (empty($_SESSION['id'])) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

$stmt_user_nav = $conn->prepare("SELECT registration.first_name, registration.profile_picture
    FROM login
    JOIN registration ON login.reg_id = registration.reg_id
    WHERE login.reg_id = ?");
$stmt_user_nav->bind_param("i", $_SESSION['id']);
$stmt_user_nav->execute();
$stmt_user_nav->bind_result($user_first_name, $profile_picture);
$stmt_user_nav->fetch();
$stmt_user_nav->close();

if ($profile_picture === null) {

    $colors = ['#B97A5D', '#6DA67A', '#7A8DB9', '#C58DAE', '#7AB9B1', '#C2B280'];

    $randomColorKey = array_rand($colors);
    $randomColor = $colors[$randomColorKey];

    $randomColorKey = array_rand($colors);
    $randomColor = $colors[$randomColorKey];

    $output_profile_picture = "<div class='profile-icon profile_picture_default' style='background-color: {$randomColor};'>
        <h3>" . strtoupper(substr($user_first_name, 0, 1)) . "</h3>
    </div>";

    include('image_generator/profile_picture_default_generator.php');
} else {
    $profile_picture_path = '../images/user_profile_pictures/' . $_SESSION['id'] . '/' . $profile_picture;
    $output_profile_picture = "<img src='{$profile_picture_path}' class='profile-icon'>";
}
?>

<nav>
    <div class="nav_left_section">
        <div class="hamburger_icon_container">
            <img class="hamburger_icon" src="../images/icons/hamburger_icon.png" alt="">
        </div>
        <a href="dashboard.php">
            <div class="brand_name_container">
                <img class="brand_logo" src="../images/logos/dwcl_logo.png" alt="Divine World of College of Legazpi Logo">
                <p class="brand_name">Divine World of College of Legazpi</p>
            </div>
        </a>
        <div class="search_bar_container">
            <input class="search_bar" type="text" placeholder="Search students by name or id">
            <img class="search_icon" src="../images/icons/search_icon.png">
        </div>
    </div>

    <div class="nav-right-section">
        <?php echo $output_profile_picture ?>
        <h5 class="user_name"><?php echo $user_first_name; ?></h5>
    </div>

    <div class="profile_dropdown">
        <a href="dashboard.php">
            <div class="profile_dropdown_sections dashboard first">
                <p>Dashboard</p>
            </div>
        </a>
        <a href="profile.php">
            <div class="profile_dropdown_sections profile">
                <p>Profile</p>
            </div>
        </a>
        <div class="profile_dropdown_sections">
            <p>Settings</p>
        </div>
        <form class="logout_button" action="../process/auth/logout.php" method="POST">
            <button type="submit" name="logout">Log out</button>
        </form>
    </div>
</nav>

<script defer src="../scripts/nav/sidebar_toggle.js"></script>