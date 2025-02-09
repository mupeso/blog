
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4 bg-white p-4 rounded shadow">
        <h2 class="text-center text-primary mb-4">Login</h2>
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
        <form action="handelers/handleLogin.php" method="POST">
            <!-- حقل البريد الإلكتروني -->
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" >
                </div>
            </div>

            <!-- حقل كلمة المرور -->
            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" >
                </div>
            </div>

            <!-- زر تسجيل الدخول -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>
            </div>
        </form>

        <!-- رابط التسجيل -->
        <p class="text-center mt-3">
            Don't have an account? <a href="?page=register" class="text-decoration-none">Register</a>
        </p>
    </div>
</div>
