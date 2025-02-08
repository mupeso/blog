
<?php 


    function CheckRequestMethod($method)
    {

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            return true;

    }
    return false;
}

function sanitizeInput($input){
    return trim(htmlspecialchars(htmlentities($input)));
}

function redirect($path){
    header("location:$path");
    die;
}







?>