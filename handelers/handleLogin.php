<?php 

    session_start();
    include ("../core/functions.php");
    include ("../core/validations.php");

    $auth = [];
    $error = [];

    if(CheckRequestMethod("POST"))
    {
        foreach ($_POST as $key => $value)
        {
            $$key=sanitizeInput($value);
        }

        // validate email 
        if(!requiredVal($email))
        {
            $error[] = "email is required";
        }
        else if(!emailVal($email))
        {
            $error[] = "please type valid email";
        }

        // validate password 
        if(!requiredVal($password))
        {
            $error[]= "password is required";
        }
        else if(!minVal($password,6))
        {
            $error[]= "password must be grater than 6 char";
        }
        else if(!maxVal($password,20))
        {
            $error[]= "password must be less than 20 char";
        }

        if(empty($error))
        {
            require_once("../config/env.php");
            require_once("../config/DB_connection.php");
            $password = sha1($password);

            $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
            $result = mysqli_query($con,$sql);
            $user = mysqli_fetch_assoc($result);
            if(isset($user))
            {
                if($user["password"] == $password)
                {
                    $auth["name"] = $user["firstName"];
                    $auth["email"] = $user["email"];
                    $auth["id"] = $user["id"];
                    $_SESSION["auth"] = $auth;
                    redirect("../?page=home");
                }
                else 
                {
                    $error[] = "Password is incorrect";
                    $_SESSION["errors"] = $error;
                    redirect("../?page=login");
                }
            }
            else 
            {
                $error[] = "User not found first Create an account";
                $_SESSION["errors"] = $error;
                redirect("../?page=login");
            }
        }
        else 
        {
            $_SESSION["errors"] = $error;
            redirect("../?page=login");
        }

    }
    else 
    {
        $error[] = "Don't play with the request";
        $_SESSION["errors"] = $error;
        redirect("../?page=login");
    }



?>