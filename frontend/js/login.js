document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login_form');

    loginForm.addEventListener('submit', function(event) {
        const isValid = validateForm();
        if (!isValid) {
            event.preventDefault(); // Prevent form submission if the validation fails
        }
    });
});
function validateForm() {
    const inputFields = document.querySelectorAll('input');

    let formIsValid = true;

    for (let i = 0; i < inputFields.length; i++) {
        let input = inputFields[i];
        if (input.value === '') {
            // If the field is empty, add the 'empty-field' class
            input.classList.add('empty_field');
            input.placeholder = "Please fill me"
            // Set formIsValid to false if any field is empty
            formIsValid = false;
        } else {
            // If the field is not empty, remove the 'empty-field' class (if it was previously added)
            input.classList.remove('empty_field');
        }
    }
    return formIsValid;
}
