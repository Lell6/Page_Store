function setCount(response, id){
    var counted_price = document.getElementById("counted_price_" + id);
    response[1] = Number(response[1]/100).toLocaleString("pl-PL", { maximumFractionDigits: 2, minimumFractionDigits: 2 });
    
    counted_price.innerHTML = response[1] + "zł";
}

function setNumberOfItemsInCart(response){
    var product_count = document.getElementById("navbar_count");
    product_count.innerHTML = "Koszyk (" + response[1] + ")";
}

function setValuesForPrices(response){
    var products_price = document.getElementById("products_price");
    var whole_price = document.getElementById("whole_price");
    var delivery = document.getElementById("delivery");
    var emptyCart = document.getElementById("emptyCart");

    response[0][0] = (Number(response[0][0]) / 100).toLocaleString("pl-PL", { maximumFractionDigits: 2, minimumFractionDigits: 2 });
    response[0][1] = (Number(response[0][1]) / 100).toLocaleString("pl-PL", { maximumFractionDigits: 2, minimumFractionDigits: 2 });
    response[0][2] = (Number(response[0][2]) / 100).toLocaleString("pl-PL", { maximumFractionDigits: 2, minimumFractionDigits: 2 });

    products_price.innerHTML = response[0][0] + "zł";
    delivery.innerHTML = response[0][1] + "zł";
    whole_price.innerHTML = response[0][2] + "zł";

    if(products_price.innerHTML === "0.00zł"){
        emptyCart.style.display = 'block';
    }
    else{
        emptyCart.style.display = 'none';
    }
    emptyCart.offsetHeight;
}

function sendRequestToDeleteProduct(id){
    var xhr = new XMLHttpRequest();
    
    xhr.open("POST", "function_delete_product_in_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
            var response = JSON.parse(xhr.responseText);
            var removed_product = document.getElementById(id);
    
            setValuesForPrices(response);
            setNumberOfItemsInCart(response);

            removed_product.remove();
        }
    };

    xhr.send("id=" + id);
}

function sendRequestToChangeData(id, value){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "function_change_product_in_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            setValuesForPrices(response);
            setCount(response, id);
        }
    };
    
    xhr.send("id=" + id + "&count=" + value);
}

function sendData(id, value) {
    if(value != 0 && !/[a-zA-Z]/.test(value)){
        sendRequestToChangeData(id, value);
    }
    else if (value == 0 && value != ""){
        sendRequestToDeleteProduct(id);
    }
}

const inputs = document.querySelectorAll(".input_num > *");
inputs.forEach(element => {
    element.addEventListener('change', ()=>{
        var inputValue = element.value;
        var inputId = element.id.replace("input_", "");

        element.value = inputValue;        
        sendData(inputId, inputValue);
    });
});