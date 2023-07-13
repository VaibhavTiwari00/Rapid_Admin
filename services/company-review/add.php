<?php


include_once '../__api.php';

extract(senitize_array($_POST));


$response = [];
$time_stamp = time();

$slug_test = is_data_exist('company_reviews', "slug = '$slug'");

if ($slug_test) {
    throwResponse(false, "Please enter a unique slug");
}

$q = "INSERT INTO `company_reviews`( `company_name`, `stars`, `slug`, `addr1`, `addr2`, `phone`, `mc`, `us_dot`, `company_text`, `seo`, `updated_on`, `added_on`) VALUES ('$name','$star','$slug','$addr1','$addr2','$phone','$mc','$us_dot','$text','$seo','$time_stap','$time_stamp')";

$res = query($q);

if ($res) {
    throwResponse(true, "Company review added successfully");
} else {
    throwResponse(false, "Can't add company review because " . mysqli_error($con));
}
