document.querySelector('.birthday').addEventListener('input', birthdayInput)

function birthdayInput() {
    const birthday = new Date(this.value)
    const today = new Date

    let age = today.getFullYear() - birthday.getFullYear()

    document.querySelector('.age').value = age
    document.querySelector('.age-hidden').value = age
} 

