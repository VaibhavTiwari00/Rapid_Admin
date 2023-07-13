<?php


include_once '../__api.php';

extract(senitize_array($_POST));


$response = [];
// $time_stamp = time();

$slug_test = is_data_exist('state_to_state', "slug = '$slug'");

if ($slug_test) {
    throwResponse(false, "Please enter a unique slug");
}

$DISPLAY_IMG_FORM =  uploadFile($_FILES['img1'], '/assets/images/blog/');
$DISPLAY_IMG_TO =  uploadFile($_FILES['img2'], '/assets/images/blog/');

$q = "INSERT INTO `state_to_state` ( `state_form`, `state_to`,`slug`, `title`, `meta`, `state_form_img`,`state_form_img_alt`, `state_to_img`,`state_to_img_alt`, `page_h1`, `page_h2`, `page_about_1`, `page_about_2`, `content`,`route_star`, `route_distance`, `route_timing`) VALUES ( '$stateform', '$stateto','$slug', '$title', '$seo', '$DISPLAY_IMG_FORM ','$state_form_img_alt','$DISPLAY_IMG_TO', '$state_to_img_alt', '$h1', '$h2', '$about1', '$about2', '$content','$rating', '$distance', '$days');";

$res = query($q);

if ($res) {
    throwResponse(true, "Company review added successfully");
} else {
    throwResponse(false, "Can't add company review because " . mysqli_error($con));
}
