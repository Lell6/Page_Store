function sendRequestToChangeDeliveryPrice(deliveryType){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "function_change_delivery_price.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            
            for(let i = 0; i < 3; i++){
                var price = document.getElementById('price_' + i);
                price.innerHTML = response[i] + "zł";
            }
        }
    };

    var value = 0;
    if(deliveryType == "shop"){
        value = 0;
    }
    if(deliveryType == "home_dhl"){
        value = 15;
    }
    if(deliveryType == "home_dpd"){
        value = 14;
    }
    if(deliveryType == "inpost"){
        value = 10;
    }

    xhr.send("price=" + value);
}

const inputs = document.querySelectorAll("input[name=ship]");
inputs.forEach(input => {
    input.addEventListener("change", () => {
        if(input.checked){
            var deliveryType = input.id;
            sendRequestToChangeDeliveryPrice(deliveryType);
        }
    });
});