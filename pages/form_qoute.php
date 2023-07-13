<?php
include_once "../init.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Admin Panel</title>

    <?php
    include_once HEAD;
    ?>

    <link rel="stylesheet" href="<?= get_css() ?>dashboard.css">
    <link rel="stylesheet" href="<?= get_css() ?>form_qoute.css">
    <style>
        main{
            padding: 0;
        }
    </style>

</head>

<body>

    <?php
    include_once MENU;

    ?>
    <?php
    $message_query = "SELECT * FROM form_qoute order by id desc";
    $message_result = mysqli_query($con, $message_query) or die('message query failed');
    ?>

    <main>
        <section style="display:flex;">
            <div class="message_tab">
                <?php
                foreach($message_result as $message){;?>
                <div class="notification <?php echo $message['status'];?>" data-id= "<?php echo $message['id'];?>">
                    <div class="message">
                        <div class="usr_dtl">
                            <div class="user_img"><img src="<?=get_img()?>user.png" width="32px" alt="user"></div>
                            <div class="user_name"><?php echo $message['username'];?></div>
                        </div>
                        <div class="message_time">
                           <p><?php
                                 $dateStr = strtotime($message['added_on']);
                                 echo date('d-m-Y', $dateStr);
                                ?></p>
                        </div>
                    </div>
                </div>
               <?php }
                 ?>
                
    
            </div>
             <div class="details_tab" id="details_tab">
                <!-- <div class=" details_heading flex_space_between">
                    <h3>User Name: Harry</h3>
                    <h3>Phone Number: 1234567890</h3>
                </div>
                <div class="  details_heading flex_space_between">
                    <h3>Email: Harry</h3>
                    <h3>Qoute ID: 1234567890</h3>
                </div>
                <div class=" details_heading flex_space_between">
                    <h3>Ship From: Harry</h3>
                    <h3>Ship To: 1234567890</h3>
                </div>
                <div class=" details_heading flex_space_between">
                    <h3>Distance: Harry</h3>
                    <h3>Pick Up Date: 1234567890</h3>
                </div>
                <div class=" details_heading flex_space_between">
                    <h3>Make: Harry</h3>
                    <h3>Model: 1234567890</h3>
                </div>
                <div class=" details_heading flex_space_between">
                    <h3>Vehicle Size: Harry</h3>
                    <h3>Year: 1234567890</h3>
                </div>
                <div class=" details_heading flex_space_between">
                    <h3>Transport Method: Harry</h3>
                    <h3>Vehicle Type: 1234567890</h3>
                </div> -->

    
             </div>
        </section>

    </main>




    <?php
    include_once SCRIPT;
    ?>
    <script>
        $(".notification").on('click', function(){
            let noti_id = $(this).attr("data-id");
            if($(this).hasClass('unread')){
                $(this).removeClass('unread');
                $(this).addClass('read');
            }
           $.ajax({
            url : "<?= home_path();?>/services/form_qoute/view.php",
            method: "GET",
            data: "id="+noti_id,
            success: function(res){
                $('#details_tab').html(res);
            }
           })
        })
    </script>

</body>

</html>