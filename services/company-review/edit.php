<?php


include_once '../__api.php';

extract(senitize_array($_POST));


$response = [];
$time_stamp = time();


$data = fetch_data("SELECT * FROM `company_reviews` WHERE `id` = '$id'");
if ($data['slug'] != $slug) {

    $slug_test = is_data_exist('company_reviews', "slug = '$slug'");
    if ($slug_test) {
        throwResponse(false, "Please enter a unique slug");
    }
}



$q = "UPDATE `company_reviews` SET `company_name`='$name',`stars`='$star',`slug`='$slug',`addr1`='$addr1',`addr2`='$addr2',`phone`='$phone',`mc`='$mc',`us_dot`='$us_dot',`company_text`='$text',`seo`='$seo',`updated_on`='$time_stamp' WHERE `id` = '$id' ";

$res = query($q);

if ($res) {
    if ($data['slug'] != $slug) {
        $old_data = $data['slug'];
        $q = "UPDATE `user_reviews` SET `company_slug`='$slug' WHERE `company_slug` = '$old_data'";
        query($q);
    }
    throwResponse(true, "Company review added successfully");
} else {
    throwResponse(false, "Can't add company review because " . mysqli_error($con));
}
