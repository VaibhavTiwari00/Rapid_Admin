<!-- <?php

include_once '../init.php';
if (Admin::isAuthorized()) {
    header("Location:" . base_url());
}

$user_mail = "";
$user_pass = "";



if (isset($_POST['user-mail'])) {
    $user_mail = $_POST['user-mail'];

    if (isset($_POST['user-pass'])) {
        $user_pass = $_POST['user-pass'];

        // init admin class
        $admin = new Admin();

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
    <title>Register</title>
    <?php include_once HEAD;
    ?>

    <link rel="stylesheet" href="<?= get_css() ?>login.css">

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
            <form class="register-section-content" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form" onsubmit="return validateform()">
                <div class="input-div">
                    <p>Email</p>
                    <input type="email" autocomplete="off" auto placeholder="E-mail" name="email" id="email">
                    <div id="mail-error"></div>
                </div>

                <div class="input-div">
                    <p>Password</p>
                    <input type="password" placeholder="Password" name="pass" id="pass">
                    <div id="pass-error"></div>
                </div>


                <div class="button">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </section>


    <script>
        function seterror(id, error) {
            element = document.getElementById(id);

            element.innerHTML = error;
        }

        function validateform() {
            var ret = false;
            var email = document.forms['form']["email"].value;
            var pass = document.forms['form']["pass"].value;


            if (pass.length == 0) {

                seterror("pass-error", "Length of pass is too short");

            } else {
                seterror("pass-error", "");
            }
            if (email.length == 0) {

                seterror("mail-error", "Length of email is too short");


            } else {
                seterror("mail-error", "");
            }

            if (email.length == 0 || pass.length == 0) {
                ret = false;
            } else {
                ret = true;
            }

            return ret;
        }
    </script>
</body>

</html> -->