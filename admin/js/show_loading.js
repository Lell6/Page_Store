const input = document.getElementById('submit');
console.log(input);

input.addEventListener('click', () =>{
    const loading = document.getElementById("loading");
    
    if(loading.style.display == 'none'){
        loading.style.display = 'block';
    }
    else{
        loading.style.display = 'none';
    }
});