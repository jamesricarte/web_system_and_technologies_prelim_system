document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status_button').forEach(button => {
        button.addEventListener('click', function() {
            let newStatus;
            let selectedButton;

            if (this.classList.contains('js-present')) {
                newStatus = 1;
                selectedButton = 1;
                this.classList.add('present')
                this.classList.remove('js-present')
            } else if (this.classList.contains('js-absent')) {
                newStatus = 2;
                selectedButton = 2;
                this.classList.add('absent')
                this.classList.remove('js-absent')
            } else if (this.classList.contains('js-late')) {
                newStatus = 3;
                selectedButton = 3;
                this.classList.add('late')
                this.classList.remove('js-late')

            }

            const studentRow = this.closest('tr');
            const studentId = studentRow.querySelector('td:first-child').textContent.trim();

            studentRow.querySelectorAll('.status_button').forEach(btn => {
                if (selectedButton == 1) {
                    if (btn.classList.contains('absent')) {
                        btn.classList.remove('absent')
                        btn.classList.add('js-absent')
                    }
                    if (btn.classList.contains('late')) {
                        btn.classList.remove('late')
                        btn.classList.add('js-late')
                    }
                }
                if (selectedButton == 2) {
                    if (btn.classList.contains('present')) {
                        btn.classList.remove('present')
                        btn.classList.add('js-present')
                    }
                    if (btn.classList.contains('late')) {
                        btn.classList.remove('late')
                        btn.classList.add('js-late')
                    }
                }
                if (selectedButton == 3) {
                    if (btn.classList.contains('present')) {
                        btn.classList.remove('present')
                        btn.classList.add('js-present')
                    }
                    if (btn.classList.contains('absent')) {
                        btn.classList.remove('absent')
                        btn.classList.add('js-absent')
                    }
                }
            });

            fetch('../process/dashboard/auto_update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: studentId, status: newStatus })
            })
            .then(response => response.text())
            .then(data => {
                // console.log('Success:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });

        })
    })
})