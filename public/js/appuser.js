function togglePasswordVisibility(id) {
    let passwordInput = document.getElementById(id);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

function numberOnly(e) {
    e.value = e.value.replace(/\D/g, "");
}
