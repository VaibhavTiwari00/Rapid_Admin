<?php
include_once '../__api.php';

$id = $_GET['id'];
$query = "SELECT * FROM form_qoute where id = '$id'";
$result = mysqli_query($con, $query) or die('details query failed');
$row = mysqli_fetch_assoc($result);

if($row['status'] == "unread"){
    $edit_query = "UPDATE form_qoute SET status='read' where id = '$id'";
    mysqli_query($con, $edit_query) or die("edit query failed");
}
echo '<div class=" details_heading flex_space_between">
<h3>User Name: '.$row['username'].'</h3>
<h3>Phone Number: '.$row['phone'].'</h3>
</div>
<div class="  details_heading flex_space_between">
<h3>Email: '.$row['email'].'</h3>
<h3>Qoute ID: '.$row['qoute_id'].'</h3>
</div>
<div class=" details_heading flex_space_between">
<h3>Ship From: '.$row['ship_from'].'</h3>
<h3>Distance: '.$row['distance'].'</h3>

</div>
<div class=" details_heading flex_space_between">
<h3>Ship To: '.$row['ship_to'].'</h3>
<h3>Make: '.$row['make'].'</h3>

</div>
<div class=" details_heading flex_space_between">
<h3>Pick Up Date: '.$row['pickup_date'].'</h3>
<h3>Model: '.$row['model'].'</h3>
</div>
<div class=" details_heading flex_space_between">
<h3>Vehicle Size: '.$row['vehicle_size'].'</h3>
<h3>Year: '.$row['year'].'</h3>
</div>
<div class=" details_heading flex_space_between">
<h3>Transport Method: '.$row['t_method'].'</h3>
<h3>Vehicle Type: '.$row['vehicle_type'].'</h3>
</div>';
?>