<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container text-center">
        <div class="alert alert-danger p-4 shadow-lg">
            <h3 class="text-danger">Server Connection Error</h3>
            <p>Sorry, we are experiencing technical issues. Please try again later.</p>
            <hr>
            <?php 
                if(isset($_SESSION["errorConnection"])) : 
            ?>
                <p class="text-muted"><strong>Error Details:</strong> <?= $_SESSION["errorConnection"] ?></p>
                <?php 
                    endif; 
                    unset($_SESSION["errorConnection"]);
                ?>

            <a href="index.php" class="btn btn-primary">Go Home</a>
        </div>
    </div>
</body>