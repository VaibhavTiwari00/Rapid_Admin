<?php

define('API_DIR', __DIR__);

include_once API_DIR . '/../config.php';


$INC_DIR = APPPATH . "/includes/";

include_once  $INC_DIR . 'db.inc.php';
include_once  $INC_DIR . 'function.inc.php';
include_once  $INC_DIR . 'routes.inc.php';



// auto include file for classes
spl_autoload_register(function ($className) {
    $dir = APPPATH . "/classes/";
    $extension = ".class.php";
    $path = $dir  . $className . $extension;

    if (!file_exists($path)) {
        return false;
    }

    include_once $path;
});
