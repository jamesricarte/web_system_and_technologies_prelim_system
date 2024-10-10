document.querySelector('.edit_subjects_button').addEventListener('click', function(){
    document.querySelector('.edit_subjects_modal').classList.add('clicked');
    document.querySelector('.background_overlay').classList.add('clicked');
})

document.querySelector('.edit_subjects_modal .x_icon').addEventListener('click', function(){
    document.querySelector('.edit_subjects_modal').classList.remove('clicked');
    document.querySelector('.background_overlay').classList.remove('clicked');
    
    document.querySelector('.add_subject_modal').classList.remove('clicked');
})

document.querySelector('.add_schedule_button').addEventListener('click', function(){
    document.querySelector('.add_subject_modal').classList.add('clicked');
    // document.querySelector('.background_overlay').classList.add('clicked');
    document.querySelector('.edit_subjects_modal').style.pointerEvents = 'none';
})

document.querySelector('.add_subject_modal .x_icon').addEventListener('click', function(){
    document.querySelector('.add_subject_modal').classList.remove('clicked');
    // document.querySelector('.background_overlay').classList.remove('clicked');
    document.querySelector('.edit_subjects_modal').style.pointerEvents = 'initial';
})

//Add Subjects Modal Table
const editSubjectsModalTableTr = document.querySelectorAll('.edit_subjects_modal table tbody tr');
const deleteScheduleButton = document.querySelector('.delete_schedule_button');
const hiddenInput = document.querySelector('input[name="student_schedule_id"]');

editSubjectsModalTableTr.forEach(function(tr) {
    tr.addEventListener('click', function() {

        editSubjectsModalTableTr.forEach(function(row) {
            row.style.backgroundColor = '';
        });

        tr.style.backgroundColor = 'rgb(244, 244, 244)';

        deleteScheduleButton.classList.remove('disable');
        deleteScheduleButton.removeAttribute('disabled');

        const scheduleId = tr.getAttribute('data-schedule-id');

        hiddenInput.value = scheduleId;
    })
});

document.querySelector('.delete_subject_form').addEventListener('submit', function(event) {
    event.preventDefault();

    const confirmDelete = confirm('Are you sure you want to delete this subject?');

    if (confirmDelete) {
        this.submit();
    }
})