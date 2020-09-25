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
        <br><br><br><br>
        <div id="page-wrapper" align="center">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            View Profile
                            <small>Page</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                        <?php
                                
                           if(isset($_SESSION['user_id'])){
                               $user_id = $_SESSION['user_id'];
                            $qry_edit="SELECT * FROM users WHERE user_id = $user_id";
                            $result_edit=mysqli_query($con,$qry_edit);
                            
                            while($row_edit=mysqli_fetch_assoc($result_edit)){
                                $user_id=$row_edit['user_id'];
                                $user_name=$row_edit['user_name'];
                                $user_firstname=$row_edit['user_firstname'];
                                $user_lastname=$row_edit['user_lastname'];
                                $user_email=$row_edit['user_email'];
                                $user_img=$row_edit['user_img'];
                                $user_role=$row_edit['user_role'];
                            ?>
                            <table width=600 class="table-responsive">
                            <tr>
                                <td><label>Username</label></td>
                                <td><lable><?php echo $user_name;?></lable><br></td>
                                <td rowspan="6"><img src="../user/img/<?php echo $user_img; ?>" width="200px" height="200px"><br></td>
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
                            <tr>
                                <td><a href="update_profile.php?edit_id={$user_id}"><h4>Edit</h4></a></td>
                                <td></td>
                            </tr>
                        </table>
                        <?php   
                           }
                        }
                        ?>
                        
                          </div>
                            
                        </form>
            </div>
            <br><br><br><br>
        <!--========== END FOOTER ==========-->
</body>
<?php include"includes/footer.php"; ?>
    <!-- END BODY -->