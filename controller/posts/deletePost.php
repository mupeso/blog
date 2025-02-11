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

        // var_dump($_POST);
        // die;

        // validation user_id
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

        // validation post_id
        if(!requiredVal($post_id))
        {
            $error[] = "Post ID is required";
        }
        else if(!is_numeric($post_id))
        {
            $error[] = "Post ID must be integer";
        }

        $sqlNum = "SELECT COUNT(*) FROM `comments` WHERE `post_id` = $post_id";
        $resultNum = mysqli_query($con , $sqlNum);

        $row = mysqli_fetch_assoc($resultNum);

        if($row > 0)
        {
            $sqlDelComment = "DELETE FROM `comments` WHERE `post_id` = $post_id";
            $resultDelComment = mysqli_query($con , $sqlDelComment);

            if(!$resultDelComment)
            {
                $error[] = "Comments not found";
                $_SESSION["errors"] = $error;
                redirect("../../?page=post");
            }

        }
        
        $sql = "DELETE FROM `posts` WHERE `id` = $post_id";
        $result = mysqli_query($con , $sql);
        if($result)
        {
            $success[] = "Post deleted successfully";
            $_SESSION["success"] = $success;
            redirect("../../?page=post");
        }
        else 
        {
            $error[] = "Post not found";
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