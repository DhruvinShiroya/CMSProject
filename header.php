<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <a class="navbar-brand" href="blog_feed.php"><img src="pictures\blogger-logo-icon.png" alt="Blogger logo"></a>
            <div class="navbar-collapse collapse " id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <?php echo"
                <li class='nav-item'>
                    <a class='nav-link' href='create_blog.php?user_id=1&post_id='>Create Blog</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='playlist.php?user_id=1'>Blogs</a>
                </li>";
                ?>
                </ul>
            </div>
            </div>
        </nav>