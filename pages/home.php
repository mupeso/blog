<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Clean Blog</h1>
                    <span class="subheading">A Blog Theme by Start Bootstrap</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
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
    require_once("./config/env.php");
    require_once("./config/DB_connection.php");
    // var_dump($_SESSION["auth"]);
    // die;

    $sql = "SELECT * FROM `posts` ORDER BY RAND() LIMIT 5";
    $result = mysqli_query($con , $sql);

    $posts = mysqli_fetch_all($result , MYSQLI_ASSOC);
    // var_dump($posts);
    // die;

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
?>
            <article class="mb-4">
                <div class="card shadow-sm p-4 col-md-10 col-lg-8 col-xl-7 mx-auto">
                    <div class="row gx-4 gx-lg-5 justify-content-center">
                        <div class="col-md-10 col-lg-8 col-xl-7">                            
                            <h2 class="section-heading"><?= $post["title"]; ?></h2>
                            <p><b><?= $post["content"]; ?></b></p>
                            <img class="card-img-top" src="./assets/img/<?= $post["image"]; ?>" alt="No Image">
                        </div>
                        <div class="mt-4">
                            <h5>Comments</h5>
                            <div class="comments-container">
                                <?php 
                                    $post_id = $post['id'];
                                    $sqlComment = "SELECT * FROM `comments` WHERE post_id = $post_id";
                                    $resultComment = mysqli_query($con , $sqlComment);
                                    $comments = mysqli_fetch_all($resultComment, MYSQLI_ASSOC);

                                    if(!empty($comments)) : 
                                        foreach($comments as $comment) : 
                                ?>
                                            <div class="comment-box p-3 border rounded mb-2 bg-light">
                                                <strong>User : 
                                                    <?php 
                                                        $comment_id = $comment["id"];
                                                        
                                                        $sqlUserName = "SELECT `firstName` FROM `users` 
                                                                        INNER JOIN `comments` ON users.id = comments.user_id
                                                                        WHERE comments.id = $comment_id";
                                                        $result = mysqli_query($con, $sqlUserName);
                                                        $userName = mysqli_fetch_assoc($result );
                                                        // var_dump($userName);
                                                        // die;
                                                        echo $userName["firstName"];
                                                    ?>:
                                                </strong>
                                                <p class="m-0"><?= $comment["comment"]; ?></p>
                                                <small class="text-muted"><?= $comment["created_at"]; ?></small>
                                            </div>
                                <?php 
                                        endforeach; 
                                    else :
                                ?>
                                
                                        <p class='text-muted'>No comments</p>  
                                <?php endif; ?>  
                            </div>
                        </div>
                        <div class="col-md-10 col-lg-8 col-xl-7">
                            <form action="./controller/comments/createComment.php" method="POST" class="mt-3">
                                <input type="hidden" name="post_id" value="<?= $post_id; ?>">
                                <input type="hidden" name="user_id" value="<?= $_SESSION["auth"]["id"]; ?>">
                                <input type="hidden" name="page" value="home">
                                <div class="mb-3">
                                    <textarea name="comment" class="form-control" placeholder="Add a comment..." ></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Comment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>

<?php 
        endforeach;
    endif;
?>
