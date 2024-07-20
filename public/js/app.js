let passwordInput = document.querySelector("#password");
let toggleVisibility = document.querySelector("#toggle-visibility");
toggleVisibility.addEventListener("click", () => {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleVisibility.classList.remove("fa-eye-slash");
        toggleVisibility.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        toggleVisibility.classList.remove("fa-eye");
        toggleVisibility.classList.add("fa-eye-slash");
    }
});