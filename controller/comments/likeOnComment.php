<?php 

session_start();

require_once("../../core/functions.php");
require_once("../../core/validations.php");

$error = [];

if(CheckRequestMethod("POST")) {
    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }

    // validation user_id 
    if(!requiredVal($user_id)) {
        $error[] = "User ID is required";
    } elseif(!is_numeric($user_id)) {
        $error[] = "User ID must be an integer";
    } elseif($user_id != $_SESSION["auth"]["id"]) {
        $error[] = "Don't play with the request";
    }

    // validation comment_id
    if(!requiredVal($comment_id)) {
        $error[] = "Comment ID is required";
    } elseif(!is_numeric($comment_id)) {
        $error[] = "Comment ID must be an integer";
    }

    // validation page
    if(!requiredVal($page)) {
        $error[] = "Page is required";
    } elseif(!minVal($page, 3)) {
        $error[] = "Page must be greater than 3 characters";
    } elseif(!maxVal($page, 5)) {
        $error[] = "Page must be less than 5 characters";
    }

    if(empty($error)) {
        require_once("../../config/env.php");
        require_once("../../config/DB_connection.php");
        
        // Check if the user already liked this specific comment
        $sqlCheck = "SELECT * FROM `likescomment` WHERE `user_id` = '$user_id' AND `comment_id` = '$comment_id'";
        $res = mysqli_query($con, $sqlCheck);
        
        if($res) {
            $post = mysqli_fetch_assoc($res);
            if($post == NULL) {
                // Add like
                $sql = "INSERT INTO `likescomment` (`user_id`, `comment_id`) VALUES ('$user_id', '$comment_id')";
                $result = mysqli_query($con, $sql);
                if($result) {
                    redirect("../../?page=$page");
                }
            } else {
                // Remove like
                $sql = "DELETE FROM `likescomment` WHERE `user_id` = '$user_id' AND `comment_id` = '$comment_id'";
                $result = mysqli_query($con, $sql);
                if($result) {
                    redirect("../../?page=$page");
                }
            }
        }
    } else {
        $_SESSION["errors"] = $error;
        redirect("../../?page=$page");
    }
} else {
    $error[] = "Don't play with the request";
    $_SESSION["errors"] = $error;
    redirect("../../?page=$post");
}

?>
