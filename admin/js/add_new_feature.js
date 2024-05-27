const buttonAddFeature = document.getElementById("add_feature");
const features = document.getElementById("features");
var inputs = features.getElementsByTagName('input');

buttonAddFeature.addEventListener('click', () =>{
    var index = inputs.length;

    if(index == 4){
        return;
    }
    var newInput = document.createElement("input");
    newInput.name = "feature" + index;
    features.appendChild(newInput);
});