let originalValues = {};

document.querySelector('.edit_button.profile_details').addEventListener('click', function () {

    const confirmButtonsPicture = document.querySelector('.confirm_buttons.profile_picture')
    if (confirmButtonsPicture.style.display == 'block') {

        confirmButtonsPicture.style.display = 'none';
        const profilePicture = document.querySelector('.profile_picture');
        profilePicture.src = profilePicture.dataset.profilePictureUrl;
        document.querySelector('.file_input').value = '';
    }

    document.querySelectorAll('.input_toggle').forEach(function(element) {
        originalValues[element.name] = element.value;
        element.disabled = false;
    }) 

    const input = document.querySelector('.input_toggle');
    input.focus();
    input.setSelectionRange(input.value.length, input.value.length);

    document.querySelector('.confirm_buttons.profile_details').style.display = 'block';
})

function checkForChanges () {
    let hasChanges = false;
    let allFieldsFilled = true; 

    document.querySelectorAll('.input_toggle').forEach(function(element) {
        if (element.value == '') {
            allFieldsFilled = false;
        }

        if (element.value !== originalValues[element.name]) {
            hasChanges = true;
        }
    })

    if (hasChanges && allFieldsFilled) {
        document.querySelector('.confirm_details_change').classList.remove('disabled');
        document.querySelector('.confirm_details_change').disabled = false;
    } else {
        document.querySelector('.confirm_details_change').classList.add('disabled');
        document.querySelector('.confirm_details_change').disabled = true;
    }
}

document.querySelectorAll('.input_toggle').forEach(function(element){
    element.addEventListener('input', checkForChanges)  
})

document.querySelector('.confirm_details_change').addEventListener('click', function() {
    let formValid = true;
    document.querySelectorAll('.input_toggle').forEach(function(element) {
        if(!element.checkValidity()) {
            formValid = false;
            element.reportValidity();
            return;
        }
    })

    if (formValid) {
        document.querySelector('.form_type').value = this.dataset.formType;

        document.querySelector('.confirm_password_modal').classList.add('clicked');
        document.querySelector('.background_overlay').classList.add('clicked');
    }
})

document.querySelector('.cancel_details_change').addEventListener('click', function() {

    document.querySelector('.confirm_buttons.profile_details').style.display = 'none';

    document.querySelectorAll('.input_toggle').forEach(function(element) {
        element.value = originalValues[element.name];
        element.disabled = true;
    }) 
})

document.querySelector('.birthday').addEventListener('input', birthdayInput)

function birthdayInput() {
    const birthday = new Date(this.value)
    const today = new Date

    let age = today.getFullYear() - birthday.getFullYear()

    document.querySelector('.age').value = age
    document.querySelector('.age_hidden').value = age
} 

