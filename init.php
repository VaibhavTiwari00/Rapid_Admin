<?php



// ------------------------------- Include Files -------------------------------//


include_once "config.php";
include_once "../includes/function.inc.php";
include_once '../includes/db.inc.php';
include_once '../includes/routes.inc.php';


// auto include file for classes
spl_autoload_register(function ($className) {
    $dir = "../classes/";
    $extension = ".class.php";
    $path = $dir  . $className . $extension;

    if (!file_exists($path)) {
        return false;
    }

    include_once $path;
});






// Include ui DIR PATH
$include_ui_path = "../components/";


define("HEADER", $include_ui_path . "header.php");
define("HEAD", $include_ui_path . "head.php");
define("FOOTER", $include_ui_path . "footer.php");
define("SCRIPT", $include_ui_path . "script.php");
define("pop_up", $include_ui_path . "pop_up.php");

define("MENU", $include_ui_path . "menu.php");
