<?php 

    session_start();
    require_once("../../core/functions.php");
    require_once("../../core/validations.php");

    $error = [];
    $success = [];
    // var_dump($_POST);
    // die;

    if(CheckRequestMethod("POST"))
    {
        foreach($_POST as $key => $value)
        {
            $$key = sanitizeInput($value);
        }

        // validate comment
        if(!requiredVal($comment))
        {
            $error[] = "Comment is required";
        }
        else if(!minVal($comment, 1))
        {
            $error[] = "Comment must be greater than 1 char";
        }
        else if(!maxVal($comment, 500))
        {
            $error[] = "Comment must be less than 500 char";
        }

        // validate page
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

        // validate post_id
        if(!requiredVal($post_id))
        {
            $error[] = "Post ID is required";
        }
        else if(!is_numeric($post_id))
        {
            $error[] = "Post ID must be integer";
        }

        // validate user_id
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

        // var_dump($error);
        // die;

        if(empty($error))
        {
            require_once("../../config/env.php");
            require_once("../../config/DB_connection.php");

            $sql = "INSERT INTO `comments`(`comment`, `post_id`, `user_id`) VALUES ('$comment', $post_id , $user_id)";
            $result = mysqli_query($con, $sql);

            if($result)
            {
                $success[] = "Comment added successfully";
                $_SESSION["success"] = $success;
                if($page == "post")
                {
                    redirect("../../?page=post");
                }
                else 
                {
                    redirect("../../?page=home");
                }
            }
            else 
            {
                $error[] = "Error in adding comment";
                $_SESSION["errors"] = $error;
                if($page == "post")
                {
                    redirect("../../?page=post");
                }
                else 
                {
                    redirect("../../?page=home");
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