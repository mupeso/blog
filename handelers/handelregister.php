<?php 
session_start();
include ("../core/functions.php");
include ("../core/validations.php");
$error=[];
$auth=[];


if (CheckRequestMethod("POST"))
{
    foreach ($_POST as $key => $value)
    {
        $$key=sanitizeInput($value);
    }
    
   
    if(!requiredVal($name)){
        $error[]= "name is required";
    }elseif(!minVal($name,3)){
        $error[]= "name must be grater than 3 char";
    }elseif(!maxVal($name,25)){
        $error[]= "name must be less than 25 char";
    }

    if(!requiredVal($email)){
        $error[]= "email is required";
    }elseif(!emailVal($email)){
        $error[]= "please type valid email";
    }


    if(!requiredVal($password)){
        $error[]= "password is required";
    }elseif(!minVal($password,6)){
        $error[]= "password must be grater than 6 char";
    }elseif(!maxVal($password,20)){
        $error[]= "password must be less than 20 char";
    }


    if(empty($error)){
        $password = sha1($password);
        require_once("../config/env.php");
        require_once("../config/DB_connection.php");

        $sql="INSERT INTO `users`( `firstName`, `email`, `password`) VALUES ('$name','$email','$password')";
        $result=mysqli_query($con,$sql);

        //redirect
        $sqll = "SELECT `id` FROM `users` WHERE `email` = '$email'";
        $res=mysqli_query($con,$sqll);
        $user = mysqli_fetch_assoc($res);
         $id=$user['id'];
       
       $_SESSION['auth']=[$id,$name,$email];
       $_SESSION['auth']['id']=$id;



        
        redirect("../?page=home");
    }
    else{
        $_SESSION["errors"]= $error;
        redirect("../?page=register");
    }
    
   
}
else{
    echo "not support that";
}


?>