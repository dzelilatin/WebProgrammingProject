<?php

require 'vendor/autoload.php';

flight::route('/', function() {
    echo 'Hello world!';

});

Flight::start();
?>