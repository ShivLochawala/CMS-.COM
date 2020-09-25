<?php include("includes/db.php");
?>
     <!-- BEGIN HEAD -->
    <?php include"includes/header.php"; ?>
    <!-- END HEAD -->
<!-- BODY -->
<body style="background-color:#DCDCDC;">
<?php
        if(isset($_GET['edit_id']))
            echo $user_id = $_GET['edit_id'];
        else 
            echo $user_id = 'Error';            
?>

<form action="" method="post">
<br><br><br>
<table width="300" height="300" align="center">
    <tr>
        <th><h1>Reset Password</h1></th>
    </tr>
    <tr>
        <td>
            <input type="password" name="pass" class="form-control footer-input margin-b-20" placeholder="Enter Password" required>
        </td>
    </tr>
    <tr>
        <td>
            <input type="password" name="cpass" class="form-control footer-input margin-b-20" placeholder="Confirm Password" required>
        </td>
    </tr>
    <tr>
        <td>
            <input type="submit" name="btn" value="Submit" class="btn-theme btn-theme-sm btn-base-bg text-uppercase">
        </td>
    </tr>
</table>
</form> 
<?php
        if(isset($_POST['btn'])){
            $pass=$_POST['pass'];
            $cpass=$_POST['cpass'];
            //$user_id = $_REQUEST['edit_id'];
            //cleanup data
            $pass=mysqli_real_escape_string($con,$pass);
            $cpass=mysqli_real_escape_string($con,$cpass);
            //echo $cpass;
            if($pass == $cpass){
                $user_pass = password_hash($cpass, PASSWORD_BCRYPT, array('cost' => 10));
                $qry_update = "UPDATE users SET user_pass = '{$user_pass}' WHERE user_id = {$user_id}";
                $result = mysqli_query($con,$qry_update);
                if($result){
                    header("Location:login.php");
                }else{
                    die("Query Failed".mysqli_error($con));
                }
            }else{
                echo "<h4 style='color:red;' class='text-center'>Password And Confirm Password should be Same</h4>";
            }
        }
?>       
</body>
    <!-- END BODY -->