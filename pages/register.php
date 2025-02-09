<div class="container">
    <div class="col-8 mx-auto my-5">
        <h2 class="border p-2 my-2 text-center">Register</h2>
        <?php
       // var_dump($_SESSION);
        if (isset($_SESSION['errors'])):
            foreach ($_SESSION['errors'] as $error): ?>
                <div class="alert alert-danger text-center">
                    <?php echo $error; ?>
                </div>
        <?php
            endforeach;
            unset($_SESSION['errors']);
        endif;
        ?>

        <form action="handelers/handelregister.php" method="POST" class="border p-3" novalidate>
            <div class="from-group p-2 my-1">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter your name" id="name">
            </div>
            <div class="from-group p-2 my-1">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" id="email">
            </div>
            <div class="from-group p-2 my-1">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter your password" id="password">
            </div>
            <div class="from-group p-2 my-1">
                <input type="submit" value="Register" class="form-control">
            </div>
        </form>
    </div>
</div>
