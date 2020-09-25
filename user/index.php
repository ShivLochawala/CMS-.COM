<?php include"includes/db.php";?>
     <!-- BEGIN HEAD -->
    <?php include"includes/header.php"; ?>
    <!-- END HEAD -->
<!-- BODY -->
<body>
        <!--========== HEADER ==========-->
        <?php include"includes/navigation.php"; ?>
        <!--========== END HEADER ==========-->
        <!-- Latest Products -->
          
        <div class="content-lg container">
          
            <div class="row margin-b-40">
                <div class="col-sm-6">
                    <h2>Post of Users</h2>
                    <p>There are different types of users details and post details can be see here.</p>
                </div>
                
                <!-- Blog Search Well-->
                <div class="col-sm-6 col-right">
                   <div class="well">
                    <h4>Search Username</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button name ="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <?php
                if(isset($_POST["submit"])){
                    $search=$_POST['search'];  
                    
                    $qry="SELECT * FROM users where user_name LIKE '%$search%' ";
                    $search_qry=mysqli_query($con,$qry);
                    if(!$search_qry){
                     
                        die("Query Failed".mysqli_error($con));
                    
                    }
                    $count=mysqli_num_rows($search_qry);
                    if($count==0){
                        echo "<h2 style='color:red;'>No Result Found</h2>";
                    }else{
                        header("Location: search.php");
                    }   
                }
                
                ?>
                    </div>
                </div>
            </div>
            <!--// end row -->
            <?php
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = "";
            }
            if($page == ""||$page == 1){
                $page_1 = 0;
            }else{
                $page_1 = ($page * 6)-6;
            }
            
            
            $post_count = mysqli_query($con,"SELECT * FROM posts WHERE post_status = 'published'"); 
            $count = mysqli_num_rows($post_count);
            $count = ceil($count/6);
            
            $qry="SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1,6";
            $select_all_posts_qry= mysqli_query($con,$qry);
    
    while($row=mysqli_fetch_assoc($select_all_posts_qry)){
        $post_id=$row['post_id'];
        $post_title=$row['post_title'];
        $user_id=$row['user_id'];
        $post_date=$row['post_date'];
        $post_img=$row['post_img'];
        $post_content=substr($row['post_content'],0,50);
        ?>
            <div>
                <!-- Latest Products -->
                <div class="col-sm-4 sm-margin-b-50">
                    <div class="margin-b-20">
                        <h2><a href="post.php?post_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a></h2>
                        <?php
                        $userid = mysqli_query($con,"SELECT user_name FROM users WHERE user_id={$user_id}");
                        $rows = mysqli_fetch_assoc($userid);
                        $username = $rows['user_name'];
                        ?>
                    <p>by <a href="author_post.php?user_id=<?php echo $user_id; ?>"><?php echo $username; ?></a></p>
                    <p>
                      <span class="glyphicon glyphicon-time">
                        </span>
                    Posted on <?php echo $post_date; ?></p>
                           <div class="wow zoomIn" data-wow-duration=".3" data-wow-delay=".1s">
                            <a href="post.php?post_id=<?php echo $post_id;?>"><img class="img-responsive" src="img/<?php echo $post_img; ?>" alt="Latest Products Image" style="height:300px; width:300px;"></a>
                        </div>
                    </div>
                   <!-- <h4><a href="#">Triangle Roof</a> <span class="text-uppercase margin-l-20">Management</span></h4>-->
                    <p style="height:50px; width:300px;"><?php echo $post_content; ?></p>
                    <a class="link" href="post.php?post_id=<?php echo $post_id;?>">Read More</a>
                </div>
                <!-- End Latest Products -->

               
            </div>
            <?php
        }
            
            ?>
            <!--// end row -->
        </div>
        <hr>
        <ul class="pager">
        <?php
        for($i = 1; $i <= $count; $i++){
            if($i == $page){
                echo "<li><a style='background:gray;' href='index.php?page={$i}'>{$i}</a></li>";        
            }else{
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";    
            }
        }    
        ?>    
        </ul>
        <!--========== END PAGE LAYOUT ==========-->

        <!--========== FOOTER ==========-->
        <?php include"includes/footer.php"; ?>
        <!--========== END FOOTER ==========-->
    </body>
    <!-- END BODY -->