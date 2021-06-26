const hasAnimalsSwitch = document.querySelector("#has-animals-switch");
const totalPriceElement = document.querySelector('#total-price');
const startDateInputElement = document.querySelector('#start-date-input');
const endDateInputElement = document.querySelector('#end-date-input');
const infoElement = document.querySelector('#info');
const bookButtonElement = document.querySelector('#book-button');

const dailyPrice = 10;
const priceForAnimal = 200;

window.onload=load;

function load(){
    calculatePrice()
}

function calculatePrice() {
    if (startDateInputElement.value == '' || endDateInputElement.value == '') {
        totalPriceElement.innerHTML = "-";
        infoElement.innerHTML = "Both dates must be selected";
        bookButtonElement.disabled = true;
        return;
    }

    const startDate = new Date(startDateInputElement.value).setHours(0,0,0,0);
    const endDate = new Date(endDateInputElement.value).setHours(0,0,0,0);
    const nowDate = new Date().setHours(0,0,0,0);

    if (startDate >= endDate) {
        totalPriceElement.innerHTML = "-";
        infoElement.innerHTML = "End date must be greater than start date";
        bookButtonElement.disabled = true;
        return;
    }

    if (nowDate > startDate) {
        totalPriceElement.innerHTML = "-";
        infoElement.innerHTML = "Past cannot be selected";
        bookButtonElement.disabled = true;
        return;
    }

    var price = 0;
    const days = Math.floor((endDate - startDate) / 86400000);
    price += days * dailyPrice;

    if (hasAnimalsSwitch != null && hasAnimalsSwitch.checked) {
        price += priceForAnimal;
    }

    infoElement.innerHTML = "";
    bookButtonElement.disabled = false;
    totalPriceElement.innerHTML = price + "$";
}

if (hasAnimalsSwitch != null) {
    hasAnimalsSwitch.addEventListener('change', e => {
        calculatePrice();
    });
}

startDateInputElement.addEventListener('change', e=> {
    calculatePrice();
});

endDateInputElement.addEventListener('change', e=> {
    calculatePrice();
});