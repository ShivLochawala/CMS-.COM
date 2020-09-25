<?php include "includes/admin_header.php"?>
<?php include "../user/includes/db.php"; ?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";?>
        <!-- Navigation -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Update Post
                            <small>Page</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                        <?php
                                
                           if(isset($_GET['edit_id'])){
                                $post_id=$_GET['edit_id'];
                               
                            $qry_edit="SELECT * FROM posts WHERE post_id = $post_id";
                            $result_edit=mysqli_query($con,$qry_edit);
                            
                            while($row_edit=mysqli_fetch_assoc($result_edit)){
                                $post_id=$row_edit['post_id'];
                                $user_id=$row_edit['user_id'];
                                $post_title=$row_edit['post_title'];
                                $post_cat_id=$row_edit['cat_id'];
                                $post_img=$row_edit['post_img'];
                                $post_tags=$row_edit['post_tags'];
                                $post_status=$row_edit['post_status'];
                                $post_content=$row_edit['post_content'];
                            ?>
                            <label>Post Title</label>
                            <input value="<?php if(isset($post_title)){echo $post_title;} ?>" type="text" class="form-control" name="post_title"><br>
                             
                            <label>Post Category Id</label>
                            <select class="form-control" name="select_cat_id">
                                
                                   <?php
                                    $qry_get="SELECT * FROM categories";
                                    $result_get=mysqli_query($con,$qry_get);
                                    while($row=mysqli_fetch_assoc($result_get)){
                                        $cat_id=$row['cat_id'];
                                        $cat_title=$row['cat_title'];
                                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                                    }
                                ?>
                            </select>
                            <br>
                            
                            <label>Post Author</label>
                            <select class="form-control" name="user_id">
                                   <?php
                                    $qry_get="SELECT * FROM users";
                                    $result_get=mysqli_query($con,$qry_get);
                                    while($row=mysqli_fetch_assoc($result_get)){
                                        $user_id = $row['user_id'];
                                        $user_name = $row['user_name'];
                                        echo "<option value='{$user_id}'>$user_name</option>";
                                    }
                                ?>
                            </select><br>
                            <br>
                            
                            <label>Post Status</label>
                            <select name="post_status" class="form-control">
                            <option value="<?php echo $post_status;?>"><?php echo $post_status;?></option>
                            <?php
                            if($post_status == "published"){
                                echo "<option value='draft'>draft</option>";
                            }else{
                                echo "<option value='published'>published</option>";
                            }
                            ?>
                            </select>
                           
                            <label>Post Image</label>
                            <input value="<?php if(isset($post_img)){echo $post_img;} ?>" type="file" class="form-control" name="post_img">
                            <img src="../user/img/<?php echo $post_img; ?>" width="100px" height="100px"><br>
                            
                            <label>Post Tags</label>
                            <input value="<?php if(isset($post_title)){echo $post_tags;} ?>" type="text" class="form-control" name="post_tags"><br>
                            
                            
                            <label>Post Content</label>
                            <textarea name="post_content" class="form-control" cols="30" rows="10" required>
                            <?php if(isset($post_content)){echo $post_content;} ?>
                            </textarea><br>
                        <?php   
                           }
                        }
                        ?>
                        <?php
                            // Update Query //
                            if(isset($_POST['edit_submit'])){
                                $user_id=$_POST['user_id'];
                                $post_title=$_POST['post_title'];
                                $post_cat_id=$_POST['select_cat_id'];
                                
                                $post_img=$_FILES['post_img']['name'];
                                $post_img_temp=$_FILES['post_img']['tmp_name'];
                                
                                $post_tags=$_POST['post_tags'];
                                $post_status=$_POST['post_status'];
                                $post_content=$_POST['post_content'];
                                
                                move_uploaded_file($post_img_temp,"../user/img/$post_img");
                                
                                $qry_update="UPDATE posts SET cat_id = {$post_cat_id}, post_title = '{$post_title}', user_id = '{$user_id}', post_img = '{$post_img}', post_content = '{$post_content}', post_tags = '{$post_tags}', post_status = '{$post_status}' WHERE post_id = {$post_id}";
                                $result_update=mysqli_query($con,$qry_update);
                                if($result_update){
                                    header("Location:view_posts.php");  
                                }else{
                                    die("Not updated".mysqli_error($con));
                                    echo "<h4 style='color:red;'>Not Updated</h4>"; 
                                }
                                /*echo "post id: ".$post_id."<br>";
                                echo "post author: ".$post_author."<br>";
                                echo "post title: ".$post_title."<br>";
                                echo "post cat_id: ".$post_cat_id."<br>";
                                echo "post img: ".$post_img."<br>";
                                echo "post tags: ".$post_tags."<br>";
                                echo "post status: ".$post_status."<br>";
                                echo "post content: ".$post_content."<br>";*/
                            }
                        ?>
                        
                          </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_submit" value="Update">
                            </div>
                        </form>
                    
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"?>
