document.querySelector('.edit_subjects_button').addEventListener('click', function(){
    document.querySelector('.edit_subjects_modal').classList.add('clicked');
    document.querySelector('.background_overlay').classList.add('clicked');
})

document.querySelector('.edit_subjects_modal .x_icon').addEventListener('click', function(){
    document.querySelector('.edit_subjects_modal').classList.remove('clicked');
    document.querySelector('.background_overlay').classList.remove('clicked');
})

document.querySelector('.add_schedule_button').addEventListener('click', function(){
    document.querySelector('.add_subject_modal').classList.add('clicked');
    // document.querySelector('.background_overlay').classList.add('clicked');
})

document.querySelector('.add_subject_modal .x_icon').addEventListener('click', function(){
    document.querySelector('.add_subject_modal').classList.remove('clicked');
    // document.querySelector('.background_overlay').classList.remove('clicked');
})

const editSubjectsModalTableTr = document.querySelectorAll('.edit_subjects_modal table tbody tr');

editSubjectsModalTableTr.forEach(function(tr) {
    tr.addEventListener('click', function() {

        editSubjectsModalTableTr.forEach(function(row) {
            row.style.backgroundColor = '';
        });

        tr.style.backgroundColor = 'rgb(244, 244, 244)';
    })
});