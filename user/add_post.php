<?php include"includes/db.php";?>
     <!-- BEGIN HEAD -->
    <?php include"includes/header.php"; ?>
    <!-- END HEAD -->
<!-- BODY -->
<body>
        <!--========== HEADER ==========-->
        <?php include"includes/navigation.php"; ?>
         <br><br>
        <!--========== END HEADER ==========-->
        <!-- Latest Products -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                             Add Post
                            <small>Page</small>
                        </h1>
                    </div>
                </div>
                <div class="form-group">
                    <form action="" method="post" enctype="multipart/form-data">
                        <label>Post Title</label>
                        <input type="text" name="title" class="form-control" style="border-style:solid;" required><br>
                        
                        <label>Post Category </label>
                        <select class="form-control" name="select_cat_id" style="border-style:solid;">
                                   <?php
                                    $qry_get="SELECT * FROM categories";
                                    $result_get=mysqli_query($con,$qry_get);
                                    while($row=mysqli_fetch_assoc($result_get)){
                                        $cat_id=$row['cat_id'];
                                        $cat_title=$row['cat_title'];
                                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                                    }
                                ?>
                            </select><br>
                        
                        <label>Post Image</label>
                        <input type="file" name="image" class="form-control" style="border-style:solid;" required><br>
                        
                        <label>Post Tags</label>
                        <input type="text" name="tags" class="form-control" style="border-style:solid;" required><br>
                        
                        <label>Post Content</label>
                        <textarea name="content" class="form-control" cols="30" rows="10" style="border-style:solid;" required>
                        </textarea><br>
                        
                        <input type="submit" name="insert_submit" value="Add Post" class="btn btn-primary">
                    </form>
                </div>
                <!-- /.row -->
                <?php
                if(isset($_POST['insert_submit'])){
                    $post_title=$_POST['title'];
                    $post_cat_id=$_POST['select_cat_id'];
                    $user_id=$_SESSION['user_id'];
                    $post_tags=$_POST['tags'];
                    $post_content=$_POST['content'];
                    
                    $post_img=$_FILES['image']['name'];
                    $post_img_temp=$_FILES['image']['tmp_name'];
                    
                    $post_date=date('d-m-y');
                    //$post_comment_count=4;
                    
                    
                    move_uploaded_file($post_img_temp,"../user/img/$post_img");
                    
                    $qry_add="INSERT INTO posts(cat_id,post_title,user_id,post_date, post_img,post_content,post_tags,post_status) VALUES ({$post_cat_id},'{$post_title}',{$user_id},now(),'{$post_img}','{$post_content}','{$post_tags}','published')";
                    
                    $result_add=mysqli_query($con,$qry_add);
                    if($result_add){
                        echo "<h4 style='color:green;'>Post Added</h4>";
                    }else{
                        echo "<h4 style='color:red;'>Post not Added</h4>";
                    }
                }
                ?>

            </div>
            <!-- /.container-fluid -->

        </div>

        <!--========== END FOOTER ==========-->
</body>
<?php include"includes/footer.php"; ?>