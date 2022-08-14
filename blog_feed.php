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
    <?php require_once("header.php") ?>
    <main>
        <?php
        session_start();
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
        foreach ($post_result as $posts) {
            if (empty($posts['photo_location'])) {
                $posts['photo_location'] = "anonymus.png";
            }

            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $posts['user_id']) {

                echo "<div class='blog-box  container pt-4 pb-4 mt-4 mb-4 border border-secondary rounded'>
                <div class='row'>
                <div class=' col blog-box-content' style='height=300px' >
                
                <img src='images/" . $posts['photo_location'] . "' alt='Blog image'  height='400px'' >
                </div>
                
                <div class=' col blog-box-content' >
                    <div class='blog-box-title'>
                        <div>

                            <h3>" . $posts['category'] . " : " . $posts['post_title'] . "</h3>
                        </div>
                        <div>
                            <h4> Anonymus </h4>
                        </div>
                        
                    </div>
                    <div class='blog-box-text container-lg' >
                        <p>" . $posts['post_text'] . "</P>
                    </div>
                    <div class='blog-box-date'>
                        <p>" . $posts['date_time'] . "</P>
                        
                        <p>
                        <a  ' class='btn btn-danger' href='delete_post.php?user_id=" . $posts['user_id'] . "&post_id= " . $posts['post_id'] . "' onclick='return confirm(\" Are you sure? \");'>Delete Thread </a>
                        </p>
                        
                        <p>
                        <a  class='btn btn-primary' href='create_blog.php?user_id=" . $posts['user_id'] . "&post_id=" . $posts['post_id'] . "' > Edit the blog </a>
                        </p>


                    </div>
                    <br>
                    
                </div>
                </div>
                
                </div>";
            } else {
                echo "<div class='blog-box pt-4 pb-4 mt-4 mb-4  container pt-4 border border-secondary rounded'>
                <div class='row'>
                <div class=' col blog-box-content' style='height=300px' >
                
                <img src='images/" . $posts['photo_location'] . "' alt='Blog image'  height='400px'' >
                </div>
                <div class=' col blog-box-content' >
                    <div class='blog-box-title'>
                        <div>

                            <h3>" . $posts['category'] . " : " . $posts['post_title'] . "</h3>
                        </div>
                        <div>
                            <h4> Anonymus </h4>
                        </div>
                        
                    </div>
                    <div class='blog-box-text container-lg' >
                        <p>" . $posts['post_text'] . "</P>
                    </div>
                    <div class='blog-box-date'>
                        <p>" . $posts['date_time'] . "</P>
                        
                    </div>
                    <br>
                    
                </div>
                
                </div>  
                </div>";
            }
        }


        // close db connection
        $query->closeCursor();


        ?>

    </main>
    <?php require_once("footer.php") ?>
</body>

</html>