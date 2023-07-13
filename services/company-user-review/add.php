<?php


include_once '../__api.php';

extract(senitize_array($_POST));


$response = [];


$q = "INSERT INTO `user_reviews`( `company_slug`, `name`, `ratting`, `review`) VALUES ('$slug','$name','$star','$review')";

$res = query($q);

if ($res) {
    throwResponse(true, "Company review added successfully");
} else {
    throwResponse(false, "Can't add company review because " . mysqli_error($con));
}
