<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

// Database access credentials
define('DB_NAME', 'WebProj');
define('DB_ PORT', 3306);
define('DB_USER', 'root');
define ('DB_PASSWORD', '12345678');
define ('DB_HOST', '127.0.0.1'); // localhost

// JWT Secret

define ('JWT_SECRET','3vi1kr8qVlbCTUKUfKceJ3kyvK3CPe');

