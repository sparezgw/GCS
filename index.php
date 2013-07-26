<?php

// Retrieve instance of the framework
$f3 = require('lib/base.php');

// Initialize
$f3->config('app/config.ini');

// Define routes
$f3->config('app/routes.ini');

// maps
$f3->config('app/maps.ini');

// Execute application
$f3->run();

