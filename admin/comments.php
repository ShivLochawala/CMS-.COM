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
                            View Comments
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
                                <th>Author</th>
                                <th>Comment</th>
                                <th>In Response to</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
// Display All Records //
$qry_all="SELECT * FROM comments";
$all_records=mysqli_query($con,$qry_all);
while($row_all=mysqli_fetch_assoc($all_records)){
    $comment_id=$row_all['comment_id'];
    $post_id=$row_all['post_id'];
    $user_id=$row_all['user_id'];
    $comment_content=$row_all['comment_content'];
    $comment_status=$row_all['comment_status'];
    $comment_date=$row_all['comment_date'];
    echo "<tr>";
    echo "<td>{$comment_id}</td>";
$qry_name="SELECT user_name FROM users WHERE user_id={$user_id}";
$result1=mysqli_query($con,$qry_name);
while($rows=mysqli_fetch_assoc($result1)){
    $user_name=$rows['user_name'];
    echo "<td>{$user_name}</td>";
}
    echo "<td>{$comment_content}</td>";

$qry_cat="SELECT post_title FROM posts WHERE post_id={$post_id}";
$result=mysqli_query($con,$qry_cat);
while($row=mysqli_fetch_assoc($result)){
    $post_title=$row['post_title'];
    echo "<td><a href='../user/post.php?post_id=$post_id'>{$post_title}</a></td>";
}
   
    echo "<td>{$comment_status}</td>";
    echo "<td>{$comment_date}</td>";
    echo "<td><a href='comments.php?app_id={$comment_id}'>Approve</a></td>";
    echo "<td><a href='comments.php?unapp_id={$comment_id}'>Unapprove</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete')\" href='comments.php?delete_id={$comment_id}'>Delete</a></td>";
    echo "</tr>";
}                    
?>           
                        </tbody>
                    </table>
<?php
                    
if(isset($_GET['app_id'])){
    $comment_id=$_GET['app_id'];
    $qry_app="UPDATE comments SET comment_status = 'Approve' WHERE comment_id={$comment_id}";
    $app_update=mysqli_query($con,$qry_app);
    header('Location:comments.php');
}
                    
if(isset($_GET['unapp_id'])){
    $comment_id=$_GET['unapp_id'];
    $qry_unapp="UPDATE comments SET comment_status='Unapprove' WHERE comment_id={$comment_id}";
    $unapp_update=mysqli_query($con,$qry_unapp);
    header('Location:comments.php');
}                   
                    
if(isset($_GET['delete_id'])){
    $comment_id=$_GET['delete_id'];
    $qry_delete="DELETE FROM comments WHERE comment_id={$comment_id}";
    $result_delete=mysqli_query($con,$qry_delete);
    header('Location:comments.php');
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














