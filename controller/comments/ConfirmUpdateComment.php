<?php 

    session_start();
    include ("../../core/functions.php");
    include ("../../core/validations.php");

    $error = [];
    $success = [];

    

    if(CheckRequestMethod("POST"))
    {
        foreach ($_POST as $key => $value)
        {
            $$key=sanitizeInput($value);
        }


        // validate content 
        if(!requiredVal($comment))
        {
            $error[] = "comment is required";
        }
        else if(!minVal($comment,5))
        {
            $error[]= "comment must be grater than 20 char";
        }
        else if(!maxVal($comment,500))
        {
            $error[]= "comment must be less than 5000 char";
        }

        // validation comment_id
        if(!requiredVal($comment_id))
        {
            $error[] = "comment ID is required";
        }
        else if(!is_numeric($comment_id))
        {
            $error[] = "comment ID must be integer";
        }
        
        require_once("../../config/env.php");
        require_once("../../config/DB_connection.php");

        $post_query = "SELECT * FROM `comments` WHERE `id` = '$comment_id'";
        $post_result = mysqli_query($con , $post_query);
        $post = mysqli_fetch_object($post_result);
        
        

        if(empty($error))
            {    
                
                $sql = "UPDATE `comments` SET `comment` = '$comment' WHERE `id` = $comment_id";
                $result = mysqli_query($con,$sql);
                if($result)
                {
                    $success[] = "comment updated successfully";
                    $_SESSION["success"] = $success;
                    redirect("../../?page=post");
                }
            }
            else 
            {
                $_SESSION["errors"] = $error;
                redirect("../../?page=updatecomment");
            }
    }
    else 
    {
        $error[] = "Don't play with the request";
        $_SESSION["errors"] = $error;
        redirect("../?page=login");
    }


?>