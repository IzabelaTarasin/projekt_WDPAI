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
    searchPlaces();
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

    const imgElement = clone.querySelector("#image");
    imgElement.src = `/public/img/1.png`; // TODO: use uploads

    const descriptionElement = clone.querySelector("#description");
    descriptionElement.innerHTML = place.description;
    // div.id = project.id;
    // const image = clone.querySelector("img");
    // image.src = `/public/uploads/${project.image}`;
    // const title = clone.querySelector("h2");
    // title.innerHTML = project.title;
    // const description = clone.querySelector("p");
    // description.innerHTML = project.description;
    // const like = clone.querySelector(".fa-heart");
    // like.innerText = project.like;
    // const dislike = clone.querySelector(".fa-minus-square");
    // dislike.innerText = project.dislike;

    placesContainer.appendChild(clone);
}