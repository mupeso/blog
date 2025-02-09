<?php 


    try
    {
        $con = mysqli_connect(HOST_NAME,USER_NAME,PASSWORD,DATABASE);
    }
    catch(throwable $e)
    {
        $_SESSION["errorConnection"] = "INTERNAL SERVER ERROR | 500";
        echo $_SESSION["errorConnection"];
        redirect("../?page=errors");
    }


?>