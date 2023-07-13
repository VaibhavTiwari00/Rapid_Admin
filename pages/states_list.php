<?php
include_once "../init.php";

authorized_user_only();



$query_to_fetch_states = "SELECT * FROM `states`";
$state_list = fetch_all_data($query_to_fetch_states);






?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>State List</title>

    <?php
    include_once HEAD;
    ?>
    <link rel="stylesheet" href="<?= get_css(); ?>table.global.css">
    <link rel="stylesheet" href="<?= get_css(); ?>blogs_list.css">


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
                <a href="#">State List </a>
            </div>

            <p class="page-header-heading"> State (<?= isset($state_list) ?  count($state_list) : 0 ?>) </p>


            <div class="page-header-btn-container">
                <input type="text" name="" id="search" placeholder="Search" onkeyup="serach_data(this.value)">
                <a href="<?= home_path() . '/states/add'  ?>" class="btn-yellow-1">Add State</a>

            </div>



        </div>


        <div class="box-1 table-box">
       
           <div class="search-box">

            </div>
           <div class="m-table box-table">
           <table  class="blog_table">
                <thead class="blog_table_head">
                    <tr>
                        <th width="40%">Title</th>
                        <th width="30%">Slug</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody class="blogs_tbody">
                    <?php
                    if(isset($state_list)){
                        foreach($state_list as $row){ ;?>
                            <tr>
                                <td><?php echo $row['title'];?></td>
                                <td><?php echo $row['slug'] ;?></td>
                                <td><button class="view_btn"><a href="https://rapidautoshipping.com/states/<?= $row['slug'] ?>">View</a></button> <button class="edit_btn"><a href="<?= home_path() . "/states/edit/" . $row['id'];?>">Edit</a></button></td>
                            </tr>
                           <?php }
                    }else{ ; ?>
                        <tr>
                           <td colspan="6"> No Data Found</td>
                        </tr>
                   <?php }
                    
                    ?>
                    
                   
                    
                </tbody>
            </table>
           </div>

        </div>
        </div>

    </main>

    <?php
    include_once SCRIPT;
    ?>

    <script type="text/javascript">
        


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