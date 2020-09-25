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
                    <h2>Search of Users</h2>
                    <p>There are different types of users details and post details can be see here.</p>
                </div>
                <!-- Blog Search Well-->
                <div class="col-sm-6 col-right">
                   <div class="well">
                    <h4>Search Username</h4>
                    <form action="" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button name ="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
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
                        echo "<h2 style='color:red;' class='text-center'>No Result Found</h2><br><br>";
                    
                    }else{
                        while($row=mysqli_fetch_assoc($search_qry)){
                            $user_id=$row['user_id'];
                                $user_name=$row['user_name'];
                                $user_firstname=$row['user_firstname'];
                                $user_lastname=$row['user_lastname'];
                                $user_email=$row['user_email'];
                                $user_img=$row['user_img'];
                                $user_role=$row['user_role'];
                                        
                ?>
            
            <!--// end row -->
            
           <table width=600 class="table-responsive" align="center">
                            <tr>
                                <td><label>Username</label></td>
                                <td><lable><?php echo $user_name;?></lable><br></td>
                                <td rowspan="5"><img src="../user/img/<?php echo $user_img; ?>" width="200px" height="200px"><br></td>
                            </tr>
                            <tr>
                                <td><label>Firstname</label></td>
                                <td><lable><?php echo $user_firstname;?></lable><br></td>
                            </tr>
                            <tr>
                                <td><label>Lastname</label></td>
                                <td><lable><?php echo $user_lastname;?></lable><br></td>
                            </tr>
                            <tr>
                                <td><label>Email Id</label></td>
                                <td><lable><?php echo $user_email;?></lable><br></td>
                            </tr>
                            <tr>
                                <td><label>Role</label></td>
                                <td><lable><?php echo $user_role;?></lable><br></td>
                            </tr>
                        </table>
                        
                          </div>
                            
                        </form>
            </div>
            <br><br><br><br>
           
            <!--// end row -->
        
        
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
 <?php
        }   
    }
}
            ?>
        <!--========== FOOTER ==========-->
         <?php include"includes/footer.php"; ?>
        <!--========== END FOOTER ==========-->
        
           
    </body>
    <!-- END BODY -->