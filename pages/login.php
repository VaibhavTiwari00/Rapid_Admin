<?php
include_once "../init.php";


$user_mail = "";
$user_pass = "";



if (isset($_POST['user-mail'])) {
    $user_mail = $_POST['user-mail'];

    if (isset($_POST['user-pass'])) {
        $user_pass = $_POST['user-pass'];

        // init admin class
        $admin = new User();

        if ($admin->login($user_mail, $user_pass) === true) {
            header('Location:' . base_url());
        } else {
            echo '<script type="text/javascript">
            alert("Wrong email or password!");
        </script>';
        }
    } else {
        echo `<script type="text/javascript"> alert("Something went wrong!");  </script>`;
    }
} else {
    echo `
        <script type="text/javascript">
        alert("Something went wrong!");
    </script>`;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Login</title>

    <?php
    include_once HEAD;
    ?>
    <link rel="stylesheet" href="<?= get_css(); ?>login-0.css">


</head>

<body>



    <section class="main-section">



        <div class="register-section">

            <div class="register-section-img">

                <div class="logo">
                    <img src="<?= get_img() ?>coloured-logo.jpg" alt="logo">
                </div>




            </div>
            <form class="register-section-content" action="<?= base_url(); ?>/login" method="post" class="form-login" onsubmit="return validate_login();">
                <div class="input-div">
                    <p>Email</p>
                    <input type="text" name="user-mail" id="user-email" value="<?= $user_mail; ?>" />


                </div>

                <div class="input-div">
                    <p>Password</p>
                    <input type="password" name="user-pass" id="user-password" value="<?= $user_pass; ?>" />

                </div>


                <div class="button">
                    <button type="submit" id="login-btn" value="Login">Login</button>
                </div>
            </form>
        </div>
    </section>

    <?php
    include_once SCRIPT;
    ?>

    <script src="<?= get_js(); ?>/login.js"></script>

</body>

</html>

