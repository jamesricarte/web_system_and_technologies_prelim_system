document.addEventListener('DOMContentLoaded', function() {

    const editIcons = document.querySelectorAll('.edit_icon');

    editIcons.forEach(icon => {
        icon.addEventListener('click', function() {

            const row = this.closest('tr')

            const studentId = row.querySelector('.student_id').dataset.studentId
            const firstName = row.querySelector('td:nth-child(3)').dataset.firstName
            const middleName = row.querySelector('td:nth-child(3)').dataset.middleName
            const lastName = row.querySelector('td:nth-child(3)').dataset.lastName
            const schoolId = row.querySelector('td:nth-child(4)').dataset.schoolId
            const status = row.querySelector('td:nth-child(5)').dataset.status
            const course = row.querySelector('td:nth-child(6)').dataset.course
            const yearLevel = row.querySelector('td:nth-child(7)').dataset.yearLevel

            //looping through courses
            const courseSelect = document.querySelector('#update_course');
            const courseOptions = courseSelect.querySelectorAll('option');

            courseOptions.forEach(option => {
                if (option.textContent.trim() === course.trim()) {
                    courseSelect.value = option.value;
                    matched = true;
                }
            });

            if (!matched) {
                courseSelect.value = '';
            }

            //looping through status divs
            const statusTd = row.querySelector('.status_td');
            const statusDivs = statusTd.querySelectorAll('.status_button');
            let statusValue = '';

            statusDivs.forEach(div => {
                if (div.classList.contains('present')) {
                    statusValue = '1';
                } else if (div.classList.contains('absent')) {
                    statusValue = '2';
                } else if (div.classList.contains('late')) {
                    statusValue = '3';
                }
            });

            document.querySelector('#update_status').value = statusValue

            document.querySelector('#update_student_id').value = studentId
            document.querySelector('#update_first_name').value = firstName
            document.querySelector('#update_middle_name').value = middleName
            document.querySelector('#update_last_name').value = lastName
            document.querySelector('#update_school_id').value = schoolId
            document.querySelector('#update_year_level').value = yearLevel

            document.querySelector('.update_window').classList.add('clicked')
            document.querySelector('.background_overlay').classList.add('clicked')
        })
    })
})

document.querySelector('.x_icon').addEventListener('click', function() {
    document.querySelector('.update_window').classList.remove('clicked')
    document.querySelector('.background_overlay').classList.remove('clicked')
})