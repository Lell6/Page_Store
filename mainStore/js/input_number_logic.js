const field = document.getElementById("field");
const button_minus = document.getElementById("minus");
const button_plus = document.getElementById("plus");

button_minus.addEventListener('submit', e =>{
    e.preventDefault();
})
button_plus.addEventListener('submit', e => {
    e.preventDefault();
})

button_minus.addEventListener("click", () => {
    if(field.value > 1){
        field.value--;
    }
})

button_plus.addEventListener("click", () => {
    field.value++;
})