<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('places', 'PlaceController');
Router::post('login', 'SecurityController');
Router::post('addPlace','PlaceController');

Router::run($path);