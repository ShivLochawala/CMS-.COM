<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  //include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
<body  style="background-color:#DCDCDC;">
<form action="regi.php" method="post">
<br><br><br>
<table width="300" height="300" align="center">
    <tr>
        <th colspan="2"><h1>Sign Up</h1></th>
    </tr>
    <tr>
        <td>
            <input type="text" name="user_name" class="form-control footer-input margin-b-20" placeholder="Enter Username" required>
        </td>
    </tr>
    <tr>
        <td>
            <input type="text" name="user_firstname" class="form-control footer-input margin-b-20" placeholder="Enter First Name" required>
        </td>
    </tr>
    <tr>
        <td>
            <input type="text" name="user_lastname" class="form-control footer-input margin-b-20" placeholder="Enter Last Name" required>
        </td>
    </tr>
    <tr>
        <td>
            <input type="email" name="user_email" class="form-control footer-input margin-b-20" placeholder="Enter Email Id" required>
        </td>
    </tr>
    <tr>
        <td>
            <input type="password" name="user_pass" class="form-control footer-input margin-b-20" placeholder="Enter Password" required>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" name="signup" value="Sign Up" class="btn-theme btn-theme-sm btn-base-bg text-uppercase">
        </td>
    </tr>
    <tr>
        <td align="center">
            <a href="login.php">Already Registrated</a>
        </td>
    </tr>
</table>
</form>        
</body>
<?php
if(isset($_POST['signup'])){
    $user_name = $_POST['user_name'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];
    
if(!empty($user_name) && !empty($user_firstname) && !empty($user_lastname) && !empty($user_email) && !empty($user_pass)){
    $user_name = mysqli_real_escape_string($con, $user_name);
    $user_firstname = mysqli_real_escape_string($con, $user_firstname);
    $user_lastname = mysqli_real_escape_string($con, $user_lastname);
    $user_email = mysqli_real_escape_string($con, $user_email);
    $user_pass = mysqli_real_escape_string($con, $user_pass);
    
    $user_pass = password_hash($user_pass, PASSWORD_BCRYPT, array('cost' => 10));
        
    $qry_search1 = mysqli_query($con,"SELECT user_name FROM users WHERE user_name='{$user_name}'");
    $count1 = mysqli_num_rows($qry_search1);
    $qry_search2 = mysqli_query($con,"SELECT user_email FROM users WHERE user_email='{$user_email}'");
    $count2 = mysqli_num_rows($qry_search2);
    if($count1 == 0 && $count2 == 0){
        $qry_insert = "INSERT INTO users(user_name,user_pass,user_firstname,user_lastname,user_email,user_img,user_role) VALUES('{$user_name}','{$user_pass}','{$user_firstname}','{$user_lastname}','{$user_email}','default.jpg','Subscriber')";
        $qry_result = mysqli_query($con,$qry_insert);
        if($qry_result){
            header("Location:login.php");
        }else{
            die("Query Failed".mysqli_error($con));
        }
    }else{
        echo "<h3 style='color:red' class='text-center'>This Username or Email Id already exist.<br> Please Enter Unique Username or Email Id</h3>";    
    }
}else{
    echo "Failed Cann't Be Empty";
}
}
?>



<?php //include "includes/footer.php";?>
