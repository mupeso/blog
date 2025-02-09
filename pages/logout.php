<?php 

    require_once("./core/functions.php");
    session_destroy();
    redirect("./?page=login");
    


?>