
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <form action="handelers/storetask.php" method="POST" class="form border p-2 my-5">
                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </div>
                        <?php endif; ?>
                    <input type="hidden" name="post_id" value='<?php echo $_SESSION["post_id"];?>'>
                    <input type="hidden" name="user_id" value='<?php echo $_SESSION["auth"]["id"];?>'>
                    <input type="text" name="title" class="form-control my-3 border border-success" placeholder="add comment">
                    <input type="submit" value="Add" class="form-control btn btn-primary my-3 " >
                </form>
            </div>
        </div>
    </div>
</body>

</html>





