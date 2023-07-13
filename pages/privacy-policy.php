<?php
include_once "../init.php";

// init db base 

$db = new Db();

$sql = "SELECT * FROM  `site_settings` WHERE `setting_id` = 1001";
$settings = $db->fetch_data($sql);


$doc = $settings['privacy-policy'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Privacy Policy</title>

    <?php
    include_once HEAD;
    ?>

    <style>
        .ck-blurred,
        .ck-focused {
            min-height: 70vh;
            overflow-x: auto;
        }
    </style>


</head>

<body>

    <?php
    include_once MENU;

    ?>

    <main>

        <div class="page-header">

            <div class="page-header-breadcrumb">
                <a href="#">Dashboard</a>
                <p>/</p>
                <a href="#">Privacy Policy</a>
            </div>

            <p class="page-header-heading"> Privacy Policy </p>

            <div class="page-header-btn-container">

                <button class="btn-yellow-1" id="save-btn"> Save </button>

            </div>


        </div>

        <textarea id="doc"></textarea>

    </main>




    <?php
    include_once SCRIPT;
    ?>

    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script type="text/javascript">
        let text_area;
        ClassicEditor
            .create(document.querySelector('#doc'))
            .then(editor => {
                text_area = editor;
            })
            .catch(error => {
                console.error(error);
            });


        $(document).ready(function() {
            text_area.setData(`<?= $doc ?>`);
        })


        $("#save-btn").click(function() {
            if (text_area.getData() != "") {

                formdata = new FormData();
                formdata.append("text", text_area.getData());
                $.ajax({
                    url: DOMAIN + "/api/docs/1",
                    type: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        toast.success("Document updated successfully");
                    }
                });

            } else {
                toast.error("Please enter atleast some lines")
            }
        })
    </script>

</body>

</html>