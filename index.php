<?php

require 'Routing.php';

session_start();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::post('login', 'SecurityController');
Router::post('addPlace','PlaceController');
Router::post('book','PlaceController');
Router::post('register', 'SecurityController');


Router::get('getAllPlaces', 'PlaceController');
Router::get('place', 'PlaceController');
Router::get('', 'DefaultController');
Router::get('places', 'PlaceController');
Router::get('searchPlaces', 'PlaceController');

Router::run($path);