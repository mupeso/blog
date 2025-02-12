<?php 
    
    $post = $_SESSION["post"];
    // echo $post["content"];
    // die;
    // var_dump($post);
    // die;

?>

    <div class="container mt-5">
        <h2 class="mb-4">Update Post</h2>
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
        <form action="./controller/posts/ConfirmUpdate.php" method="POST" enctype="multipart/form-data">
            <!-- Title Field -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $post["title"]; ?>">
            </div>

            <!-- Content Field -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5"><?= $post["content"]; ?></textarea>
            </div>

            <!-- Image Field -->
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <input type="hidden" name="post_id" value="<?= $post["id"]; ?>">

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>