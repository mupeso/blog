<?php
        require_once("../config/env.php");
        require_once("../config/DB_connection.php");
     include ("../core/functions.php");


if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["title"]))
{
    $title= trim(htmlspecialchars(htmlentities($_POST["title"])));
    $id= trim(htmlspecialchars(htmlentities($_POST["user_id"])));
    $post_id= trim(htmlspecialchars(htmlentities($_POST["post_id"])));



    $sql ="INSERT INTO `comments`(`post_id`,`user_id`,`comment`) VALUES ('$post_id','$id','$title')";

     if ( mysqli_query($con,$sql)==1){
        $_SESSION['success']="comment insert success";
     }

     redirect("../?page=post");
}




















?>