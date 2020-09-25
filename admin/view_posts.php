<?php include"includes/admin_header.php"?>
<?php include"../user/includes/db.php"?>        
        <div id="wrapper">
        <!-- Navigation -->
        <?php include"includes/admin_navigation.php";?>
        <!-- Navigation -->
 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete?</h4>
      </div>
      <div class="modal-body">
        <p><h3>Are you sure you want to delete this post?</h3></p>
      </div>
      <div class="modal-footer">
        <a href="" class="btn btn-danger model_delete_link">Delete</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            View Posts
                            <small>Page</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->           
                <div class="col-lg-12 table-responsive">
                    <table class="table table-bordered table-hover">
                    <form action="" method="post">
                     <div id="bulkOptionsContainer" class="col-xs-4"  style="padding:0px;">
                         <select class="form-control" name="bulk_options" id="">
                             <option value="">Select Options</option>
                             <option value="published">Publish</option>
                             <option value="draft">Draft</option>
                             <option value="delete">Delete</option>
                             <option value="clone">Clone</option>
                             <option value="views">Reset Views</option>
                         </select>
                     </div>   
                     <div class="col-xs-4">
                         <input type="submit" name="apply" value="Apply" class="btn btn-success">
                         <a class="btn btn-primary" href="add_post.php">Add New</a>
                    </div>
                    
                    <div class="col-xs-4">
                        <?php
if(isset($_POST['checkBoxArray'])){
    $bulk_options = '';
    foreach($_POST['checkBoxArray'] as $post_id){
        $bulk_options = $_POST['bulk_options']; 
        switch($bulk_options){
            case 'published':
                            $p_qry=mysqli_query($con,"UPDATE posts SET post_status='published' WHERE post_id={$post_id}");
                            break;
            case 'draft':
                            $p_qry=mysqli_query($con,"UPDATE posts SET post_status='draft' WHERE post_id={$post_id}");
                            break;
            case 'delete':
                            $d_qry=mysqli_query($con,"DELETE FROM posts WHERE post_id={$post_id}");
                            break;
            case 'clone':
                            $qry_fetch=mysqli_query($con,"SELECT * FROM posts WHERE post_id={$post_id}");
                            while($row=mysqli_fetch_assoc($qry_fetch)){
                                $cat_id = $row['cat_id'];
                                $post_title = $row['post_title'];
                                $user_id = $row['user_id'];
                                $post_date = $row['post_date'];
                                $post_img = $row['post_img'];
                                $post_content = $row['post_content'];
                                $post_tags = $row['post_tags'];
                                $post_comment_count = $row['post_comment_count'];
                                $post_status = $row['post_status'];
                            }
                            $qry="INSERT INTO posts(cat_id,post_title,user_id,post_date,post_img,post_content,post_tags,post_comment_count,post_status) VALUES({$cat_id},'{$post_title}','{$user_id}','{$post_date}','{$post_img}','{$post_content}','{$post_tags}',{$post_comment_count},'{$post_status}')";
                            $rs=mysqli_query($con,$qry);
                            if(!$rs){
                                die("Query Failed".mysqli_error($con));
                            }
                            break;
            case 'views':
                            $v_qry=mysqli_query($con,"UPDATE posts SET post_views_count=0 WHERE post_id={$post_id}");
                            break;
        }
    }
}                    
?>  
                    </div>  
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAllBoxes"></th>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Likes</th>
                                <th>Views</th>
                                <th>View Post</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
// Display All Records //
$qry_all="SELECT * FROM posts ORDER BY post_id DESC";
$all_records=mysqli_query($con,$qry_all);
while($row_all=mysqli_fetch_assoc($all_records)){
    $post_id=$row_all['post_id'];
    $user_id=$row_all['user_id'];
    $post_title=$row_all['post_title'];
    $post_cat_id=$row_all['cat_id'];
    $post_date=$row_all['post_date'];
    $post_img=$row_all['post_img'];
    $post_tags=$row_all['post_tags'];
    $post_comment_count=$row_all['post_comment_count'];
    $post_status=$row_all['post_status'];
    $post_views_count=$row_all['post_views_count'];
    $likes = $row_all['likes'];
    echo "<tr>";
?>

<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
<?php
    
    echo "<td>{$post_id}</td>";
?>
<?php
    $userid = mysqli_query($con,"SELECT user_name FROM users WHERE user_id={$user_id}");
    $rows = mysqli_fetch_assoc($userid);
    $username = $rows['user_name'];
    echo "<td>{$username}</td>";
?>
<?php
    echo "<td>{$post_title}</td>";
?>
<?php
$qry_cat="SELECT * FROM categories WHERE cat_id={$post_cat_id}";
$result=mysqli_query($con,$qry_cat);
while($row=mysqli_fetch_assoc($result)){
    $cat_title=$row['cat_title'];
    echo "<td>{$cat_title}</td>";
}
?>   
<?php
    echo "<td>{$post_date}</td>";
    echo "<td><img src='../user/img/$post_img' style='height:80px; width:80px;'></td>";
    echo "<td>{$post_tags}</td>";
    echo "<td>{$post_comment_count}</td>";
    echo "<td>{$post_status}</td>";
    echo "<td>{$likes}</td>";
    echo "<td>{$post_views_count}</td>";
    echo "<td><a href='../user/post.php?post_id={$post_id}'>View Post</a></td>";
    echo "<td><a href='update_posts.php?edit_id={$post_id}'>Edit</a></td>";
    //echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete')\" href='view_posts.php?delete_id={$post_id}'>Delete</a></td>";
    echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
    echo "</tr>";
    
}                    
?>           
                        </tbody>
                        </form>
                    </table>

</div>

                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
<?php
if(isset($_GET['delete_id'])){
    $post_id=$_GET['delete_id'];
    $qry_delete="DELETE FROM posts WHERE post_id={$post_id}";
    $result_delete=mysqli_query($con,$qry_delete);
     header('Location:view_posts.php');
}
?>
        <!-- /#page-wrapper -->
<script>
$(document).ready(function(){
    
   $('.delete_link').on('click',function(){
       var id = $(this).attr('rel');
       var delete_url = "view_posts.php?delete_id="+ id +" ";
       $('.model_delete_link').attr('href',delete_url);
       $('#myModal').modal('show');
   }); 
});
</script>
<!--    </div>-->
    <!-- /#wrapper -->
<?php include"includes/admin_footer.php"?>














