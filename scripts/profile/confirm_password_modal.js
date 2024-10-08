document.querySelector('.confirm_password_form').addEventListener('submit', function(e) {

    e.preventDefault();
    const formType = document.querySelector('.form_type').value;
    const password = document.querySelector('.password_modal').value;
    const username = document.querySelector('.username_modal').value;

    fetch('../process/profile/verify_password.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password)
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            document.querySelector(`.${formType}`).submit();
        } else {
            document.querySelector('.warning_prompt.password').style.display = 'block';
        }
    })
})

document.querySelector('.x_icon').addEventListener('click', function() {

    document.querySelector('.confirm_password_modal').classList.remove('clicked');
    document.querySelector('.background_overlay').classList.remove('clicked');

    setTimeout(function () {
        document.querySelector('.warning_prompt.password').style.display = 'none';
        document.querySelector('.password_modal').value = '';
    }, 500)
})