<?php include"includes/admin_header.php"?>
<?php include"../user/includes/db.php"?>

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
                            View Contact Messages
                            <small>Page</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="col-lg-12 table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Email Id</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Replay</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
// Display All Records //
$qry_all="SELECT * FROM contacts_msg";
$all_records=mysqli_query($con,$qry_all);
while($row_all=mysqli_fetch_assoc($all_records)){
    $contact_id=$row_all['contact_id'];
    $contact_email=$row_all['contact_email'];
    $contact_subject=$row_all['contact_subject'];
    $contact_msg=$row_all['contact_msg'];
    echo "<tr>";
    echo "<td>{$contact_id}</td>";

    echo "<td>{$contact_email}</td>";

    echo "<td>{$contact_subject}</td>";

    echo "<td>{$contact_msg}</a></td>";
    echo "<td><a href='reply_contact.php?contact_id={$contact_id}'>Replay</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete')\" href='view_contact.php?delete_id={$contact_id}'>Delete</a></td>";
    echo "</tr>";
}                    
?>           
                        </tbody>
                    </table>
<?php              
                    
if(isset($_GET['delete_id'])){
    $comment_id=$_GET['delete_id'];
    $qry_delete="DELETE FROM contacts_msg WHERE contact_id={$contact_id}";
    $result_delete=mysqli_query($con,$qry_delete);
    header('Location:view_contact.php');
}
?>
</div>

                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!--    </div>-->
    <!-- /#wrapper -->
<?php include"includes/admin_footer.php"?>














