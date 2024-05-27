const password_input = document.getElementById("password");
const toggler = document.getElementById("pass_toggler");

toggler.addEventListener('click', () =>{
    if(password_input.type == "password"){
        password_input.type = "text";
    }
    else{
        password_input.type = "password";
    }
})