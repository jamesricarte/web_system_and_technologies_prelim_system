document.querySelector('.edit_button.profile_picture').addEventListener('click', function () {

    const confirmButtonsDetails = document.querySelector('.confirm_buttons.profile_details')
    if (confirmButtonsDetails.style.display == 'block') {
        confirmButtonsDetails.style.display = 'none';
    }

    document.querySelectorAll('.input_toggle').forEach(function(element) {
        if (element.disabled === false) {
            element.value = originalValues[element.name];
            element.disabled = true;
        }
    }) 

    document.querySelector('.file_input').click();
})

document.querySelector('.file_input').addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {

        if (file.type.startsWith('image/')) {
            const fileName = file.name.toLowerCase();
            const fileExtension = fileName.split('.').pop();
    
            const acceptedImageTypes = ['jpeg', 'png', 'gif', 'jpg'];
    
            if (acceptedImageTypes.includes(fileExtension)) {
    
                const reader = new FileReader();
                reader.onload = function (e) {
        
                    document.querySelector('.profile_picture').src = e.target.result;
            
                    document.querySelector('.confirm_buttons.profile_picture').style.display = 'block';
    
                    const warningFileImage = document.querySelector('.warning.file_image');             
                    const warningFileFormat = document.querySelector('.warning.file_format');
    
                    if (warningFileImage) {
                        warningFileImage.style.display = 'none';
                    }
    
                    if (warningFileFormat) {
                        warningFileFormat.style.display = 'none';
                    }
                }
    
                reader.readAsDataURL(file);
    
            } else {
                const warningFileImage = document.querySelector('.warning.file_image');             

                if (warningFileImage) {
                    warningFileImage.style.display = 'none';
                }

                console.log('File not supported');
                document.querySelector('.warning.file_format').style.display = 'block';
            }

        } else {

            const warningFileFormat = document.querySelector('.warning.file_format');

            if (warningFileFormat) {
                warningFileFormat.style.display = 'none';
            }

            console.log('File is not an image')
            document.querySelector('.warning.file_image').style.display = 'block';
        }

        const warningLabel = document.querySelectorAll('.warning');
        warningLabel.forEach( function(element) {
            if (element.style.display == 'initial') {
                element.style.display = 'none';
            }   
        })
    }
})

document.querySelector('.confirm_change').addEventListener('click', function() {
    
    // document.querySelector('.form_type').value = this.dataset.formType;

    // document.querySelector('.confirm_password_modal').classList.add('clicked');
    // document.querySelector('.background_overlay').classList.add('clicked');

    document.querySelector('.profile_form').submit();
})

document.querySelector('.cancel_change').addEventListener('click', function() {
    const profilePicture = document.querySelector('.profile_picture');
    profilePicture.src = profilePicture.dataset.profilePictureUrl;
    document.querySelector('.file_input').value = '';

    document.querySelector('.confirm_buttons').style.display = 'none';

    document.querySelector('.file_input').value = '';
})