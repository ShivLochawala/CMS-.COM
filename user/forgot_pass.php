<?php include"includes/db.php";
?>
     <!-- BEGIN HEAD -->
    <?php include"includes/header.php"; ?>
    <!-- END HEAD -->
<!-- BODY -->
<body style="background-color:#DCDCDC;">
<form action="" method="post">
<br><br><br><br><br>
<table width="300" height="200" align="center">
    <tr>
        <th><h2>Forgot Password</h2></th>
    </tr>
    <tr>
        <td>
            <input type="email" name="user_email" class="form-control footer-input margin-b-20" placeholder="Enter Email Id" required>
        </td>
    </tr>
    <tr>
        <td>
            <input type="submit" name="forgot" value="Submit" class="btn-theme btn-theme-sm btn-base-bg text-uppercase">
        </td>
    </tr>
</table>
</form>        
</body>
<?php
if(isset($_POST['forgot'])){
    $user_email=$_POST['user_email'];
    //cleanup data
    $user_email = mysqli_real_escape_string($con,$user_email);
    $qry_find = "SELECT * FROM users WHERE user_email = '{$user_email}'";
    $result = mysqli_query($con,$qry_find);
    while($rows = mysqli_fetch_assoc($result)){
    $user_email = $rows['user_email'];
    $user_id = $rows['user_id'];
    $count = mysqli_num_rows($result);
    if($count == 0){
        echo "<h3 style='color:red;'class='text-center'>Invalid Email Id</h3>";
    }else{
        require 'phpmailer/PHPMailerAutoload.php';

                    $mail = new PHPMailer(true);
                try{
                    $mail->SMTPDebug = 0;                               // Enable verbose debug output

                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'shivlocho@gmail.com';                 // SMTP username
                    $mail->Password = 'Shiv@909981';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

                    $mail->setFrom('shivlocho@gmail.com', 'CMS.COM');
                    $mail->addAddress($user_email);     // Add a recipient

                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = "Reset Password";
                    $mail->Body    = "<p>Hello...!!!</p>
                        You can reset your password by below link:<br><a href='http://localhost/MyCMS/user/change_pass.php?edit_id={$user_id}'>Click for Reset Password</a></p>
                        <p>Best Regard,<br>
                            CMS. COM Team</p>";
                    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    if(!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        header("Location:login.php");
                    }   
                }catch(Exception $e){
                    
                }
    }
    }
}
?>