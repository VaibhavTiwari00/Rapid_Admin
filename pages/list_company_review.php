<?php
include_once "../init.php";

authorized_user_only();


// $POST = json_decode(stripslashes(file_get_contents('php://input')), true);

// print_r($POST);

// if (isset($POST['name'])) {
//     echo "name available: " . $POST['name'];
// } else {
//     echo "can't get name";
// }




$query_to_fetch_tours = "SELECT company_reviews.*, Count(user_reviews.id) AS review_count FROM company_reviews LEFT JOIN user_reviews ON company_reviews.slug = user_reviews.company_slug GROUP BY company_reviews.id ORDER BY company_reviews.added_on DESC";


$reviews_list = fetch_all_data($query_to_fetch_tours);
for ($count_r = 0; $count_r < count($reviews_list); $count_r++) {
    $count_r = ++$count_r;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Review List</title>

    <?php
    include_once HEAD;
    ?>

    <link rel="stylesheet" href="<?= get_css(); ?>table.global.css">
    <link rel="stylesheet" href="<?= get_css(); ?>tours_list.css">

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
                <a href="#">Dashboard</a>
                <p>/</p>
                <a href="#">Review List </a>
            </div>

            <p class="page-header-heading"> Review List (<?= $count_r ?>) </p>
            <div class="page-header-btn-container">
                <input type="text" name="" id="search" placeholder="Search" onkeyup="serach_data(this.value)">
                <a href="<?= home_path() . '/company-reviews/add'  ?>" class="btn-yellow-1">Add Review</a>

            </div>



        </div>


        <div class="box-1 table-box">


            <div class="search-box">

            </div>

            <div class="m-table box-table">
                <div class="table-row table-head">


                    <div>
                        <p>Company Name</p>
                    </div>
                    <div>
                        <p>Star</p>
                    </div>

                    <div>
                        <p>Review</p>
                    </div>


                    <div>
                        <p>Address</p>
                    </div>
                    <div class="align-item-center">
                        <p>Phone</p>
                    </div>
                    <div class="align-item-center">
                        <p>Action</p>
                    </div>




                </div>

                <div class="table-body" id="company-reviews-list">
                    <?php



                    if ($reviews_list) {

                        for ($i = 0; $i < count($reviews_list); $i++) {

                            $review = $reviews_list[$i];


                    ?>

                            <div class="table-row">
                                <div>
                                    <a href="<?= home_path() . "/company-reviews/edit/" . $review['id'] ?>" style="text-decoration:none;"> <?= $review['company_name']  ?></a>
                                </div>

                                <div>
                                    <p><?= $review['stars'] ?></p>
                                </div>
                                <div class="align-item-center ">
                                    <a href="<?= home_path() . "/company-reviews/" . $review['slug'] ?>"><?= $review['review_count'] ?></a>
                                </div>

                                <div>
                                    <p><?= $review['addr1']  ?></p>
                                </div>
                                <div>
                                    <p><?= $review['phone']  ?></p>
                                </div>

                                <div class="align-item-center ">
                                    <a href="https://rapidautoshipping.com/auto-transport-carriers/<?= $review['slug'] ?> " class="btn-yellow-1">More</a>
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


        function serach_data(data) {
            data = data.toLowerCase();
            let perant = document.getElementById('company-reviews-list');
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