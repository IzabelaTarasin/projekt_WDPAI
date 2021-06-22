<?php

require 'Routing.php';

session_start();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('places', 'PlaceController');
Router::post('login', 'SecurityController');
Router::post('addPlace','PlaceController');
Router::post('register', 'SecurityController');

Router::run($path);