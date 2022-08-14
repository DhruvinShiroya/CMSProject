<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-1 my-auto">
        <div class="container-fluid">
            <a class="navbar-brand" href="blog_feed.php"><img style="height:40px ;" class="brand-logo" src="pictures\blogger-logo-icon.png" alt="Blogger logo"></a>
            <div class="navbar-collapse collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='create_blog.php'>Create Blog</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='blog_feed.php'>Blogs</a>
                    </li>";
                    <li class='nav-item'>
                        <a class='nav-link' href='createAccount.php'>Sign Up</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='Login.php'>Login</a>
                    </li>

                    <?php
                    if (!empty($_SESSION['user_id'])) {
                        echo "<li class='nav-item'>
                        <a class='nav-link ' href='search.php'>Search</a>
                        </li>";
                    };
                    ?>

                    <li class='nav-item'>
                        <a class='nav-link ' href='Logout.php'>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>