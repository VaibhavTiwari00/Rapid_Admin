<?php
include_once "../init.php";

authorized_user_only();


$query_to_fetch_tours = "SELECT * FROM `state_to_state`";
$state_list = fetch_all_data($query_to_fetch_tours);







// $POST = json_decode(stripslashes(file_get_contents('php://input')), true);

// print_r($POST);





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>State to state List</title>

    <?php
    include_once HEAD;
    ?>
    <link rel="stylesheet" href="<?= get_css(); ?>table.global.css">
    <link rel="stylesheet" href="<?= get_css(); ?>state-to-state-list.css">


    <style>
        #search {
            width: 200px;
        }
    </style>
</head>

<body>

    <?php
    include_once MENU;

    ?>



    <main>



        <!-- class heading is used for nav -->
        <div class="page-header">

            <div class="page-header-breadcrumb">
                <a href="">Dashboard</a>
                <p>/</p>
                <a href="#">State to state List </a>
            </div>

            <p class="page-header-heading"> State to state List (<?= isset($state_list) ?  count($state_list) : 0 ?>) </p>


            <div class="page-header-btn-container">
                <input type="text" name="" id="search" placeholder="Search" onkeyup="serach_data(this.value)">
                <a href="<?= home_path() . '/state-to-state/add'  ?>" class="btn-yellow-1">Add Pages</a>

            </div>



        </div>


        <div class="box-1 table-box">


            <div class="search-box">

            </div>

            <div class="m-table box-table">
                <div class="table-row table-head">


                    <div>
                        <p>State</p>
                    </div>
                    <div>
                        <p>To</p>
                    </div>
                    <div>
                        <p>State</p>
                    </div>


                    <div class="align-item-center">
                        <p>Slug</p>
                    </div>

                    <div class=" align-item-center">
                        <p>Action</p>
                    </div>
                </div>

                <div class="table-body" id="state-to-state-list">
                    <?php

                    if ($state_list) {

                        for ($i = 0; $i < count($state_list); $i++) {

                            $state = $state_list[$i];
                    ?>

                            <div class="table-row">
                                <div>
                                    <a href="<?= home_path() . "/state-to-state/edit/" . $state['state_id'] ?>" style="text-decoration:none;"> <?= $state['state_form']  ?></a>
                                </div>
                                <div>
                                    <p>--</p>
                                </div>
                                <div>
                                    <p style="text-decoration:none;"> <?= $state['state_to']  ?></p>
                                </div>
                                <div class="align-item-center">

                                    <a href="#" style="text-decoration:none;"><?= $state['slug'] ?></a>
                                </div>

                                <div class="align-item-center ">
                                    <a href="https://rapidautoshipping.com/state-to-state/<?= $state['slug'] ?> " class="btn-yellow-1">More</a>
                                </div>

                            </div>

                    <?php
                        }
                    }
                    ?>


                </div>
            </div>

        </div>
        </div>

    </main>

    <?php
    include_once SCRIPT;
    ?>

    <script type="text/javascript">
        function editTour(tourCode) {
            window.location.href = Root.editTour(tourCode);
        }

        function changeStatus(id, status) {
            let formdata = new FormData();
            formdata.append('id', id);
            formdata.append('status', status);
            $.ajax({
                url: DOMAIN + "/api/tour/change-status",
                type: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(data) {

                    if (data == "ok") {
                        toast.success("Tour status change Successfully");
                        window.location.reload();
                    } else {
                        toast.error("Faild to change status");
                    }
                }
            });
        }


        // var search = document.getElementById("search");
        // search.addEventListener("keyup", function() {
        //         serach_data(search.value.trim());
        //         // data = search.value.trim();
        //         // fetch(server.search_state_page(), {
        //         //         method: 'post',
        //         //         body: getFormData({
        //         //             data: data
        //         //         })
        //         //     }).then((response) => response.json())
        //         //     .then((data) => console.log(data))
        //         //     .catch((err) => console.log(err))
        //     }

        // )



        // function getFormData(object) {
        //     let form_data = new FormData();
        //     for (let key in object) {
        //         form_data.append(key, object[key]);
        //     }
        //     return form_data;
        // }


        function serach_data(data) {
            data = data.toLowerCase();
            let perant = document.getElementById('state-to-state-list');
            for (let index = 0; index < perant.children.length; index++) {
                const element = perant.children[index];
               
                let dd = element.children[0].children[0].innerHTML;
                dd = dd.toLowerCase()

                if (data != "" && dd.indexOf(data) == -1) {
                    element.style.display = "none";
                } else {
                    element.style.display = "grid";
                }
            }
        }
    </script>



</body>

</html>