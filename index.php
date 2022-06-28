<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS project</title>
    <!--Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <header>

            <div>
                <a href="index.html">
                <img src="./img/marvel-logo-34281.png" alt="marvel-logo">
                </a>
            </div>
            <nav>
                <ul class="nav">
                    <li ><a href="index.html" target="_self">Movies  <i class="arrow down"></i></a> 
                        <ul class="sub">
                            <?php
                            echo "
                            <li><a href=create_blog.php?id=1>Create Blog</a></li>
                            <li><a href='index.html'>View Blogs</a></li> ";
                            ?>
                        </ul>
                    </li>

                    <li><a href="https://www.youtube.com/watch?v=ddkZevbhc5o" target="_blank">Watch trailer</a></li>
                
                </ul>
            </nav>

        </header>
        <main>

        </main>
        <footer>

        </footer>
    </body>
</html>