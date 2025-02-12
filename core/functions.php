
<?php 


    function CheckRequestMethod($method)
    {

        if($_SERVER['REQUEST_METHOD'] == $method){
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