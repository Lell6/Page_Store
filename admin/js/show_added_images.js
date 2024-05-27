const image_adder = document.getElementById("image_adder");
const image_displayer = document.getElementById("image_displayer");

image_adder.addEventListener('change', function(event){
    image_displayer.innerHTML = "";
    var file_list = image_adder.files;

    for(let i = 0; i < file_list.length; i++){
        var image = document.createElement('img');
        image.src = URL.createObjectURL(file_list[i]);

        image_displayer.appendChild(image);
    }
})