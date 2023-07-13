<?php
include_once '../__api.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $title = senitize_string($_POST['title']);
    $slug = senitize_string($_POST['slug']);
    $meta =  senitize_string($_POST['meta']);
    $h1 = senitize_string($_POST['h1']);
    $h1_about = senitize_string($_POST['h1_about']);
    $h2 = senitize_string($_POST['h2']);
    $h2_about = senitize_string($_POST['h2_about']);
    $content = senitize_string($_POST['content']);
    $city_zip = $_POST['city_zip'];

    $sql_query = "INSERT INTO states (title, slug, meta, h1, h1_about, h2, h2_about, content, city_zipcode) VALUES ('$title', '$slug', '$meta', '$h1', '$h1_about', '$h2', '$h2_about', '$content', '$city_zip')";
    $insert = mysqli_query($con, $sql_query) or die("insert query failed");

    if($insert){
        header('LOCATION:'.home_path().'/states');
    }
    else{
        echo "not inserted";
    }

} 
?>