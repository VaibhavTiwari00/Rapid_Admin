<?php




define('APPPATH', __DIR__);
$MODE = "PRO"; // SET "PRO" FROM PRODUCTION MODE


$ACTUAL_PATH_ARRAY = explode("/", (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

$APP_PATH = APPPATH;

$APP_PATH = str_replace("\\", "/", $APP_PATH);



$APP_DIR_INDEX = array_search(explode("/", $APP_PATH)[count(explode("/", $APP_PATH)) - 1], $ACTUAL_PATH_ARRAY);


$APP_DOMAIN = "";

if ($APP_DIR_INDEX == 0) {
    $APP_DOMAIN =  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
} else {

    for ($i = 0; $i < $APP_DIR_INDEX  + 1; $i++) {
        $APP_DOMAIN .= $ACTUAL_PATH_ARRAY[$i] . "/";
    }
}

if ($_SERVER['HTTP_HOST'] == "localhost") {
    define('mode', 0);
} else {
    define('mode', 1);
}
$APP_DOMAIN = preg_replace('#/$#', '', $APP_DOMAIN);
define('DOMAIN', $APP_DOMAIN);


include_once APPPATH . '/includes/routes.inc.php';


// case 0 for local host work
// case 1 for production

if (mode == 1) {

    // Mysqli Db 
    // $DB_HOST = "localhost";
    // $DB_USER = "u841070527_rapid";
    // $DB_PASS = "G1*j!t~Q^A&g";
    // $DB_NAME = "u841070527_autoshipping";
    $DB_HOST = "localhost";
    $DB_USER = "u841070527_rapid";
    $DB_PASS = "Smile@1427";
    $DB_NAME = "u841070527_autoshipping";


    $img_url = "//dashboard.rapidautoshipping.com/assets/images/blog/";
    // 
    #
    //
} else {

    #
    // edit this details based on your database info and domain info
    #
    // database info
    $DB_HOST = "localhost";
    $DB_USER = "root";
    $DB_PASS = "";
    $DB_NAME = "rapid_test";

    $img_url = get_img();
}
