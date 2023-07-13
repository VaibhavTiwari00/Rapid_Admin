 <?php
    include_once "../init.php";
    authorized_user_only();
    ?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">


     <title>Add New Review</title>

     <?php
        include_once HEAD;
        ?>

     <link rel="stylesheet" href="<?= get_css(); ?>table.global.css">
     <link rel="stylesheet" href="<?= get_css(); ?>tours_list.css">
     <link rel="stylesheet" href="<?= get_css(); ?>PAGE_company_review_add.css">

     <style>
         * {
             list-style: unset !important;
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
                 <a href="#"> Add Review </a>
             </div>

             <p class="page-header-heading"> Create Review </p>
             <div class="page-header-btn-container">

                 <button class="btn-yellow-1" onclick="add_company_review()"> Save Review</button>

             </div>




         </div>
         <section>
             <div>
                 <div class="box-1">  

                     <p class="input-lable">Compnay Name:</p>
                     <input type="text" id="name">

                     <p class="input-lable"> Slug: </p>
                     <input type="text" id="slug">

                     <p class="input-lable">Company Pragraph:</p>
                     <p id="description"></p>

                     <p class="input-lable">Meta Tags:</p>
                     <textarea type="text" id="meta-tags" rows="12"></textarea>

                 </div>



             </div>
             <div>
                 <div class="box-1">

                     <p class="input-lable">
                         Company Phone No:
                     </p>
                     <input type="text" id="phone">

                     <p class="input-lable">
                         Address 1 :
                     </p>
                     <textarea type="text" id="addr1"></textarea>
                     <p class="input-lable">
                         Address 2 :
                     </p>
                     <textarea type="text" id="addr2"></textarea>

                     <p class="input-lable">
                         Star:
                     </p>
                     <input type="number" min="0" id="star">

                     <p class="input-lable">
                         MC:
                     </p>
                     <input type="text" id="mc">

                     <p class="input-lable">
                         US DOT:
                     </p>
                     <input type="text" id="us_dot">

                 </div>

             </div>
         </section>

     </main>



     <?php include_once SCRIPT; ?>

     <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
     <script type="text/javascript" src="<?= get_js(); ?>add_company_review.js"></script>


 </body>

 </html>