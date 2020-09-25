<?php session_start(); ?>
<header class="header navbar-fixed-top" style="background-color:#171616;">
            <!-- Navbar -->
            <nav class="navbar" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="menu-container">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="toggle-icon"></span>
                        </button>

                        <!-- Logo -->
                        <div class="logo">
                            <a class="logo-wrap" href="../user/index.php">
                                <!--<img class="logo-img logo-img-main" src="img/logo.png" alt="Asentus Logo">
                                <img class="logo-img logo-img-active" src="img/logo-dark.png" alt="Asentus Logo">-->
                                <h2 class="color-base fweight-700">CMS.COM</h2>
                            </a>
                        </div>
                        <!-- End Logo -->
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse nav-collapse">
                        <div class="menu-container">
                            <ul class="navbar-nav navbar-nav-right">
                              <li class="nav-item"><a class="nav-item-child nav-item-hover" href="../user/index.php">Home</a></li>
                              <li class="nav-item"><a class="nav-item-child nav-item-hover" href="contact.php">Contact</a></li>
                              <li class="nav-item dropdown">
                    <a href="#" class="nav-item-child nav-item-hover" data-toggle="dropdown"><i class="fa fa-user"></i>Categories<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       <?php
                                 
    $qry="SELECT * FROM categories";
    $all_categories_qry= mysqli_query($con,$qry);
    
    while($row=mysqli_fetch_assoc($all_categories_qry)){
        $cat_title=$row['cat_title'];
        $cat_id=$row['cat_id'];
        echo "<li><a href='../user/category.php?cat_id=$cat_id'>{$cat_title}</a></li>";
    }
    ?>
                       
                    </ul>
                </li>   
                               <?php
                                if(isset($_SESSION['user_role'])){
                                    if($_SESSION['user_role'] == "Admin"){
                                        echo "<li class='nav-item'><a class='nav-item-child nav-item-hover' href='../admin/index.php'>Admin</a></li>";
                                    }else{  
                                        echo "<li class='nav-item'><a class='nav-item-child nav-item-hover' href='add_post.php'>Add Post</a></li>";
                                        echo "<li class='nav-item'><a class='nav-item-child nav-item-hover' href='my_post.php'>My Posts</a></li>";
                                        echo "<li class='nav-item'><a class='nav-item-child nav-item-hover' href='profile.php'>{$_SESSION['user_firstname']}"." "."{$_SESSION['user_lastname']}</a></li>";
                                    } 
                                }else{
                                }
                                ?>
                                <!--
                                <li class="nav-item"><a class="nav-item-child nav-item-hover" href="about.html">About</a></li>
                                <li class="nav-item"><a class="nav-item-child nav-item-hover" href="products.html">Products</a></li>
                                <li class="nav-item"><a class="nav-item-child nav-item-hover" href="faq.html">FAQ</a></li>   --> 
                                
                               
                            <?php
                                if(!isset($_SESSION['user_role'])){             
                                    echo "<li class='nav-item'><a class='nav-item-child nav-item-hover' href='../user/login.php'>Login</a></li>";
                                }else{   
                                    if(isset($_GET['post_id'])){
                                        $post_id=$_GET['post_id'];
                                        echo "<li class='nav-item'><a class='nav-item-child nav-item-hover' href='../admin/update_posts.php?edit_id={$post_id}'>Edit Post</a></li>";
                                    }
                                    echo "<li class='nav-item'><a class='nav-item-child nav-item-hover' href='../admin/logout.php'>LogOut</a></li>";
                                }
                                ?>                     
                                                                 
                            </ul>
                        </div>
                    </div>
                    <!-- End Navbar Collapse -->
                </div>
            </nav>
            <!-- Navbar -->
        </header>