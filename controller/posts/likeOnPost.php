<?php 

    session_start();
    // var_dump($_POST);
    // die;

    require_once("../../core/functions.php");
    require_once("../../core/validations.php");

    $error = [];

    if(CheckRequestMethod("POST"))
    {
        foreach ($_POST as $key => $value)
        {
            $$key=sanitizeInput($value);
        }

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

        // validation page
        if(!requiredVal($page))
        {
            $error[] = "Page is required";
        }
        else if(!minVal($page, 3))
        {
            $error[] = "Page must be greater than 3 char";
        }
        else if(!maxVal($page, 5))
        {
            $error[] = "Page must be less than 5 char";
        }

        if(empty($error))
        {
            require_once("../../config/env.php");
            require_once("../../config/DB_connection.php");
            
            $sqlCheck = "SELECT * FROM `likes` WHERE `user_id` = '$user_id'";
            $res = mysqli_query($con, $sqlCheck);
            if($res)
            {
                $post = mysqli_fetch_assoc($res);
                if($post == NULL)
                {
                    $sql = "INSERT INTO `likes` (`user_id`, `post_id`) VALUES ('$user_id', '$post_id')";
                    $result = mysqli_query($con, $sql);
                    if($result)
                    {
                        redirect("../../?page=$page");
                    }
                }
                else 
                {
                    $sql = "DELETE FROM `likes` WHERE `user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    if($result)
                    {
                        redirect("../../?page=$page");
                    }
                }
            }
        }
        else 
        {
            $_SESSION["errors"] = $error;
            redirect("../../?page=$post");
        }
    }
    else 
    {
        $error[] = "Don't play with the request";
        $_SESSION["errors"] = $error;
        redirect("../../?page=$post");
    }









?>