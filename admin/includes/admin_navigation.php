<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS.COM Admin</a>
            </div>
            <?php
    $session = session_id();
    $time = time();
    $time_out_in_seconds = 20;
    $time_out = $time - $time_out_in_seconds;
    $qry_online = mysqli_query($con,"SELECT * FROM user_online WHERE session ='$session'");
    $count = mysqli_num_rows($qry_online);
    if($count == NULL){
        mysqli_query($con,"INSERT INTO user_online(session, time) VALUES('$session','$time')");
    }else{
        mysqli_query($con,"UPDATE user_online SET time = '$time' WHERE session = '$session'");
    }
    $user_online = mysqli_query($con,"SELECT * FROM user_online WHERE time > '$time_out'");
    $count_user = mysqli_num_rows($user_online);
?>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li><a href="">User Online :<?php echo $count_user; ?></a></li>
               <li><a href="../user/index.php">Home Page</a></li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user_firstname']." ".$_SESSION['user_lastname'];?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../admin/view_profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../admin/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
                
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
            
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="../admin/view_posts.php">View All Posts</a>
                            </li>
                            <li>
                                <a href="../admin/add_post.php">Add Posts</a>
                            </li>
                        </ul>
                    </li>
                    
                    
                    <li>
                        <a href="../admin/categories.php"><i class="fa fa-fw fa-wrench"></i>Categories Page</a>
                    </li>
                    
                    
                    <li>
                        <a href="../admin/comments.php"><i class="fa fa-fw fa-file"></i> Comments</a>
                    </li>
                    
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="../admin/users.php">View All Users</a>
                            </li>
                            <li>
                                <a href="../admin/add_user.php">Add User</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="../admin/view_profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
                    </li>
                    <li>
                        <a href="../admin/view_contact.php"><i class="fa fa-fw fa-file"></i> Contacts Messages</a>
                    </li>
                    
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>