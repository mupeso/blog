<?php 
    include("./inc/header.php");
    include("./inc/nav.php");
    
    

    switch ($_GET["page"])
    {
        case "home" :
            require_once("./pages/home.php");
            break;
        case "about" :
            require_once("./pages/about.php");
            break;
        case "post" :
            require_once("./pages/post.php");
            break;
        case "contact" :
            require_once("./pages/contact.php");
            break;
        case "login" :
            require_once("./pages/login.php");
            break;
        case "register" :
            require_once("./pages/register.php");
            break;
            default:
            require_once("./pages/home.php");
            break;

    }
?>
    
<?php include("./inc/footer.php"); ?>