<?php

function getRequestData()
{
    // geting data from request
    $req_data =  stripslashes(file_get_contents("php://input"));

    // convert json to php array
    $req_data_array = json_decode($req_data, true);

    // return 
    return $req_data_array;
}

function admin_root($root = "")
{
    if ($root != "") {
        $root_array = explode("\\", $root);
    } else {
        $root_array = explode("\\", __DIR__);
    }

    $admin_root_index = array_search('admin', $root_array, true);
    $back_dir_count = count($root_array) - $admin_root_index;
    $admin_root = "";
    for ($i = 0; $i < $back_dir_count; $i++) {
        $admin_root .= "../";
    }
    return $admin_root;
}



function is_json($string, $return_data = false)
{
    $data = json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
}

// get $_POST and secure incoming data 
function send_booking_conformation($to, $bookingid, $subject)
{
    $to .= ",info@helloindiatour.com";

    $message = file_get_contents('https://helloindiatour.com/pages/booking-mail.php?_bi=' . $bookingid);

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <info@helloindiatour.com>' . "\r\n";

    if (mail($to, $subject, $message, $headers)) {
        true;
    } else {
        false;
    }
}


$DB_ERROR = false;
global $DB_ERROR;
function handle_db_error($message)
{

    global $DB_ERROR;
    $DB_ERROR = $message;
}


function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 25; $i++) {
        $randstring .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}


function uploadFile($file, $uploadpath, $fun = null)
{


    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    // dir name where uploaded
    $target_dir = APPPATH . $uploadpath;

    // file type
    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    //  new file name
    $target_file_name =  RandomString() . '.' . $imageFileType;


    // complete path with new file name
    $target_file = $target_dir . $target_file_name;

    $check = getimagesize($file["tmp_name"]);
    if ($check == false) {
        if ($fun != null) {
            $fun("Failed to get file size");
        }
        return false;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        if ($fun != null) {
            $fun("File already exists");
        }
        return false;
    }

    // Check file size
    if ($file["size"] > 5000000) {
        if ($fun != null) {
            $fun("File is to large");
        }
        return false;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        if ($fun != null) {
            $fun("please upload only jpg, png, jpeg or gif");
        }
        return false;
    }

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file_name;
    } else {
        if ($fun != null) {
            $fun("Fail to move file from you to remote.");
        }
        return false;
    }
}


// This function generate a unique tour id qudination of data base
function generate_unique_id($table_name, $column_name, $id_length)
{

    $db = new Db();

    if ($id_length > 2) {

        $lowest = 1;
        $highest = 9;

        for ($i = 1; $i < $id_length; $i++) {
            $lowest .= 0;
            $highest .= 9;
        }

        $generated_id = rand($lowest, $highest);


        $check_generated_id = "SELECT * FROM '$table_name' WHERE `$column_name` = '$generated_id' ";


        if ($db->fetch_data($check_generated_id)) {

            generate_unique_id($table_name, $column_name, $id_length);
        } else {
            return $generated_id;
        }
    } else {

        trigger_error('Id Lenght must be grater then 2 ', E_USER_WARNING);
    }
}


// get $_POST and secure incoming data 
function senitize_array($array)
{
    $return_array = [];
    global $con;
    if ($con) {
        if (count($array) > 0) {
            $keys = array_keys($array);
            for ($i = 0; $i < count($keys); $i++) {
                $key_val = $array[$keys[$i]];
                if (gettype($key_val) != 'array') {
                    $value = mysqli_escape_string($con, $key_val);
                    $return_array[$keys[$i]] = $value;
                } else {
                    $return_array[$keys[$i]] = senitize_array($key_val);
                }
            }
        }
    } else {
        trigger_error('Error: while connecting to database', E_USER_WARNING);
    }
    return $return_array;
}

function senitize_string($string)
{
    global $con;
    return mysqli_escape_string($con, $string);
}



function _post($key, $required = false, $error = null)
{
    if (isset($_POST[$key])) {
        global $con;
        return mysqli_escape_string($con, $_POST[$key]);
    } else {
        if ($required) {
            thowResponse(false, $error);
        } else {
            return '';
        }
    }
}

function _get($key, $required = false, $error = null)
{
    if (isset($_GET[$key])) {
        global $con;
        return mysqli_escape_string($con, $_GET[$key]);
    } else {
        if ($required) {
            thowResponse(false, $error);
        } else {
            return '';
        }
    }
}

function thowResponse($result = false, $message = '', $data = null)
{
    $response = [];
    $response['status'] = $result;
    $response['message'] = $message;

    if ($data != null) {
        $response['data'] = $data;
    }
    echo json_encode($response);
    exit;
}


function throwResponse($result = false, $message = '', $data = null)
{
    $response = [];
    $response['status'] = $result;
    $response['message'] = $message;
    if ($data != null) {
        $response['data'] = $data;
    }
    echo json_encode($response);
    exit;
}

function get_status_widget($status, $function = "")
{


    switch ($status) {

        case 3:
            $class = "stock_warning";
            $message = "Low Stock";
            break;

        case 2:
            $class = "error";
            $message = "Out of Stock";
            break;

        case 1:
            $class = "success";
            $message = "Active";
            break;

        case -1:
            $class = "blocked";
            $message = "Blocked";
            break;

        default:
            # code...
            $class = "error";
            $message = "Inactive";
            break;
    }


    echo '<p class="info-widget ' . $class . '" ' . $function . '> ' . $message . '   </p>';
}


function throw_exception($message)
{
    global $MODE;
    if ($MODE == "DEV") {
        throw new Exception($message);
    }
}


function redirect($url)
{
    header('Location: ' . $url);
}


function authorized_user_only()
{
    if (!User::isAuthorized()) {
        redirect(home_path() . "/login?redirectto=" . current_path());
    }
}

function current_path($removeQueryString = false)
{

    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if ($removeQueryString) {
        return   substr($url, 0, strrpos($url, "?"));
    }
    return $url;
}

function settings()
{
    // get setting.json file 
    $setting = file_get_contents(APPPATH . "/setting.json");
    return json_decode($setting, true);
}

define("CREATE_NEW_KEY", 1);
define("JUST_UPDATE_KEY", 0);

function update_key($key, $value, $flag = JUST_UPDATE_KEY)
{
    $q = "UPDATE `settings` SET `value` = '$value' WHERE `_key` = '$key';";
    query($q);

    // global $con;

    // $affected =  mysqli_affected_rows($con);
    // echo $affected . "  ,  ";
    // if ($affected == 0 || $affected = "") {
    //     echo "called s1";
    //     if ($flag === CREATE_NEW_KEY) {
    //         echo "called s2";

    //         $q = "INSERT INTO `settings` (`_key`,'value')VALUES ('$key','$value');";
    //         query($q);
    //     }
    // }
}


// UPDATE `settings` SET `value` = '' WHERE `_key` = 'contact_us_page_map';
// UPDATE `settings` SET `value` = '' WHERE `_key` = 'phone1';
// UPDATE `settings` SET `value` = '' WHERE `_key` = 'phone2';
// UPDATE `settings` SET `value` = '' WHERE `_key` = 'email';
// UPDATE `settings` SET `value` = '' WHERE `_key` = 'fax_number1';
// UPDATE `settings` SET `value` = 'adsf' WHERE `_key` = 'contact_us_page_address';
// UPDATE `settings` SET `value` = '' WHERE `_key` = 'contact_us_query_submit_email';



function get_remote_settings()
{
    $settings = fetch_all_data('SELECT `_key`, `value` FROM `settings`');

    $settings_array = array();
    foreach ($settings as $key => $value) {
        $key2 = "";
        $val2 = "";
        foreach ($value as $key => $val) {
            $key2 =  ($key == "_key") ? $val : $key2;
            $val2 =  ($key == "value") ? $val : $val2;
        }

        $settings_array[$key2] = $val2;
    }

    return $settings_array;
}
function jsonToHtml($str)
{

    $str =  preg_replace('/&quot;/g', "\"", $str);
    $str =  preg_replace('/&#039;/g', "\'", $str);
    return $str;
}
