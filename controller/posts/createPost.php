<?php 

    session_start();
    include ("../../core/functions.php");
    include ("../../core/validations.php");

    $auth = [];
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
        else if(!minVal($title,20))
        {
            $error[]= "Title must be grater than 20 char";
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
        else if(!minVal($content,200))
        {
            $error[]= "Content must be grater than 200 char";
        }
        else if(!maxVal($content,5000))
        {
            $error[]= "Content must be less than 5000 char";
        }
        
        // validate image
        $image = $_FILES["image"];
        // if(isset($image))
        // {
        //     var_dump($image);
        // }
        // if(!requiredVal($image))
        // {
        //     var_dump($image["error"]);
        //     $error[] = "Content is required";
        // }
        if(isset($image) && $image["error"] == 0)
        {
            $ext = pathinfo($image["name"] , PATHINFO_EXTENSION);
            $image_name = "product-" . time() . "." . $ext;
        }
        
        if(move_uploaded_file($image["tmp_name"] , "../../assets/img/$image_name"))
        {
            if(empty($error))
            {
                require_once("../../config/env.php");
                require_once("../../config/DB_connection.php");
    
                $id = $_SESSION["auth"]["id"];
    
                $sql = "INSERT INTO `posts`(`title`, `content`, `image`, `user_id`) VALUES ('$title' , '$content' , '$image_name' , $id)";
                $result = mysqli_query($con,$sql);
                if($result)
                {
                    $success[] = "Post added successfully";
                    $_SESSION["success"] = $success;
                    redirect("../../?page=post");
                }
            }
            else 
            {
                $_SESSION["errors"] = $error;
                redirect("../../?page=create-post");
            }
        }
        else 
        {
            $error[] = "Post image not found";
            $_SESSION["errors"] = $error;
            redirect("../../?page=create-post");
        }
    }
    else 
    {
        $error[] = "Don't play with the request";
        $_SESSION["errors"] = $error;
        redirect("../?page=login");
    }



















?>