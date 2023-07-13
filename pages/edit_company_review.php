 <?php

    include_once "../init.php";

    if (isset($_GET['_id']) && !empty($_GET['_id'])) {
        $_id = senitize_string($_GET['_id']);

        if (!is_data_exist('company_reviews', "`id` = '$_id'")) {
            $error = "Faild";
        } else {
            $sql = "SELECT * FROM `company_reviews` WHERE `id` = '$_id'";
            $tour = fetch_data($sql);


            $comp_slug = "";
            $comp_text = "";

            if (isset($tour['meta_tag_info'])) {
                $meta_info = json_decode($tour['meta_tag_info'], JSON_UNESCAPED_UNICODE);
                $comp_slug = (isset($meta_info['slug'])) ? $meta_info['slug'] : "";
                $comp_text = (isset($meta_info['text'])) ? $meta_info['text'] : "";
            }
        }
    } else {
        $error = "Failed";
    }


    ?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">


     <title>Edit Tour</title>

     <?php
        include_once HEAD;
        ?>

     <link rel="stylesheet" href="<?= get_css(); ?>table.global.css">
     <link rel="stylesheet" href="<?= get_file('PAGE_company_review_add.css'); ?>">

     <style>
         * {
             list-style: unset !important;
         }
     </style>



 </head>

 <body>

     <?php include_once MENU;
        if (isset($error)) : ?>

         <main>
             <p>Sorry! The Company Review you want to edit is not available. <a href="<?= home_path() . "/company-reviews" ?>">Go Back To Company Reviews</a> </p>
         </main>


     <?php else : ?>


         <main>
             <div class="page-header">

                 <div class="page-header-breadcrumb">
                     <a href="<?= base_url(); ?>">Dashboard</a>
                     <p>/</p>
                     <a href="<?= base_url(); ?>/company-reviews"> Reviews </a>
                     <p>/</p>
                     <a href="#"> Edit </a>

                 </div>

                 <p class="page-header-heading"> Edit Review </p>
                 <div class="page-header-btn-container">
                     <button class="btn-yellow-1" onclick="edit_company_review()"> Update Review</button>
                 </div>

             </div>
             <section>
                 <div>
                     <div class="box-1">



                         <p class="input-lable">
                             Company Name:
                         </p>
                         <input type="name" value="<?= $tour['company_name'] ?>" id="name">
                         <input type="name" value="<?= $tour['id'] ?>" id="id" hidden>

                         <p class="input-lable">
                             Slug:
                         </p>
                         <input type="slug" id="slug" value="<?= $tour['slug'] ?>">


                         <p class="input-lable">Company Text</p>
                         <p id="description"></p>

                         <p class="input-lable">Meta</p>
                         <textarea id="seo" min-row="10"><?= $tour['seo'] ?></textarea>

                     </div>

                 </div>


                 <div>
                     <div class="box-1">

                         <p class="input-lable">
                             Star:
                         </p>
                         <input type="number" min="0" id="star" value="<?= $tour['stars'] ?>">

                         <p class="input-lable">
                             MC#:
                         </p>
                         <input type="text" id="mc" value="<?= $tour['mc'] ?>">
                         <p class="input-lable">
                             Phone:
                         </p>
                         <input type="text" id="phone" value="<?= $tour['phone'] ?>">

                         <p class="input-lable">
                             US-Dot:
                         </p>
                         <input type="text" id="us_dot" value="<?= $tour['us_dot'] ?>">

  
                         <p class="input-lable">
                             Address-1:
                         </p>
                         <input type="text" id="addr1" value="<?= $tour['addr1'] ?>">



                         <p class="input-lable">
                             Address-2:
                         </p>
                         <input type="text" id="addr2" value="<?= $tour['addr2'] ?>">


                     </div>
                 </div>
             </section>

         </main>



         <?php include_once SCRIPT; ?>

         <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
         <script type="text/javascript" src="<?= get_file('edit_company_review.js'); ?>"></script>

         <script type="text/javascript">
             $(document).ready(function() {
                 description.setData(`<?= $tour['company_text'] ?>`);
             })
         </script>



     <?php endif; ?>


 </body>

 </html>