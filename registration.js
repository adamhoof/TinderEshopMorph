function instantPasswordCheck() {
    var password = document.getElementById('password_input').value;
    var verifyPassword = document.getElementById('verify_password_input').value;

    // Check if passwords match
    if ( password !== verifyPassword) {
        document.getElementById('password_error').textContent = 'Passwords do not match.';
    } else {
        // Clear any previous error message if passwords now match or fields are empty
        document.getElementById('password_error').textContent = '';
    }
}
function validateForm() {
    var password = document.getElementById('password_input').value;
    var verifyPassword = document.getElementById('verify_password_input').value;

    // Check if passwords match
    if (password !== verifyPassword) {
        document.getElementById('password_error').textContent = 'Passwords do not match.';
        return false;  // Prevent form submission
    }

    // Clear any previous error message if passwords now match
    document.getElementById('password_error').textContent = '';

    return true;  // Allow form submission
}
