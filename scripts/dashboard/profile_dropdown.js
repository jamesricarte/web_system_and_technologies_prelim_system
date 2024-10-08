const profileIcon = document.querySelector('.profile-icon');
const userName = document.querySelector('.user_name');

const toggleProfileDropdown = function() {
    const profileDropdown = document.querySelector('.profile_dropdown');
    profileDropdown.style.visibility = (profileDropdown.style.visibility !== 'visible') ? 'visible' : 'hidden';
};

profileIcon.addEventListener("click", toggleProfileDropdown);
userName.addEventListener("click", toggleProfileDropdown);
