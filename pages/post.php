
<!-- Page Header-->

<header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">        
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1>Man must explore, and this is exploration at its greatest</h1>
                    <h2 class="subheading">Problems look mighty small from 150 miles up</h2>
                    <span class="meta">
                        Posted by
                        <a href="#!">Start Bootstrap</a>
                        on August 24, 2023
                    </span>
                </div>
            </div>
            <div class="container position-relative">
                <a href="./?page=create-post" class="btn btn-primary position-absolute" style="bottom: 255px; right:-30px;">
                    <i class="fas fa-plus"></i> 
                    Create Post
                </a>
            </div>
        </div>
    </div>
</header>
<!-- Post Content-->
<?php 
    if(isset($_SESSION["success"])) :
        foreach($_SESSION["success"] as $message) : 
?>
            <div class="alert alert-success text-center">
                <?= $message; ?>
            </div>
<?php 
        endforeach;
    endif;
    unset($_SESSION["success"]);
?>
<?php 
    if(isset($_SESSION["errors"])) : 
        foreach($_SESSION["errors"] as $error) : 
?>
            <div class="alert alert-danger text-center">
                <?= $error; ?>
            </div>
<?php 
        endforeach;
    endif;
    unset($_SESSION["errors"]);
?>
<?php
    require_once("config/env.php");
    require_once("config/DB_connection.php");
    
    $user_id = $_SESSION["auth"]["id"];
    
    $sql = "SELECT * FROM `posts` where `user_id` = $user_id";

    $result = mysqli_query($con , $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(empty($posts)) :
?>
        <div class="container text-center mt-5">
            <div class="alert alert-warning p-4">
                <h3 class="mb-3">No posts available</h3>
            </div>
        </div>
<?php 
    else : 
        foreach ($posts as $post) :
            // echo $result["id"]; 

?>

            <article class="mb-4">
                <div class="card shadow-sm p-4 col-md-10 col-lg-8 col-xl-7 mx-auto">
                    <div class="position-relative">
                        <div class="position-absolute top-0 end-0 mt-3 me-3">
                            <form action="./controller/posts/editPost.php" method="POST" class="d-inline">
                                <input type="hidden" name="user_id" value="<?= $_SESSION["auth"]["id"]; ?>">
                                <input type="hidden" name="post_id" value="<?= $post["id"]; ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                            </form>
                            <form action="./controller/posts/deletePost.php" method="POST" class="d-inline">
                                <input type="hidden" name="user_id" value="<?= $_SESSION["auth"]["id"]; ?>">
                                <input type="hidden" name="post_id" value="<?= $post["id"]; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="row gx-4 gx-lg-5 justify-content-center">
                        <div class="col-md-10 col-lg-8 col-xl-7">                            
                            <h2 class="section-heading"><?= $post["title"]; ?></h2>
                            <p><b><?= $post["content"]; ?></b></p>
                            <img class="card-img-top" src="./assets/img/<?=$post["image"] ?>" alt="No Image">
                        </div>
                        <div class="mt-4">
                            <h5>Comments</h5>
                            <div class="comments-container">
                                <?php
                                    $post_id = $post['id'];
                                    $comment_query = "SELECT * FROM `comments` WHERE `post_id` = $post_id";
                                    $comment_result = mysqli_query($con, $comment_query);
                                    $comments = mysqli_fetch_all($comment_result, MYSQLI_ASSOC);

                                    if (!empty($comments)) :
                                        foreach ($comments as $comment) :
                                ?>
                                            <div class="comment-box p-3 border rounded mb-2 bg-light">
                                                <strong>User : 
                                                    <?php
                                                        $comment_id = $comment["id"];
                                                    
                                                        $sqlUserName = "SELECT `firstName` FROM `users` 
                                                                        INNER JOIN `comments` ON users.id = comments.user_id
                                                                        WHERE comments.id = $comment_id";
                                                        $result = mysqli_query($con, $sqlUserName);
                                                        $userName = mysqli_fetch_assoc($result);
                                                        // echo $comment_id . "<br>";
                                                        echo $userName["firstName"];
                                                    ?>:
                                                </strong>   
                                                <p class="m-0"><?= $comment["comment"]; ?></p>
                                                <small class="text-muted"><?= $comment["created_at"]; ?></small>
                                            </div>
                                            </form>
                            <form action="./controller/comments/deletecomment.php" method="POST" class="d-inline">
                                <input type="hidden" name="user_id" value="<?= $_SESSION["auth"]["id"]; ?>">
                                <input type="hidden" name="comment_id" value="<?= $comment_id; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete  </button>
                            </form>
                            <form action="./controller/comments/editcomment.php" method="POST" class="d-inline">
                                <input type="hidden" name="user_id" value="<?= $_SESSION["auth"]["id"]; ?>">
                                <input type="hidden" name="comment_id" value="<?= $comment_id; ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Edit </button>
                            </form>
                                <?php
                                        endforeach;
                                    else :
                                ?>
                                        <p class='text-muted'>No comments</p>
                                <?php 
                                    endif;
                                ?>
                            </div>
                        </div>
                        <div class="col-md-10 col-lg-8 col-xl-7">
                            <form action="./controller/comments/createComment.php" method="POST" class="mt-3">
                                <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
                                <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                                <input type="hidden" name="page" value="post">
                                <div class="mb-3">
                                    <textarea name="comment" class="form-control" placeholder="Add a comment..." ></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Comment</button>
                            </form>
                        </div>
                </div>
            </article>

<?php 
        endforeach; 
    endif;
    
?>


                