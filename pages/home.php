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


</head>

<body>

    <?php
    include_once MENU;

    ?>

    <main>

        <div class="dashborad-main">
            <div class=" box-1 report-box">
                <p>Totale Sale</p>
                <p>₹ 35000</p>
                <p>Compared to April 2021</p>

            </div>

            <div class=" box-1 report-box">
                <p>Totale Sale</p>
                <p>₹ 35000</p>
                <p>Compared to April 2021</p>

            </div>

            <div class=" box-1 report-box">
                <p>Totale Sale</p>
                <p>₹ 35000</p>
                <p>Compared to April 2021</p>

            </div>

        </div>

    </main>




    <?php
    include_once SCRIPT;
    ?>

</body>

</html>