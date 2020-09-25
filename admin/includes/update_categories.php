<?php// include"../../user/includes/db.php"?>
                        <form action="" method="post">
                            <div class="form-group">
                               <label for="cat_title"><h4>Edit Category Name</h4></label>
                               
                                <?php
                                
                           if(isset($_GET['edit_id'])){
                           $cat_id=$_GET['edit_id'];
                            
                            $qry_edit="SELECT * FROM categories WHERE cat_id = $cat_id";
                            $result_edit=mysqli_query($con,$qry_edit);
                            
                            while($row_edit=mysqli_fetch_assoc($result_edit)){
                                $cat_id=$row_edit['cat_id'];
                                $cat_title=$row_edit['cat_title'];
                            ?>
                            <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">
                        <?php   
                           }
                           }
                        ?>
                                
                       
                        <?php
                            // Update Query //
                            if(isset($_POST['edit_submit'])){
                                $cat_title=$_POST['cat_title'];
                                $qry_update="UPDATE categories SET cat_title = '{$cat_title}' WHERE  cat_id = {$cat_id}";
                                $result_update=mysqli_query($con,$qry_update);
                                if($result_update){
                                    header("Location:categories.php");  
                                }
                            
                            }
                        ?>
                        
                          </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_submit" value="Edit">
                            </div>
                        </form>