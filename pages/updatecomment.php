<?php 
    
    $post = $_SESSION["comment"];

    // echo $comment_id;

    // echo $comment_id;
    // var_dump($post);
    $post['id']=(int) $post['id'];
    $comment_id=(int) $post['id'];
    // var_dump($post);

    // die;
    
?>
  <?php 
        if(isset($_SESSION["errors"])) : 
            foreach ($_SESSION["errors"] as $error) :
    ?>
                <div class="alert alert-danger text-center">
                    <?php echo $error; ?>
                </div>
    <?php 
            endforeach;
        endif;
        unset($_SESSION["errors"]);
    ?>
    <div class="container mt-5">
        <h2 class="mb-4">Update comment</h2>
        <form action="./controller  /comments/ConfirmUpdateComment.php" method="POST" enctype="multipart/form-data">
           

            <!-- Content Field -->
            <div class="mb-3">
                <label for="comment" class="form-label">Content</label>
                <textarea class="form-control" id="comment" name="comment" rows="5"><?= $post["comment"]; ?></textarea>
            </div>

           

            <input type="hidden" name="comment_id" value="<?= $comment_id ?>">

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php 
        if(isset($_SESSION["errors"])) : 
            foreach ($_SESSION["errors"] as $error) :
    ?>
                <div class="alert alert-danger text-center">
                    <?php echo $error; ?>
                </div>
    <?php 
            endforeach;
        endif;
        unset($_SESSION["errors"]);
    ?>