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
                            View User
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
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Image</th>
                                <th>Role</th>
                                <th>Email Id</th>
                                <th>Admin</th>
                                <th>Subscriber</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
// Display All Records //
$qry_all="SELECT * FROM users";
$all_records=mysqli_query($con,$qry_all);
while($row_all=mysqli_fetch_assoc($all_records)){
    $user_id=$row_all['user_id'];
    $user_name=$row_all['user_name'];
    $user_firstname=$row_all['user_firstname'];
    $user_lastname=$row_all['user_lastname'];
    $user_email=$row_all['user_email'];
    $user_role=$row_all['user_role'];
    $user_img=$row_all['user_img'];
    echo "<tr>";
    echo "<td>{$user_id}</td>";
    echo "<td>{$user_name}</td>";
    echo "<td>{$user_firstname}</td>";
    echo "<td>{$user_lastname}</td>";
    echo "<td><img src='../user/img/$user_img' style='height:80px; width:80px;'></td>";
    echo "<td>{$user_role}</td>";
    echo "<td>{$user_email}</td>";
    echo "<td><a href='users.php?adm_id={$user_id}'>Admin</a></td>";
    echo "<td><a href='users.php?sub_id={$user_id}'>Subscriber</a></td>";
    echo "<td><a href='update_user.php?edit_id={$user_id}'>Edit</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete')\" href='users.php?delete_id={$user_id}'>Delete</a></td>";
    echo "</tr>";
}                    
?>           
                        </tbody>
                    </table>
<?php
if(isset($_GET['adm_id'])){
    $user_id=$_GET['adm_id'];
    $qry_app="UPDATE users SET user_role = 'Admin' WHERE user_id={$user_id}";
    $app_update=mysqli_query($con,$qry_app);
    header('Location:users.php');
}
                    
if(isset($_GET['sub_id'])){
    $user_id=$_GET['sub_id'];
    $qry_unapp="UPDATE users SET user_role = 'Subscriber' WHERE user_id={$user_id}";
    $unapp_update=mysqli_query($con,$qry_unapp);
    header('Location:users.php');
}                   
                    
if(isset($_GET['delete_id'])){
    $user_id=$_GET['delete_id'];
    $qry_delete="DELETE FROM users WHERE user_id={$user_id}";
    $result_delete=mysqli_query($con,$qry_delete);
    header('Location:users.php');
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














