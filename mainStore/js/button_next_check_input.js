const button_person = document.getElementById("button_person");
const button_address = document.getElementById("button_address");
const button_shipment = document.getElementById("button_shipment");

button_person.addEventListener('click', () => {
    const input_list = document.querySelectorAll('#person > input:not([type="button"])');

    input_list.forEach(input => {
        if (!input.checkValidity()) {
            input.reportValidity();
        }
    });
});