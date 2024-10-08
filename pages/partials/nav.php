<?php
if (empty($_SESSION['id'])) {
    header("HTTP/1.1 404 Not Found");
    exit;
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
        <img src="<?php echo $profile_picture ?>" class="profile-icon">
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