const image_list = document.querySelectorAll(".image_list > img");
const main_image = document.querySelector(".main_image > img");

image_list[0].style.border = '2px solid #99d668';

for(let i = 0; i < image_list.length; i++){
    image_list[i].addEventListener('click', (e) => {
        image_list.forEach(image =>{ image.style.border = "2px solid #eaf3be";})
        var new_image = e.target.srcset.replace("_small", "");

        main_image.srcset = new_image;
        e.target.style.border = '2px solid #99d668';
    })
}