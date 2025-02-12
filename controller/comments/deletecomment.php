<?php 

    session_start();
    require_once("../../core/functions.php");
    require_once("../../core/validations.php");
    
    require_once("../../config/env.php");
    require_once("../../config/DB_connection.php");

    if(CheckRequestMethod("POST"))
    {
        foreach ($_POST as $key => $value)
        {
            $$key=sanitizeInput($value);
        }


        if(!requiredVal($user_id))
        {
            $error[] = "User ID is required";
        }
        else if(!is_numeric($user_id))
        {
            $error[] = "User ID must be integer";
        }
        elseif($user_id != $_SESSION["auth"]["id"])
        {
            $error[] = "Don't play with the request";
        }


         if(!requiredVal($comment_id))
         {
             $error[] = "comment ID is required";
         }
         else if(!is_numeric($comment_id))
         {
             $error[] = "comment ID must be integer";
         }

        $sql = "DELETE FROM `comments` WHERE `id` = $comment_id";
        $result = mysqli_query($con , $sql);
        if($result)
        {
            $success[] = "comment deleted successfully";
            $_SESSION["success"] = $success;
            redirect("../../?page=post");
        }
        else 
        {
            $error[] = "comment not found";
            $_SESSION["errors"] = $error;
            redirect("../../?page=post");
        }
    

    }
    else 
    {
        $error[] = "Don't play with the request";
        $_SESSION["errors"] = $error;
        redirect("../?page=post");
    }





















?>