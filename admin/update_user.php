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
                            Update User
                            <small>Page</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                        <?php
                                
                           if(isset($_GET['edit_id'])){
                                $user_id=$_GET['edit_id'];
                               
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
                            <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $user_name;?>" required><br>
                        
                        <label>Firstname</label>
                        <input type="text" name="firstname" class="form-control" value="<?php echo $user_firstname;?>" required><br>
                        
                        <label>Lastname</label>
                        <input type="text" name="lastname" class="form-control" value="<?php echo $user_lastname;?>" required><br>
                        
                        <label>Email Id</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $user_email;?>" required><br>
                        
                        <label>User Image</label>
                        <input type="file" name="image" class="form-control" required><br>
                        <img src="../user/img/<?php echo $user_img; ?>" width="100px" height="100px"><br>
                        
                        <label>User Role</label>
                        <select name="user_role" class="form-control">
                            <option value="<?php echo $user_role;?>"><?php echo $user_role;?></option>
                            <?php
                            if($user_role == "Admin"){
                                echo "<option value='Subscriber'>Subscriber</option>";
                            }else{
                                echo "<option value='Admin'>Admin</option>";
                            }
                            ?>
                        </select><br>
                        <?php   
                           }
                        }
                        ?>
                        <?php
                            // Update Query //
                            if(isset($_POST['edit_submit'])){
                                $username=$_POST['username'];
                                $firstname=$_POST['firstname'];
                                $lastname=$_POST['lastname'];
                                $email=$_POST['email'];
                                $user_role=$_POST['user_role'];
                    
                                $user_img=$_FILES['image']['name'];
                                $user_img_temp=$_FILES['image']['tmp_name'];
                    
                                move_uploaded_file($user_img_temp,"../user/img/$user_img");
                    
                                
                                $qry_update="UPDATE users SET user_name = '{$username}', user_firstname = '{$firstname}', user_lastname = '{$lastname}', user_email = '{$email}', user_role = '{$user_role}', user_img = '{$user_img}' WHERE user_id = {$user_id}";
                                $result_update=mysqli_query($con,$qry_update);
                                if($result_update){
                                    header("Location:users.php");  
                                }else{
                                    die("Not updated".mysqli_error($con));
                                    echo "<h4 style='color:red;'>Not Updated</h4>"; 
                                }
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
