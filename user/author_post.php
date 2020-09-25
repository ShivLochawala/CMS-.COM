<?php include"includes/db.php";?>
     <!-- BEGIN HEAD -->
    <?php include"includes/header.php"; ?>
    <!-- END HEAD -->
<!-- BODY -->
<body>
        <!--========== HEADER ==========-->
        <?php include"includes/navigation.php"; ?>
        <!--========== END HEADER ==========-->

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
                   <?php
                        $user_id = $_GET['user_id'];
                        $userid = mysqli_query($con,"SELECT user_name FROM users WHERE user_id={$user_id}");
                        $rows = mysqli_fetch_assoc($userid);
                        $username = $rows['user_name'];
                        ?>
                    <h2>All Post of <?php echo $username;?></h2>
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
                //$post_author = $_GET['author'];
                
                $qry="SELECT * FROM posts WHERE user_id ='{$user_id}'";
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
                    <p>by <?php echo $username; ?></p>
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
                </div>
                
                <!-- Blog Comments -->

                <!-- Comments Form -->
                <!-- Comment -->
               
                
                <!-- End Latest Products -->
            </div>
            <?php
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
        <!--========== END FOOTER ==========-->
    </body>