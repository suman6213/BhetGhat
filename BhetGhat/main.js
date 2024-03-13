const togglePassword = document.querySelectorAll(".toggle"),
    passwordFields = document.querySelectorAll('.password'),
    signup = document.getElementById("register-link"),
    login = document.getElementById("login-link"),
    signupForm = document.querySelector(".form-box.register"),
    loginForm = document.querySelector(".form-box.login");

// togglePassword.addEventListener('click', ()=>{
//     passwordFields.forEach(field => {
//         if(field.type === 'password'){
//             field.type = 'text';
//             togglePassword.classList.replace("fa-eye", "fa-eye-slash");
//         }else{
//             field.type = 'password';
//             togglePassword.classList.replace("fa-eye-slash", "fa-eye");
//         }
//     });
// });
togglePassword.forEach(togglebtn => {
    togglebtn.addEventListener('click', () => {
        passwordFields.forEach(field => {
            if(field.type === "password"){
                field.type = "text";
                togglebtn.classList.replace("fa-eye", "fa-eye-slash");
            }else{
                field.type = "password";
                togglebtn.classList.replace("fa-eye-slash", "fa-eye");
            }
        })
    })
})

signup.addEventListener('click', () => {
    loginForm.style.display = "none";
    signupForm.style.display = "block";
});

login.addEventListener('click', () => {
    signupForm.style.display = "none";
    loginForm.style.display = "block";
});