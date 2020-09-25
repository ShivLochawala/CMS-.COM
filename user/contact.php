
<?php include"includes/db.php";?>
     <!-- BEGIN HEAD -->
    <?php include"includes/header.php"; ?>
    <?php include"includes/navigation.php"; ?>
    <!-- BODY -->
    <body>

        <!--========== HEADER ==========-->
        
        <!--========== END HEADER ==========-->

        <!--========== PARALLAX ==========-->
        
        <!--========== PARALLAX ==========-->

        <!--========== PAGE LAYOUT ==========-->
        <!-- Contact List -->
        
        <!-- End Contact List -->

        <!-- Google Map -->
        <!-- End Promo Section -->
        <!--========== END PAGE LAYOUT ==========-->

        <!--========== FOOTER ==========-->
            <!-- Links -->
            <div>
                <div class="content-lg container">
                    <div class="row" >
                        <div class="col-sm-4 sm-margin-b-30">
                            <h2>Contact Us</h2>
                            <form action="contact.php" method="post">
                            <input type="email" name="email" class="form-control footer-input margin-b-20" style="border-style:solid;" placeholder="Email" required>
                            <input type="text" name="subject" class="form-control footer-input margin-b-20" style="border-style:solid;" placeholder="Subject" required>
                            <textarea class="form-control footer-input margin-b-30" name="msg" rows="6" placeholder="Message" style="border-style:solid;" required></textarea>
                            <button type="submit" name="contact_submit" class="btn-theme btn-theme-sm btn-base-bg text-uppercase">Submit</button>
                            </form>
                        </div>
                                    <?php
                if(isset($_POST['contact_submit'])){
                    $email = $_POST['email'];
                    $subject = $_POST['subject'];
                    $msg = $_POST['msg'];
                    $qry_contact= mysqli_query($con,"INSERT INTO contacts_msg(contact_email,contact_subject,contact_msg) VALUES('{$email}','{$subject}','{$msg}')");
                    if($qry_contact){
                       echo "<h3 style='color:green;'>Message Sended</h3>"; 
                    }else{
                       echo "<h3 style='color:red;'>Message not Sended</h3>";
                    }                   
                }
            ?>
                    </div>
                    <!--// end row -->
                </div>
            </div>

            <!-- End Links -->
        
    </body>
    <?php include"includes/footer.php"; ?>
    <!--