<?php

include '__api.php';


$response  = array();

if (isset($_POST['text']) && isset($_GET['docType'])) {

    $text = $_POST['text'];
    $dt = $_GET['docType'];

    $q;
    if ($dt == 1) {
        $q =   "UPDATE `site_settings` SET `privacy-policy`='$text' WHERE `setting_id`='1001' ";
    } elseif ($dt == 2) {
        $q =   "UPDATE `site_settings` SET `terms-and-conditions`='$text' WHERE `setting_id`='1001' ";
    } elseif ($dt == 3) {
        $q =   "UPDATE `site_settings` SET `cancelation-policy`='$text' WHERE `setting_id`='1001' ";
    }


    if (query($q)) {
        $response['result'] = 'success';
    } else {
        $response['result'] = 'failed';
        $response['message'] = 'Mysqli query error' . mysqli_error($con);
    }
} else {
    $response['result'] = 'failed';
    $response['message'] = 'required data is missing';
}


if ($response) {
    echo json_encode($response);
}
