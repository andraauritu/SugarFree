let form = document.getElementById("submissionForm");
let messageElement = document.getElementById("message");

form.addEventListener("submit", function (event) {
    event.preventDefault();
    let formData = new FormData(form);
    let xhr = new XMLHttpRequest();
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => input.value = '');
    xhr.onload = function () {
        if (xhr.status === 200) {
            messageElement.textContent = "Recipe submitted successfully.";
        } else {
            messageElement.textContent = "Error: " + xhr.responseText;
        }
    };
    xhr.open("POST", form.action, true);
    xhr.send(formData);
});
