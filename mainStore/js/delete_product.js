const delete_buttons = document.querySelectorAll(".towar_num > button");

delete_buttons.forEach(button => {
    button.addEventListener('click', () =>{
        var buttonId = button.id.replace("button_", "");

        sendRequestToDeleteProduct(buttonId);
    })
});