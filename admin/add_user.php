<?php include"includes/admin_header.php"?>
<?php include"../user/includes/db.php";?>

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
                             Add User
                            <small>Page</small>
                        </h1>
                    </div>
                </div>
                <div class="form-group">
                    <form action="" method="post" enctype="multipart/form-data">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required><br>
                        
                        <label>Firstname</label>
                        <input type="text" name="firstname" class="form-control" required><br>
                        
                        <label>Lastname</label>
                        <input type="text" name="lastname" class="form-control" required><br>
                        
                        <label>Email Id</label>
                        <input type="text" name="email" class="form-control" required><br>
                        
                        <label>User Role</label>
                        <select name="user_role" class="form-control" required>
                            <option value="Subscriber">--Select Role--</option>
                            <option value="Admin">Admin</option>
                            <option value="Subscriber">Subscriber</option>
                            
                        </select><br>
                        
                        <label>Password</label>
                        <input type="password" name="cpass" class="form-control" required><br>
                        
                        <input type="submit" name="insert_submit" value="Add User" class="btn btn-primary">
                    </form>
                </div>
                <!-- /.row -->
                <?php
                if(isset($_POST['insert_submit'])){
                    $cpass=$_POST['cpass'];
                    $username=$_POST['username'];
                    $firstname=$_POST['firstname'];
                    $lastname=$_POST['lastname'];
                    $email=$_POST['email'];
                    $user_role=$_POST['user_role'];
                    
                    $cpass = password_hash($cpass, PASSWORD_BCRYPT, array('cost' => 10));
                    
                    $qry_add="INSERT INTO users(user_name,user_pass,user_firstname,user_lastname,user_email,user_img,user_role) VALUES ('{$username}','{$cpass}','{$firstname}','{$lastname}','{$email}','default.jpg','{$user_role}')";
                    
                    $result_add=mysqli_query($con,$qry_add);
                    if($result_add){
                        echo "<h4 style='color:green;'>User Added</h4>";
                    }else{
                        echo "<h4 style='color:red;'>User not Added</h4>";
                    }
                }
                ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include"includes/admin_footer.php"?>
