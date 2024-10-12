const hamburgerIcon = document.querySelector('.hamburger_icon_container');
const sidebarLabel =  document.querySelector('.sidebar_label_wrapper');
let isSidebarMinimized = localStorage.getItem('isSidebarMinimized') || false;

if (hamburgerIcon && sidebarLabel) {

    hamburgerIcon.addEventListener('click', function() {
        if (sidebarLabel.style.display !=='none') {
            sidebarLabel.style.display = 'none';
            isSidebarMinimized = true;
        } else {
            sidebarLabel.style.display = 'initial';
            isSidebarMinimized = false;
        }
        localStorage.setItem('isSidebarMinimized', isSidebarMinimized);

        fetch('../process/dashboard/update_sidebar_state.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'isSidebarMinimized=' + encodeURIComponent(isSidebarMinimized ? 'true' : 'false')
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // console.log('success');
            }
        })
    })
}   

if (window.location.pathname == '/web_system_and_technologies_prelim_system/pages/profile.php') {
    document.querySelector('.profile_dropdown_sections.profile').style.display = 'none';
    hamburgerIcon.style.display = 'none';
} else {
    document.querySelector('.profile_dropdown_sections.dashboard').style.display = 'none';
    document.querySelector('.profile_dropdown_sections.profile').classList.add('first');
}