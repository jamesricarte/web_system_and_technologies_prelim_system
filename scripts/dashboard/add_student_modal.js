document.querySelector('.add_student_button').addEventListener('click', function(){
    document.querySelector('.add_student_modal').classList.add('clicked');
    document.querySelector('.background_overlay').classList.add('clicked');
})

document.querySelector('.x_icon_2').addEventListener('click', function(){
    document.querySelector('.add_student_modal').classList.remove('clicked');
    document.querySelector('.background_overlay').classList.remove('clicked');
})