<?php include"includes/db.php";
?>
     <!-- BEGIN HEAD -->
    <?php include"includes/header.php"; ?>
    <!-- END HEAD -->
<!-- BODY -->
<body style="background-color:#DCDCDC;">
<form action="login.php" method="post">
<br><br><br>
<table width="300" height="300" align="center">
    <tr>
        <th><h1>Login</h1></th>
    </tr>
    <tr>
        <td>
            <input type="text" name="username" class="form-control footer-input margin-b-20" placeholder="Enter Username" required>
        </td>
    </tr>
    <tr>
        <td>
            <input type="password" name="userpass" class="form-control footer-input margin-b-20" placeholder="Enter Password" required>
        </td>
    </tr>
    <tr>
        <td>
            <input type="submit" name="login" value="Login" class="btn-theme btn-theme-sm btn-base-bg text-uppercase">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="forgot_pass.php" style="color:blue">Forgot Password</a>
        </td>
    </tr>
    <tr>
        <td align="center">
            <a href="regi.php">Create a new Account</a>
        </td>
    </tr>
</table>
</form>        
</body>
<?php
if(isset($_POST['login'])){
    $user_name=$_POST['username'];
    $user_pass=$_POST['userpass'];
    //cleanup data
    $user_name=mysqli_real_escape_string($con,$user_name);
    $user_pass=mysqli_real_escape_string($con,$user_pass);
    $qry_find="SELECT * FROM users WHERE user_name = '{$user_name}'";
    $result=mysqli_query($con,$qry_find);
if(!$result){
        die("Query Failed".mysqli_error($con));
}    
    while($row = mysqli_fetch_array($result)){
        
        $db_user_id = $row['user_id'];
        $username = $row['user_name'];
        
        $userpass = $row['user_pass'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];

    if($user_name === $username){
        if(password_verify($user_pass,$userpass)){
        $_SESSION['user_name'] = $username;
        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
            if($_SESSION['user_role'] == "Admin"){
                header('Location:../admin/index.php');
            }
            else{
                header('Location:../user/index.php');
            }
        
        }else{
            echo "<h3 style='color:red;'class='text-center'>Invalid Password</h3>";   
        }
    }else{
        echo "<h3 style='color:red;'class='text-center'>Invalid Username</h3>";   
    }
}
}
?>
    <!-- END BODY -->