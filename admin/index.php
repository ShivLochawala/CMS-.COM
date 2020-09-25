<?php include"includes/admin_header.php"?>
<?php include("../user/includes/db.php");?>

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
                            Welcome to Admin
                            <small><?php echo $_SESSION['user_firstname'];?></small>
                        </h1>
                    </div>
                </div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  <div class="huge">
                     <?php
                      $post_qry=mysqli_query($con,"SELECT * FROM posts");
                      $pcount=mysqli_num_rows($post_qry);
                      echo $pcount;
                      ?>
                       </div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="view_posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class="huge">
                    <?php
                      $comment_qry=mysqli_query($con,"SELECT * FROM comments");
                      $c_count=mysqli_num_rows($comment_qry);
                      echo $c_count;
                      ?>
                     </div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class="huge">
                    <?php
                      $user_qry=mysqli_query($con,"SELECT * FROM users");
                      $ucount=mysqli_num_rows($user_qry);
                      echo $ucount;
                      ?>
                    </div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                        <?php
                            $cat_qry=mysqli_query($con,"SELECT * FROM categories");
                            $cat_count=mysqli_num_rows($cat_qry);
                            echo $cat_count;
                        ?>
                        </div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <hr>
</div>
<?php
     $post_qry=mysqli_query($con,"SELECT * FROM posts WHERE post_status = 'published'");
     $ppcount=mysqli_num_rows($post_qry);            
    
     $post_qry=mysqli_query($con,"SELECT * FROM posts WHERE post_status = 'draft'");
     $pdcount=mysqli_num_rows($post_qry);
                
     $comment_qry=mysqli_query($con,"SELECT * FROM comments WHERE comment_status = 'Unapprove'");
     $c_u_count=mysqli_num_rows($comment_qry);
     
     $user_qry=mysqli_query($con,"SELECT * FROM users WHERE user_role = 'Subscriber'");
     $uscount=mysqli_num_rows($user_qry);
                
                
                
                
?>                             
<div class="row"><br>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Details', 'Count'],
        <?php
            $element_text = ['All Posts','Active Posts','Draft Posts','Comments','Unapprove Comments','Users','Subscribers','Categories'];
            $element_count = [$pcount, $ppcount, $pdcount, $c_count, $c_u_count, $ucount, $uscount, $cat_count];
            for($i = 0; $i < 8; $i++){
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
            }
        ?>  
//        ['posts', 100]
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>     
                </div>
                <!-- /.row -->
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include"includes/admin_footer.php"?>
