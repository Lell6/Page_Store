const buttons = document.getElementsByClassName("button_next");
const edit_buttons = document.getElementsByClassName("button_edit");
const windows = document.getElementsByClassName("input_data");

for(let i = 0; i < edit_buttons.length; i++){
    edit_buttons[i].style.display = 'none';
}

for(let i = 1; i < windows.length; i++){
    windows[i].style.display = 'none';
}

for(let i = 0; i < 3; i++){
    buttons[i].addEventListener('click', () =>{
        windows[i].style.display = 'none';
        edit_buttons[i].style.display = 'block';
        
        windows[i+1].style.display = 'flex';
        edit_buttons[i+1].style.display = 'none';
    })
}

for(let i = 0; i < 4; i++){
    edit_buttons[i].addEventListener('click', () =>{
        windows[i].style.display = 'flex';
        edit_buttons[i].style.display = 'none';

        for(let j = 0; j < 4; j++){
            if(i != j){
                windows[j].style.display = 'none';
                edit_buttons[j].style.display = 'block';
            }
        }
    })
}