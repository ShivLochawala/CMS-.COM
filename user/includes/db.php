<?php

$con=mysqli_connect('localhost','root','','mycms1');
if(!$con){
    dio("Connection Problem").mysqli_error($con);
}else{
   //echo "<h1 style='color:red;'>We are Connected</h1>";
}
?>