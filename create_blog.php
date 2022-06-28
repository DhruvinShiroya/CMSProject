<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CMS project</title>
    <!--Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    
</head>

<body>
    <header>
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
                    <a class='nav-link' href='blog_feed.php?user_id=1'>Blogs</a>
                </li>";
                ?>
                </ul>
            </div>
            </div>
        </nav>
    </header>

    <?php

    // create a variable to hold the the data to edit the post
    $user_id = null;
    $user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);
    $user_post = null;
    $post_id = filter_input(INPUT_GET, 'post_id', FILTER_VALIDATE_INT);
    $post_text = null;
    $post_title = null;
    $category = null;

    // check if there is an post accossiated with the post_id with the same user_id 
    // if there is then fetch the post data from the database and fill it in the text form;

    if (!empty($post_id) && !empty($user_id) && $post_id !== false && $user_id !== false) {

        // connect to the database
        require_once('connection.php');

        //setup query to ask the post table
        $sql = "SELECT * FROM user_posts WHERE user_id = :user_id AND post_id = :post_id";

        // prepare the statemet
        $query = $db->prepare($sql);

        // bind the parameters
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':post_id', $post_id);

        // execute the query
        $query->execute();

        // fetch all the result data and populate in the field;

        $edit_post = $query->fetchAll();
        
        // assign the value to the text area 

        foreach($edit_post as $edit_posts){
            $post_text = $edit_posts['post_text'];
            $post_title = $edit_posts['post_title'];
            $category = $edit_posts['category'];
        }

        // close db connection
        $query->closeCursor();
    }

    // if the post has been saved
    if (isset($_POST['save'])) {

        //check the recaptcha resoponse 
        if (!empty($_POST['g-recaptcha-response'])) {
            
            $post_title = filter_input(INPUT_POST, 'post_title', FILTER_SANITIZE_SPECIAL_CHARS);
            $post_text = filter_input(INPUT_POST, 'post_text', FILTER_SANITIZE_SPECIAL_CHARS);
            $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
            $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    
            $secret = '6LfePG4gAAAAAASIYzASMEqTP1LD44Q5LVsv3NU9';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);

            $responseData = json_decode($verifyResponse, true);

            
            require('validate.php');

            if (!empty($errors)) {
                echo "<div class='error_msg alert alert-danger'>";
                foreach ($errors as $error) {
                    echo "<p>" . $error . "</p>";
                }
                echo "</div>";
            } else {
                if (!empty($post_id) && !empty($user_id)) {

                    // connect to the database
                    require_once('connection.php');
                    
                    //setup query to ask the post table
                    $sql = "UPDATE user_posts 
                                SET post_text = :post_text,
                                    date_time = NOW(),
                                    published = false ,
                                    post_title = :post_title,
                                    category = :category
                                    WHERE user_id = :user_id AND post_id = :post_id";

                    // prepare the statemet
                    $query = $db->prepare($sql);

                    // bind the parameters
                    $query->bindParam(':user_id', $user_id);
                    $query->bindParam(':post_id', $post_id);
                    $query->bindParam(':post_text', $post_text);
                    $query->bindParam(':post_title', $post_title);
                    $query->bindParam(':category', $category);
                    // execute the query
                    echo "$user_id, $post_id , $$post_title  ";
                    $query->execute();

                    // close db connection
                    $query->closeCursor();
                    echo "this statement is executed";
                    header("Location: blog_feed.php");
                } else if (empty($post_id) && !empty($user_id)) { // function that will be run if the then is not post id so if the post is new
                    echo "test 1 successfull";
                    // connect to the database
                    require_once('connection.php');

                    //setup query to insert a post to the post table
                    $sql = "INSERT INTO user_posts(user_id,date_time,post_title,post_text,published,category) 
                                        VALUES (:user_id,NOW(),:post_title,:post_text,false,:category)";

                    // prepare the statemet
                    $query = $db->prepare($sql);

                    // bind the parameters
                    $query->bindParam(':user_id', $user_id);
                    $query->bindParam(':post_text', $post_text);
                    $query->bindParam(':post_title', $post_title);
                    $query->bindParam(':category', $category);
                    
                    // execute the query
                    $query->execute();

                    // close db connection
                    $query->closeCursor();
                    echo "this statement is executed";
                    header("Location: blog_feed.php");
                }
                
            }
           
        }
    }

    // if the post has been saved
    if (isset($_POST['submit'])) {

        if (!empty($_POST['g-recaptcha-response'])) {

            $post_title = filter_input(INPUT_POST, 'post_title', FILTER_SANITIZE_SPECIAL_CHARS);
            $post_text = filter_input(INPUT_POST, 'post_text', FILTER_SANITIZE_SPECIAL_CHARS);
            $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
            $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
            $secret = '6LcT3J4gAAAAAA983xGINr_df6PgdJWzU-NnMS2U';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);

            $responseData = json_decode($verifyResponse, true);


            require('validate.php');

            if (!empty($errors)) {
                echo "<div class='error_msg alert alert-danger'>";
                foreach ($errors as $error) {
                    echo "<p>" . $error . "</p>";
                }
                echo "</div>";
            } else {


                if (!empty($post_id) && !empty($user_id)) {

                    // connect to the database
                    require_once('connection.php');

                    //setup query to update the post table
                    $sql = "UPDATE user_posts 
                        SET post_text = :post_text,
                            date_time = NOW(),
                            published = true,
                            post_title = :post_title,
                            category = :category
                            WHERE user_id = :user_id AND post_id = :post_id";

                    // prepare the statemet
                    $query = $db->prepare($sql);

                    // bind the parameters
                    $query->bindParam(':user_id', $user_id);
                    $query->bindParam(':post_id', $post_id);
                    $query->bindParam(':post_text', $post_text);
                    $query->bindParam(':post_title', $post_title);
                    $query->bindParam(':category', $category);
                    // execute the query
                    $query->execute();

                    // close db connection
                    $query->closeCursor();
                    echo "this statement is executed";
                    header("Location: blog_feed.php");

                    // if the post is new then this code will be executed
                } else if (empty($post_id) && !empty($user_id)) {

                    // connect to the database
                    require_once('connection.php');

                    //setup query to insert a post to the post table
                    $sql = "INSERT INTO user_posts(user_id,date_time,post_title,post_text,published,category) 
                                VALUES (:user_id,NOW(),:post_title,:post_text,true,:category)";

                    // prepare the statemet
                    $query = $db->prepare($sql);

                    // bind the parameters
                    $query->bindParam(':user_id', $user_id);
                    $query->bindParam(':post_text', $post_text);
                    $query->bindParam(':post_title', $post_title);
                    $query->bindParam(':category', $category);

                    // execute the query
                    $query->execute();

                    // close db connection
                    $query->closeCursor();
                    echo "this statement is executed";
                    header("Location: blog_feed.php");
                }
                echo "this statement is not executed";
            }
        }
    }

    ?>
    <main>
    <div class="row ">

    <div class="col-md-4 pt-3">
           <img src="pictures\blogger-logo-icon.png" alt="anonymus picture">
         </div>
         <div class="col-md-8 pt-3">
        <form class="form" action=<?php echo $_SERVER['PHP_SELF'] ?> method="POST" class="form">

            <input type="hidden" name="user_id" value="<?php echo "$user_id" ?>">
            <input type="hidden" name="post_id" value="<?php echo "$post_id" ?>">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Blog Title</label>
                <textarea id="exampleFormControlTextarea1" class="form-control" name="post_title" required><?php echo "$post_title"; ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Blog entry</label>
                <textarea id="exampleFormControlTextarea1" rows="13" class="form-control" name="post_text" required><?php echo "$post_text"; ?></textarea>
            </div>
            <div class="form-group">
               <label for="category"> category </label>
               <select name="category" class="form-select form-select-lg form-control" id="category" required>
                 <option selected>Choose category</option>
                 <option value="travel"> travel </option>
                 <option value="food"> food </option>
                 <option value="technology"> technology </option>
                 <option value="Machines"> Machines</option>
                 <option value="computers"> computers </option>
                 <option value="graphic card"> graphic card </option>
                 <option value="games"> games </option>
                 <option value="Music"> music/ songs  </option>
                 <option value="console"> Xbox/PS5 </option>
                 <option value="Mobile"> Mobile </option>
                 <option value="laptop"> Laptop </option>
                 <option value="watches"> watches </option>
               </select>
             </div>

            <div class="g-recaptcha" data-sitekey="6LcT3J4gAAAAAJn8yKRvPyKK1YaFg0OA4hMJB3M4" require></div>
            <button type="submit" name="save" value="save" class="btn btn-primary mb-2">Save</button>
            <button type="submit" name="submit" value="submit" class="btn btn-primary mb-2">Submit</button>




        </form>
        </div>
        

    </div>

    </main>
    <footer>

    </footer>
</body>

</html>