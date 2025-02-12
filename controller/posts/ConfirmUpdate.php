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

        // validate title 
        if(!requiredVal($title))
        {
            $error[] = "Title is required";
        }
        else if(!minVal($title,5))
        {
            $error[]= "Title must be grater than 5 char";
        }
        else if(!maxVal($title,150))
        {
            $error[]= "Title must be less than 150 char";
        }

        // validate content 
        if(!requiredVal($content))
        {
            $error[] = "Content is required";
        }
        else if(!minVal($content,20))
        {
            $error[]= "Content must be grater than 20 char";
        }
        else if(!maxVal($content,5000))
        {
            $error[]= "Content must be less than 5000 char";
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
        
        require_once("../../config/env.php");
        require_once("../../config/DB_connection.php");

        $post_query = "SELECT * FROM `posts` WHERE `id` = '$post_id'";
        $post_result = mysqli_query($con , $post_query);
        $post = mysqli_fetch_object($post_result);
        
        $image = $_FILES["image"];
        
        // validate image
        if(isset($image))
        {
            if(file_exists("../../assets/image/$post->image"))
            {
                unlink("../../assets/image/$post->image");
            }

            if(isset($image) && $image["error"] == 0)
            {
                $ext = pathinfo($image["name"] , PATHINFO_EXTENSION);
                $image_name = "product-" . time() . "." . $ext;
            }
            else 
            {
                $image_name = $post->image;
            }
            
            move_uploaded_file($image["tmp_name"] , "../../assets/img/$image_name");
        
        }

        if(empty($error))
        {    
            
            $sql = "UPDATE `posts` SET `title` = '$title' , `content` = '$content' , `image` = '$image_name' WHERE `id` = $post_id";
            $result = mysqli_query($con,$sql);
            if($result)
            {
                $success[] = "Post updated successfully";
                $_SESSION["success"] = $success;
                redirect("../../?page=post");
            }
        }
        else 
        {
            $_SESSION["errors"] = $error;
            redirect("../../?page=updatePost");
        }
    }
    else 
    {
        $error[] = "Don't play with the request";
        $_SESSION["errors"] = $error;
        redirect("../?page=login");
    }


?>