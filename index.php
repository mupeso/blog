<?php     

    include("./inc/header.php");

    $page = $_GET["page"] ?? "login";
    if($page != "login")
    {
        include("./inc/nav.php");
    }

    switch ($page)
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
        case "create-post" :
            require_once("./pages/createPost.php");
            break;
            // case "create-comment" :
            //     require_once("./pages/createComment.php");
            //     break;
        case "contact" :
            require_once("./pages/contact.php");
            break;
        case "updatePost" :
            require_once("./pages/updatePost.php");
            break;
        case "updatecomment" :
            require_once("./pages/updatecomment.php");
            break;
             
        case "login" :
            require_once("./pages/login.php");
            break;
        case "register" :
            require_once("./pages/register.php");
            break;
        case "logout" :
            require_once("./pages/logout.php");
            break;
        case "errors" :
            require_once("./pages/errors.php");
            break;
            
    }
?>

<?php if($page != "login") include("./inc/footer.php"); ?>