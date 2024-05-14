<?php
// Include the Flight framework autoload file
require 'vendor/autoload.php';

// Define your Flight routes and functionality
flight::route('/', function() {
    echo 'Hello world!';
});

// REST API documentation endpoint
Flight::route('GET /docs.json', function(){
    $openapi = \OpenApi\scan('routes');
    header('Content-Type: application/json');
    echo $openapi->toJson();
});

// Start the Flight framework
Flight::start();
?>
