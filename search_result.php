<?php
$search_str = filter_input(INPUT_GET, "keywords");
echo "<h3 class=\"display-5\"> Search Results for " . $search_str . "</h3>";

// connect to the database
require_once('connection.php');

//setup query to ask the post table
$search_words = explode(" ", $search_str);
$sql = "SELECT * FROM user_posts WHERE ";

// create a new sql
$new_sql = "";
foreach ($search_words as $word) {
    $new_sql = $new_sql . "post_title LIKE '%$word%' OR post_text LIKE '%$word%' OR ";
}
$new_sql = substr($new_sql, 0, strlen($new_sql) - 4);

$sql = $sql . $new_sql;


// prepare the statemet
$query = $db->prepare($sql);

// execute the query
$query->execute();

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
