<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <link rel="stylesheet" type="text/css" href="public/css/places.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/23b90dae98.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/searchPlaces.js" defer></script>
    <title>SEARCH PAGE</title>
</head>

<body>
<?php include('header.php') ?>
    <div class="container">
        <div class="container__internal">
            <div class="search__menu">
                <ul>
                    <li>
                        <i class="fas fa-calendar-alt"></i>
                        <input id="search-bar" placeholder="search place">
                    </li>
                    <li>
                        <i class="fas fa-calendar-alt"></i>
                        <input class="calendar" type="date" name="startdate" id="startdate" placeholder="start">
                    </li>
                    <li>
                        <i class="fas fa-calendar-alt"></i>
                        <input class="calendar" type="date" name="enddate" id="enddate" placeholder="end">
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
            </div>
            <div id="places-container" class="places__container"/>
        </div>
    </div>
</body>

<template id="place-template">
    <div class="place__item">
        <div>
            <img id="image" width="100" height="100">
        </div>
        <div class="place__item__description">
            <a id="name"></a>
            <p id="description"></p>
            <?php include('address.php')?>
            <p id="allows-animals"></p>
        </div>
    </div>
</template>