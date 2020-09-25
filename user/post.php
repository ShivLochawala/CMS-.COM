<?php include"includes/db.php";?>
     <!-- BEGIN HEAD -->
    <?php include"includes/header.php"; ?>
    <!-- END HEAD -->
<!-- BODY -->
<body>
        <!--========== HEADER ==========-->
        <?php include"includes/navigation.php"; ?>
        <!--========== END HEADER ==========-->
        <?php
        if(isset($_POST['liked'])){
            $post_id = $_POST['post_id'];
            $user_id = $_POST['user_id'];
            $search_post = mysqli_query($con,"SELECT * FROM posts WHERE post_id=$post_id");
            $search = mysqli_fetch_assoc($search_post);
            $likes = $search['likes'];

            $search_post = mysqli_query($con,"UPDATE posts SET likes = $likes+1 WHERE post_id=$post_id");
            
            $likes_qry = mysqli_query($con,"INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
        }
        if(isset($_POST['unliked'])){
            $post_id = $_POST['post_id'];
            $user_id = $_POST['user_id'];
            $search_post = mysqli_query($con,"SELECT * FROM posts WHERE post_id=$post_id");
            $search = mysqli_fetch_assoc($search_post);
            $likes = $search['likes'];

            $likes_qry = mysqli_query($con,"DELETE FROM likes WHERE user_id=$user_id AND post_id=$post_id");
            
            $search_post = mysqli_query($con,"UPDATE posts SET likes = $likes-1 WHERE post_id=$post_id");
        }
        ?>
        <!--========== SLIDER ==========-->
        <?php// include"includes/slider.php"; ?>
        <!--========== SLIDER ==========-->
        <!--========== PAGE LAYOUT ==========-->
        <!-- Service -->
        
        <!-- End Service -->

        <!-- Latest Products -->
          
        <div class="content-lg container">
          
            <div class="row margin-b-40">
                <div class="col-sm-6">
                    <h2>Post of User</h2>
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
            if(isset($_GET['post_id'])){
                $post_id=$_GET['post_id'];
                
                $qry_view = mysqli_query($con,"UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id={$post_id}");
                if(!$qry_view){
                    die("Query Failed".mysqli_error($con));
                }
                $qry="SELECT * FROM posts WHERE post_id = {$post_id}";
                $select_all_posts_qry= mysqli_query($con,$qry);
    
    while($row=mysqli_fetch_assoc($select_all_posts_qry)){
        $post_title=$row['post_title'];
        $user_id=$row['user_id'];
        $post_date=$row['post_date'];
        $post_img=$row['post_img'];
        $post_content=$row['post_content'];
        ?>
            <div>
                <!-- Latest Products class="col-sm-4 sm-margin-b-50"-->
                <div>
                    <div class="margin-b-20">
                        <h2><?php echo $post_title; ?></h2>
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
                            <img class="img-responsive" src="img/<?php echo $post_img; ?>" alt="Latest Products Image" style="height:500px; width:500px;">
                        </div>
                    </div>
                   <!-- <h4><a href="#">Triangle Roof</a> <span class="text-uppercase margin-l-20">Management</span></h4>-->
                    <p style="width:300px;"><?php echo $post_content; ?></p>
                    <div class="row">
                    <?php 
                        if(isset($_SESSION['user_id'])){
                            $user_id = $_SESSION['user_id'];
                            $qry_search = mysqli_query($con,"SELECT * FROM likes WHERE user_id={$user_id} AND post_id={$post_id}");
                            $count = mysqli_num_rows($qry_search);
                            if($count <= 0){
                                echo "<p><a class='like' href='' style='color:blue;padding: 15px;'>Like<span class='glyphicon glyphicon-thumbs-up'></span></a></p>";
                            }else{
                                echo "<p><a class='unlike' href='' style='color:blue;padding: 15px;'>Unlike<span class='glyphicon glyphicon-thumbs-down'></span></a></p>";
                            }
                        }
                    ?>
                    </div>
                    <div class="row">
                    <?php
                        $qry_count = mysqli_query($con,"SELECT likes FROM posts WHERE post_id={$post_id}");
                        while($row = mysqli_fetch_assoc($qry_count)){
                        ?>
                    <p style="padding: 15px;">Likes: <?php echo $row['likes'];}?></p>
                    </div>
                    
                </div>
                
                
                
                
                <!-- Blog Comments -->
                
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" placeholder="Enter Your Comment" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="comment_submit">Comment</button>
                    </form>
                </div>
                <?php
                if(isset($_POST['comment_submit'])){
                    $post_id = $_GET['post_id'];
                    $user_id = $_SESSION['user_id'];
                    $comment_content=$_POST['comment_content'];
                    if(isset($_SESSION['user_id'])){
                        if(!empty($comment_content)){
                            $qry_insert="INSERT INTO comments(post_id, user_id, comment_content, comment_status, comment_date) VALUES($post_id,$user_id,'$comment_content','Approve',now())";
                            $result=mysqli_query($con,$qry_insert);
                            if(!$result){
                                die("Not Inserted".mysqli_error($con));
                            }
                            $comment_update=mysqli_query($con,"UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id");
                            if(!$comment_update){
                                die("Not updated");
                            }
                        }else{
                            echo "<h4 style='color:red;'>Field Cann't be Empty</h4>";
                        }
                    }else{
                        header("Location:login.php");
                    }
                }
                ?>
                <hr>
                <!--comment Query -->   
                   <?php
                    $comment_qry="SELECT * FROM comments WHERE post_id = $post_id AND comment_status = 'Approve' ORDER BY comment_id DESC";
                    $comment_rs=mysqli_query($con,$comment_qry);
                    while($rows=mysqli_fetch_assoc($comment_rs)){
                        $user_id = $rows['user_id'];
                        $comment_date = $rows['comment_date'];
                        $comment_content = $rows['comment_content'];
                    ?>
                   <div class="media">
                   <?php
                        $qry_comment = mysqli_query($con,"SELECT user_name,user_img FROM users WHERE user_id={$user_id}");
                        $rows = mysqli_fetch_assoc($qry_comment);
                        $user_img = $rows['user_img'];
                        $user_name = $rows['user_name'];
                    ?>
                    <a class="pull-left" href="">
                        <img class="media-object" src="img/<?php echo $user_img?>" style="width:70px; height:70px;" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $rows['user_name']; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                <?php
                    }
                    ?>
                <!-- Comment -->
               
                
                <!-- End Latest Products -->
            </div>
            <?php
    }
}else{
                header("Location: index.php");
            }
            ?>
            <!--// end row -->
                
        </div>
        
        <!-- End Latest Products -->

        <!-- Clients -->
        <!-- End Clients -->

        <!-- Testimonials -->
        <!-- End Testimonials -->

        <!-- Pricing -->
        <!-- End Pricing -->

        <!-- Promo Section -->
        <!-- End Promo Section -->

        <!-- Work -->
                <!-- End Work -->
        <!--========== END PAGE LAYOUT ==========-->

        <!--========== FOOTER ==========-->
        
        <?php include"includes/footer.php"; ?>
        <script>
        $(document).ready(function(){
            var post_id = <?php echo $post_id; ?>;
            var user_id = <?php echo $_SESSION['user_id']; ?>;
            
           $(".like").click(function(){
               $.ajax({
                    url:'post.php?post_id=<?php echo $post_id; ?>',
                   type: 'post',
                   data: {
                       'liked': 1,
                       'post_id': post_id,
                       'user_id': user_id,
                   }
               });
           }) 
            
            $(".unlike").click(function(){
               $.ajax({
                    url:'post.php?post_id=<?php echo $post_id; ?>',
                   type: 'post',
                   data: {
                       'unliked': 1,
                       'post_id': post_id,
                       'user_id': user_id,
                   }
               });
           })     
        });
        </script>
        <!--========== END FOOTER ==========-->
    </body>