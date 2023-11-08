document.addEventListener('DOMContentLoaded', function() {
    var registrationForm = document.getElementById('registration_form');
    var passwordInput = document.getElementById('password_input');
    var verifyPasswordInput = document.getElementById('verify_password_input');
    var inputFields = document.querySelectorAll('input:not([type="file"])');

    registrationForm.addEventListener('submit', function(event) {
        var isValid = validateForm();
        if (!isValid) {
            event.preventDefault(); // Prevent form submission if the validation fails
        }
    });

    passwordInput.addEventListener('input', instantPasswordCheck);
    verifyPasswordInput.addEventListener('input', instantPasswordCheck);

    function instantPasswordCheck() {
        const password = passwordInput.value;
        const verifyPassword = verifyPasswordInput.value;

        // Check if passwords match
        if (password !== verifyPassword) {
            document.getElementById('password_error').textContent = 'Passwords do not match.';
        } else {
            // Clear any previous error message if passwords now match or fields are empty
            document.getElementById('password_error').textContent = '';
        }
    }

    function validateForm() {
        let formIsValid = true;

        inputFields.forEach(function(input) {
            if (input.value === '') {
                // If the field is empty, add the 'empty-field' class
                input.classList.add('empty-field');
                input.placeholder = "Please fill me";
                // Set formIsValid to false if any field is empty
                formIsValid = false;
            } else {
                // If the field is not empty, remove the 'empty-field' class (if it was previously added)
                input.classList.remove('empty-field');
            }
        });

        // Additional validation checks can be added here
        // ...

        return formIsValid;
    }
});
