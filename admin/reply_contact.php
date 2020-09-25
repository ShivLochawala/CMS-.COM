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
                            Contact Reply
                            <small>Page</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                        <?php
                                
                           if(isset($_GET['contact_id'])){
                                $contact_id=$_GET['contact_id'];
                               
                            $qry_edit="SELECT contact_email,contact_id FROM contacts_msg WHERE contact_id = $contact_id";
                            $result_edit=mysqli_query($con,$qry_edit);
                            
                            while($row_edit=mysqli_fetch_assoc($result_edit)){
                                $contact_id=$row_edit['contact_id'];
                                $contact_email=$row_edit['contact_email'];
                            ?>
                        <label>Email id</label>
                        <input type="text" name="contact_email" class="form-control" value="<?php echo $contact_email;?>" readonly><br>
                        
                        <label>Subject</label>
                        <input type="text" name="contact_subject" class="form-control" required><br>
                        
                        <label>Replay</label>
                                <textarea type="text" name="reply" class="form-control" rows="6" placeholder="Message" required></textarea><br>
                        <?php   
                           }
                        }
                        ?>
                        <?php
                            // Update Query //
                            if(isset($_POST['edit_submit'])){
                                $contact_email=$_POST['contact_email'];
                                $contact_subject=$_POST['contact_subject'];
                                $contact_msg=$_POST['reply'];
                                try{
                                     require '../user/phpmailer/PHPMailerAutoload.php';

                    $mail = new PHPMailer;

                    //$mail->SMTPDebug = 4;                               // Enable verbose debug output

                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'shivlocho@gmail.com';                 // SMTP username
                    $mail->Password = 'shiv@9099817715';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

                    $mail->setFrom('shivlocho@gmail.com', 'CMS.COM');
                    $mail->addAddress($contact_email);     // Add a recipient

                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = $contact_subject;
                    $mail->Body    = $contact_msg;
                    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    if(!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        header("Location:view_contact.php");
                    }
                                }catch(Exception $e){
                                    
                                }
                                
                            }
                        ?>
                        
                          </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_submit" value="Reply">
                            </div>
                        </form>
                    
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"?>
