function instantPasswordCheck() {
    const password = document.getElementById('password_input').value;
    const verifyPassword = document.getElementById('verify_password_input').value;

    // Check if passwords match
    if (password !== verifyPassword) {
        document.getElementById('password_error').textContent = 'Passwords do not match.';
    } else {
        // Clear any previous error message if passwords now match or fields are empty
        document.getElementById('password_error').textContent = '';
    }
}

// Other functions remain the same

function validateForm() {
    const inputFields = document.querySelectorAll('input');

    let formIsValid = true;

    for (let i = 0; i < inputFields.length; i++) {
        let input = inputFields[i];
        if (input.value === '') {
            // If the field is empty, add the 'empty-field' class
            input.classList.add('empty-field');
            input.placeholder = "Please fill me"
            // Set formIsValid to false if any field is empty
            formIsValid = false;
        } else {
            // If the field is not empty, remove the 'empty-field' class (if it was previously added)
            input.classList.remove('empty-field');
        }
    }
    return formIsValid;
}
