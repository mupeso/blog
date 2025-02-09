<body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <?php 
                            if(isset($_SESSION['auth'])) : 
                        ?>
                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="?page=home">Home</a></li>
                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="?page=about">About</a></li>
                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="?page=post">Sample Post</a></li>
                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="?page=contact">Contact</a></li>
                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="?page=logout">Logout</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="?page=login">Login</a></li>
                        <?php endif; ?> 
                    </ul>
                </div>
            </div>
        </nav>