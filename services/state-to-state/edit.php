<?php


include_once '../__api.php';

extract(senitize_array($_POST));


$response = [];
// $time_stamp = time();

$data = fetch_data("SELECT * FROM `state_to_state` WHERE `state_id` = '$id'");

if ($data['slug'] != $slug) {

    $slug_test = is_data_exist('company_reviews', "slug = '$slug'");
    if ($slug_test) {
        throwResponse(false, "Please enter a unique slug");
    }
}

$display_update_form_q_1 = "";
if (isset($_FILES['img1'])) {
    $DISPLAY_IMG_FORM =  uploadFile($_FILES['img1'], '/assets/images/blog/');
    $display_update_form_q_1 = "`state_form_img`='$DISPLAY_IMG_FORM',";
}
$display_update_form_q_2 = "";
if (isset($_FILES['img2'])) {
    $DISPLAY_IMG_TO =  uploadFile($_FILES['img2'], '/assets/images/blog/');
    $display_update_form_q_2 = "`state_to_img`='$DISPLAY_IMG_TO',";
}
// $DISPLAY_IMG_FORM =  uploadFile($_FILES['img1'], '/assets/images/state/');
// $DISPLAY_IMG_TO =  uploadFile($_FILES['img2'], '/assets/images/state/');

$q = "UPDATE `state_to_state` SET `state_form`='$stateform',`state_to`='$stateto',`slug`='$slug',`title`='$title',`meta`='$seo', $display_update_form_q_1 `state_form_img_alt`='$state_form_img_alt', $display_update_form_q_2`state_to_img_alt`='$state_to_img_alt', `page_h1`='$h1', `page_h2`='$h2', `page_about_1`= '$about1', `page_about_2`='$about2', `content`= '$content',`route_star`='$rating', `route_distance`='$distance', `route_timing`='$days' WHERE `state_id` = '$id' ";

$res = query($q);

if ($res) {
    throwResponse(true, "Company review added successfully");
} else {
    throwResponse(false, "Can't add company review because " . mysqli_error($con));
}
