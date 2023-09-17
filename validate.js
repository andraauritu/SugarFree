function validate_password() {

    var pass = document.getElementById('password').value;
    var confirm_pass = document.getElementById('confirm_password').value;
    if (pass != confirm_pass) {
        document.getElementById('wrong_pass_alert').style.color = 'red';
        document.getElementById('wrong_pass_alert').innerHTML
            = 'Passwords do not match';
    } else {
        document.getElementById('wrong_pass_alert').style.color = 'green';
        document.getElementById('wrong_pass_alert').innerHTML =
            'Passwords match';
    }
}