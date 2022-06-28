<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS project</title>
    <link rel="stylesheet" href="style.css">
    <!--Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid ">
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
                    <a class='nav-link' href='blog_feed.php?user_id=1'>Blogs</a>
                </li>";
                ?>
                </ul>
            </div>
            </div>
        </nav>
    </header>
    <main>
        <?php
            $user_id = null;
            $user_post = null;
            $post_datetime = null;
            $post_text = null;
            $post_title = null;

            // connect to  the database
            require_once('connection.php');

            // get the last record from the database
            $sql = "SELECT * FROM user_posts ORDER BY date_time DESC LIMIT 10";

            // prepare the statemet
            $query = $db->prepare($sql);

            // execute the query
            $query->execute();

            // fetch all the result data and populate in the field;

            $post_result = $query->fetchAll();

            // assign the value to the text area 
            
            // <img class='blog-box-image' src='pictures\anonymus.png' alt='Italian Trulli'>
            foreach($post_result as $posts){
                echo "<div class='blog-box  container pt-4 border border-secondary rounded'>
                
                <div class='blog-box-content' >
                    <div class='blog-box-title'>
                        <div>

                            <h3>". $posts['category']." : ". $posts['post_title'] ."</h3>
                        </div>
                        <div>
                            <h4> Anonymus </h4>
                        </div>
                        
                    </div>
                    <div class='blog-box-text container-lg' >
                        <p>". $posts['post_text']."</P>
                    </div>
                    <div class='blog-box-date'>
                        <p>". $posts['date_time']."</P>
                        
                        <p>
                        <a  ' class='btn btn-danger' href='delete_post.php?user_id=" . $posts['user_id']."&post_id= ". $posts['post_id']."' onclick='return confirm(\" Are you sure? \");'>Delete Thread </a>
                        </p>
                        
                        <p>
                        <a  class='btn btn-primary' href='create_blog.php?user_id=". $posts['user_id']."&post_id=". $posts['post_id']."' > Edit the blog </a>
                        </p>


                    </div>
                    <br>
                    
                </div>
                
                
                </div>";

            }
            // close db connection
            $query->closeCursor();
            

        ?>

    </main>
    <footer>

    </footer>
</body>

</html>