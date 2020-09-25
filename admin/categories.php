<?php include"includes/admin_header.php"?>
<?php include"includes/functions.php"; ?>
<?php include"../user/includes/db.php"?>
<?php ob_start(); ?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include"includes/admin_navigation.php";?>
        
        <!-- Navigation -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categories 
                            <small>Page</small>
                        </h1>
                        <div class="col-lg-6">
                        <form action="categories.php" method="post">
                            <div class="form-group">
                               <label for="cat_title"><h4>Category Name</h4></label>
                                <input type="text" class="form-control" name="cat_title" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                        <?php
                             if(isset($_POST['submit'])){
                            insert_category();
                             }
                        ?>
                        
                        
                        </div><!-- Add Category Name -->
                        
                         
                         <div  class="col-lg-6">
                          <h4 style="color:blue;"><center>View Categories Details</center></h4>
                           <table class="table table-bordered table-hover">
                               <thead>
                                   <tr>
                                       <th>ID</th>
                                       <th>Category Title</th>
                                       <th>Edit</th>
                                       <th>Delete</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <?php
                             //DISPLAY DATA OF categories Table    
                                    display_categories();
                                    ?>
                               </tbody>
                            </table>
                            <?php
                            if(isset($_GET['delete_id'])){
                                delete_category();
                            }
                            ?>
                        </div>
                        <div class="col-lg-6">
                        <?php
                          if(isset($_GET['edit_id'])){
                              $cat_id = $_GET['edit_id'];
                              include "includes/update_categories.php";
                          }  
                        ?>
                        
                        </div>
                        
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include"includes/admin_footer.php"?>
