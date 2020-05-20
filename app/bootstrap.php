<?php
// Load Config
require_once 'config/config.php';
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
// Load Libraries
// require_once 'libraries/core.php';
// require_once 'libraries/controller.php';
// require_once 'libraries/database.php';

// Autolaod Core Libraries
spl_autoload_register(function($classname){
    require_once 'libraries/'. $classname .'.php';
});
