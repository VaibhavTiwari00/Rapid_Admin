<?php


include_once '../__api.php';

extract(senitize_array($_POST));


$response = [];


$q = "UPDATE `user_reviews` SET `name`='$name',`ratting`='$star',`review`='$review' WHERE `id` = '$id'";

$res = query($q);

if ($res) {
    throwResponse(true, "User review updated successfully");
} else {
    throwResponse(false, "Can't update User review because " . mysqli_error($con));
}
