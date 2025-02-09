<div class="container mt-5">
    <h2 class="mb-4">Create Post</h2>
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
    <form action="./controller/posts/createPost.php" method="POST" enctype="multipart/form-data">
        <!-- Title Field -->
        <dclass="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter post title">
        </dclass=>

        <!-- Content Field -->
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" placeholder="Enter post content"></textarea>
        </div>

        <!-- Image Field -->
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
