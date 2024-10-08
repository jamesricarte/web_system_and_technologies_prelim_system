document.addEventListener('DOMContentLoaded', function() {
    
    const deleteIcons = document.querySelectorAll('.delete_icon');

    deleteIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const row = this.closest('tr');
            
            const studentId = row.querySelector('.student_id').dataset.studentId
            const firstName = row.querySelector('[data-first-name]').getAttribute('data-first-name');
            const middleName = row.querySelector('[data-middle-name]').getAttribute('data-middle-name');
            const lastName = row.querySelector('[data-last-name]').getAttribute('data-last-name');
            
            const confirmDelete = confirm(`Are you sure you want to delete ${lastName} from the list?`);
            
            if (confirmDelete) {

                fetch('../process/dashboard/delete_row.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: studentId})
                })
                .then(response => response.text())
                .then(data => {
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            }
        });
    });
});