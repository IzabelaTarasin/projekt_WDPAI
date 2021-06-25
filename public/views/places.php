<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/places.css">
    <link rel="stylesheet" type="text/css" href="public/css/sliders.css">
    <link rel="stylesheet" type="text/css" href="public/css/calendars.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/23b90dae98.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/searchPlaces.js" defer></script>
    <title>SEARCH PAGE</title>
</head>

<body>
    <div class="base-container">
        <?php include('header.php') ?>
        <nav>
            <img src="public/img/CAMP APP.svg">
            <ul>
                <li>
                    <i class="fas fa-calendar-alt"></i>
                    <label for="startdate">Start day</label>
                    <input class="calendar" type="date" name="startdate" id="startdate">
                </li>
                <li>
                    <i class="fas fa-calendar-alt"></i>
                    <label class="calendarlabel" for="enddate">End day</label>
                    <input class="calendar" type="date" name="enddate" id="enddate">
                </li>
                <li>
                    <i class="fas fa-dog"></i>
                    <label class="switch">
                        <input id = "animals-allowed-switch" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </li>
                <li>
                    <button id="search-button" class="button">search</button>
                </li>
            </ul>
        </nav>
        <section class="places">
            <div id="places-container"class="places_container"/>
        </section>
    </div>
</body>

<template id="place-template">
    <div>
        <img id="image" width="100" height="100">
        <div>
            <a id="name"></a>
            <p id="description"></p>
            <p>Address</p>
            <p id="postal-code"></p>
            <p id="city"></p>
            <p id="number"></p>
            <p id="street"></p>
            <p id="allows-animals"></p>

            <div class="rating-section">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
            </div>
        </div>
    </div>
</template>