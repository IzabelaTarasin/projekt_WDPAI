const searchBar = document.querySelector("#search-bar");
const placesContainer= document.querySelector("#places-container")
const searchButton = document.querySelector("#search-button");

searchButton.addEventListener("click", e => {
    searchPlaces();
});

window.onload=loadInitialPlaces

function loadInitialPlaces() {
    fetch("/getAllPlaces", {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        }})
        .then(res => res.json())
        .then(handle)
        .catch(err => console.log((err)))
}

function handle(response){
    console.log(response);
    placesContainer.innerHTML = "";
    loadPlaces(response);
}

searchBar.addEventListener("keyup", function (event) {
    if (event.key == 'Enter') {
        searchPlaces();
    }
});

function searchPlaces() {
    const animalsSwitch = document.querySelector("#animals-allowed-switch");

    const data = {
        search: this.value,
        animalsAllowed: animalsSwitch.checked
    }

    fetch("/searchPlaces", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        }, body: JSON.stringify(data)})
        .then(res => res.json())
        .then(handle)
        .catch(err => console.log((err)))
}

function loadPlaces(places) {
    places.forEach(place => {
        createPlace(place);
    });
}

function createPlace(place) {
    const template = document.querySelector("#place-template");

    const clone = template.content.cloneNode(true);
    const nameElement = clone.querySelector("#name");
    nameElement.innerHTML = place.name;
    nameElement.setAttribute('href', "place?id=" +place.id);

    const imgElement = clone.querySelector("#image");
    if (place.image_path) {
        imgElement.src = place.image_path;
    }

    const descriptionElement = clone.querySelector("#description");
    descriptionElement.innerHTML = place.description;

    const postalCodeElement = clone.querySelector("#postal-code");
    postalCodeElement.innerHTML = "Postal code " +place.postal_code;

    const cityElement = clone.querySelector("#city");
    cityElement.innerHTML = "City " +place.city;

    const numberElement = clone.querySelector("#number");
    numberElement.innerHTML = "Number " +place.number;

    const streetElement = clone.querySelector("#street");
    streetElement.innerHTML = "Street " +place.street;

    placesContainer.appendChild(clone);
}