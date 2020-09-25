<?php
  //  include"../user/includes/db.php";
            function insert_category(){
                  //INSERT DATA IN categories table
                    global $con;
                    $cat_title=$_POST['cat_title'];
                                
                    $qry_add="INSERT INTO categories(cat_title)VALUE('{$cat_title}')";
                    $result_add=mysqli_query($con,$qry_add);
                            
                    if($result_add){
                            echo "<h2 style='color:green;'>Added in Categories</h2>";
                    }else{
                            die("<h2 style='color:red;'>Not Add in Categories</h2>".mysqli_error($con));
                             
                    }
            }   
            function display_categories(){
                    // Display data of categories
                    global $con; 
                    $qry_all="SELECT * FROM categories";
                    $all_categories_qry= mysqli_query($con,$qry_all);
    
                    while($row_all=mysqli_fetch_assoc($all_categories_qry)){
                    $cat_title=$row_all['cat_title'];
                    $cat_id=$row_all['cat_id'];
                    echo "<tr>";
                    echo "<td>{$cat_id}</td>";
                    echo "<td>{$cat_title}</td>";
                    echo "<td><a href='categories.php?edit_id={$cat_id}'>Edit</a></td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete')\" href='categories.php?delete_id={$cat_id}'>Delete</a></td>";
                    echo "</tr>";
                    }
            }
            function delete_category(){
                    global $con;
                    $cat_id=$_GET['delete_id'];    
                    $qry_delete="DELETE FROM categories WHERE cat_id={$cat_id}";
                    $result_delete=mysqli_query($con,$qry_delete);
                    if($result_delete){
                            header("Location: categories.php");   
                    }
            }
?>