document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('guid').addEventListener('input', function() {
        const guid = this.value;
        fetch('../../backend/checkGuid.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'guid=' + encodeURIComponent(guid)
        })
            .then(response => response.text())
            .then(data => {
                if (data === 'exists' || this.value.length < 3 || this.value.length > 255) {
                    document.getElementById('guid').classList.remove("variable_border_green");
                    document.getElementById('guid').classList.add("variable_border_red");
                } else {
                    document.getElementById('guid').classList.remove("variable_border_red");
                    document.getElementById('guid').classList.add("variable_border_green");
                }
            })
            .catch(error => console.error('Error:', error));
    });


    var registrationForm = document.getElementById('registration_form');
    var passwordInput = document.getElementById('password_input');
    var verifyPasswordInput = document.getElementById('verify_password_input');
    var inputFields = document.querySelectorAll('input:not([type="file"])');

    registrationForm.addEventListener('submit', function(event) {
        if (!formValid()) {
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

    function formValid() {

        if (passwordInput.value !== verifyPasswordInput.value) {
            document.getElementById('password_error').textContent = 'Passwords do not match.';
            return false;
        }
        let formIsValid = true;

        inputFields.forEach(function(input) {
            if (input.value === '') {
                // If the field is empty, add the 'empty-field' class
                input.classList.add('empty_field');
                input.placeholder = "Please fill me";
                // Set formIsValid to false if any field is empty
                formIsValid = false;
            } else {
                // If the field is not empty, remove the 'empty-field' class (if it was previously added)
                input.classList.remove('empty_field');
            }
        });

        return formIsValid;
    }
});
