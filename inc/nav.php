<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.html"></a>
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
    <style>
        #mainNav {
            background-color: rgba(116, 128, 90, 0.45); /* لون رمادي فاتح مع شفافية */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* ظل خفيف لجعل الشريط يبدو بارزًا */
            transition: background-color 0.3s ease; /* تأثير انتقال للخلفية */
        }

        #mainNav .nav-link {
            color: #333; /* لون النص */
            font-weight: 500;
        }

        #mainNav .nav-link:hover {
            color: #007BFF; /* لون عند التمرير */
        }

        body {
            background-color: white; /* تأكد من أن خلفية الصفحة بيضاء */
        }
    </style>
</body>
