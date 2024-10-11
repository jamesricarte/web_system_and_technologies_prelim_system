<?php
if (isset($_SESSION['file_image']) && $_SESSION['file_image'] == false) {
    echo "<script>
                    window.onload = function () {
                    document.querySelector('.warning.file_image').style.display = 'initial';
                    }
                </script>";

    $_SESSION['file_image'] = null;
}

if (isset($_SESSION['file_size']) && $_SESSION['file_size'] == false) {
    echo "<script>
                    window.onload = function () {
                    document.querySelector('.warning.file_size').style.display = 'initial';
                    }
                </script>";

    $_SESSION['file_size'] = null;
}

if (isset($_SESSION['file_format']) && $_SESSION['file_format'] == false) {
    echo "<script>
                    window.onload = function () {
                    document.querySelector('.warning.file_format').style.display = 'initial';
                    }
                </script>";

    $_SESSION['file_format'] = null;
}

if (isset($_SESSION['match_password']) && $_SESSION['match_password'] == false) {
    echo "<script>
                    window.onload = function () {
                    document.querySelector('.warning.current_password').style.display = 'initial';
                    }
                </script>";

    $_SESSION['match_password'] = null;
}

if (isset($_SESSION['confirm_password']) && $_SESSION['confirm_password'] == false) {
    echo "<script>
                    window.onload = function () {
                    document.querySelector('.warning.confirm_password').style.display = 'initial';
                    }
                </script>";

    $_SESSION['confirm_password'] = null;
}

if (isset($_SESSION['same_password']) && $_SESSION['same_password'] == true) {
    echo "<script>
                    window.onload = function () {
                    document.querySelector('.warning.same_password').style.display = 'initial';
                    }
                </script>";

    $_SESSION['same_password'] = null;
}

//Success alerts

if (isset($_SESSION['profile_update_success']) && $_SESSION['profile_update_success'] == true) {
    echo "<script>
                    window.onload = function () {
                        const successAlert = document.querySelector('.success_alert.profile_picture_update');
                        successAlert.classList.add('active');

                        setTimeout(function(){
                            successAlert.classList.remove('active');
                        }, 4000)
                    }
                </script>";

    $_SESSION['profile_update_success'] = null;
}

if (isset($_SESSION['profile_details_update_success']) && $_SESSION['profile_details_update_success'] == true) {
    echo "<script>
                    window.onload = function () {
                        const successAlert = document.querySelector('.success_alert.profile_details_update');
                        successAlert.classList.add('active');

                        setTimeout(function(){
                            successAlert.classList.remove('active');
                        }, 4000)
                    }
                </script>";

    $_SESSION['profile_details_update_success'] = null;
}

if (isset($_SESSION['update_password_success']) && $_SESSION['update_password_success'] == true) {
    echo "<script>
                    window.onload = function () {
                        const successAlert = document.querySelector('.success_alert.password_update');
                        successAlert.classList.add('active');

                        setTimeout(function(){
                            successAlert.classList.remove('active');
                        }, 4000)
                    }
                </script>";

    $_SESSION['update_password_success'] = null;
}

if (isset($_SESSION['username_already_taken']) && $_SESSION['username_already_taken'] == true) {
    echo "<script>
                    window.onload = function () {
                        const successAlert = document.querySelector('.success_alert.username_already_taken');
                        successAlert.classList.add('active');

                        setTimeout(function(){
                            successAlert.classList.remove('active');
                        }, 4000)
                    }
                </script>";

    $_SESSION['username_already_taken'] = null;
}
