<?php
include_once "../init.php";

$count_r = 0;

// init db connection
$db = new Db();


$form_title = "Create New Review";
$title = "";
$star  = "";
$review_text = "";
$id = "";



if (isset($_GET["company_slug"]) && !isset($_GET['id'])) {
    $company_slug = _get('company_slug');

    if (!row_exists("SELECT * FROM `company_reviews` WHERE `slug` = '$company_slug'")) {
        redirect(home_path() . "/company-reviews");
    }
}


// counuter


$query_to_fetch_tours = "SELECT * FROM user_reviews WHERE `company_slug` = '$company_slug'";

$tours_array = fetch_all_data($query_to_fetch_tours);


if ($tours_array) {
    for ($count_r = 0; $count_r < count($tours_array); $count_r++) {

        $count_r = $count_r++;
    }
}



// check user editing review or not 
if (isset($_GET["company_slug"]) && isset($_GET['id'])) {

    $company_slug = _get('company_slug');
    $id = _get('id');

    $form_title = "Edit Review";

    $q = "SELECT * FROM user_reviews WHERE `company_slug` = '$company_slug' AND `id` = '$id'";
    $review = fetch_data($q);

    if (!$review) {
        redirect(home_path() . "/company-reviews/" . $company_slug);
    }

    if ($review) {
        $title = $review['name'];
        $star  = $review['ratting'];
        $review_text = $review['review'];
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title><?= home_path() ?></title>

    <?php
    include_once HEAD;
    ?>

    <link rel="stylesheet" href="<?= get_css(); ?>table.global.css">
    <link rel="stylesheet" href="<?= get_css(); ?>tours_category.css">


</head>

<body>

    <?php
    include_once MENU;

    ?>

    <main>

        <!-- class heading is used for nav -->
        <div class="page-header">

            <div class="page-header-breadcrumb">
                <a href="<?= home_path() ?>">Dashboard</a>
                <p>/</p>
                <a href="<?= home_path() . "/company-reviews" ?>"> Company Reviews </a>
            </div>

            <p class="page-header-heading"> Review List (<?= $count_r ?>)</p>
            <div class="page-header-btn-container">
                <?php

                if ($id != "") {
                    echo '
                    <a href="' . base_url() . '/company-reviews/' . $company_slug . '">
                        <button class="btn-yellow-1">Add New Review</button>
                    </a>
                ';
                }
                ?>


            </div>



        </div>



        <div class="table-or-form">
            <div class="box-1 table-box">

                <div class="m-table box-table">


                    <div class=" table-row table-head">




                        <div>
                            <p>Name</p>
                        </div>


                        <div>
                            <p>Star</p>
                        </div>

                        <div>
                            <p>Review</p>
                        </div>


                    </div>


                    <div class="table-body">
                        <?php



                        $query_to_fetch_tours = "SELECT * FROM user_reviews WHERE `company_slug` = '$company_slug'";

                        $tours_array = fetch_all_data($query_to_fetch_tours);

                        if ($tours_array) {

                            for ($i = 0; $i < count($tours_array); $i++) {

                                $tour = $tours_array[$i];


                        ?>
                                <div class="table-row">

                                    <div>
                                        <p><a href="<?= home_path() . "/company-reviews/" . $company_slug . "/" . $tour['id'] ?>"><?= $tour['name']  ?></a> </p>
                                    </div>

                                    <div>
                                        <p><?= $tour['ratting']  ?> </p>
                                    </div>

                                    <div>
                                        <p><?= $tour['review']  ?> </p>
                                    </div>

                                </div>
                        <?php

                            }
                        }
                        ?>

                    </div>

                </div>

            </div>

            <div class="box-1 category-create-form ">

                <p class="form-heading"><?= $form_title ?></p>


                <div class="input-group">
                    <label for="slug" class="input-lable">Name</lable>
                        <input type="text" id="name" value="<?= $title ?>">
                        <input type="text" id="id" value="<?= $id ?>" hidden>
                        <input type="text" id="slug" value="<?= $company_slug ?>" hidden>

                </div>
                <div class="input-group">
                    <label for="slug" class="input-lable">Star</lable>
                        <input type="number" id="star" value="<?= $star ?>">

                </div>
                <div class=" input-group">
                    <label for="slug" class="input-lable">Review</lable>
                        <textarea id="review" style="height:150px;"><?= $review_text ?></textarea>

                </div>

                <?php if ($id == "") : ?>
                    <button class=" btn-yellow-1" id="btn-crete-category" onclick="add_company_user_review()">Create</button>
                <?php else : ?>
                    <button class=" btn-yellow-1" id="btn-crete-category" onclick="update_company_user_review()">Update</button>
                <?php endif; ?>

            </div>
        </div>


    </main>


    <?php
    include_once SCRIPT;
    ?>

    <script type="text/javascript" src="<?= get_file('add_company_user_review.js'); ?>"></script>






</body>

</html>