function sendRequestToSearchValues(value, result){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "function_searchValue.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            
            result.innerHTML = "";

            if(response.length > 10){
                response = response.slice(0, 10);
            }
            response.forEach(foundedProduct => {
                var productLink = document.createElement('a');
                productLink.href = 'page_product.php?id=' + foundedProduct['Id'];
                productLink.innerHTML = foundedProduct['Name'];
                
                result.append(productLink);
            })

            result.style.display = 'block';
        }
    };
    
    xhr.send('search=' + value);
}

const searchBar = document.getElementById('searchBar');
const searchResult = document.getElementById('searchResult');

searchBar.addEventListener('input', () => {
    if(searchBar.value.length > 3){
        searchValue = searchBar.value;
        sendRequestToSearchValues(searchValue, searchResult);
    }
    else{
        searchResult.style.display = 'none';
    }
});

document.addEventListener('click', (e) => {
    if(e.target.id != searchBar.Id && e.target.id != searchResult.Id){
        searchResult.style.display = 'none';
        searchBar.value = "";
    }
});