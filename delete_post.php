<?php
// create a variable to store the user_id and post_id

$user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);
$post_id = filter_input(INPUT_GET, 'post_id', FILTER_VALIDATE_INT);



if (!empty($post_id) && !empty($user_id) && $post_id !== false && $user_id !== false) {

    // connect to the database
    require_once('connection.php');

    //setup query to ask the post table
    $sql = "DELETE FROM user_posts WHERE user_id = :user_id AND post_id = :post_id";

    // prepare the statemet
    $query = $db->prepare($sql);

    // bind the parameters
    $query->bindParam(':user_id', $user_id);
    $query->bindParam(':post_id', $post_id);

    // execute the query
    $query->execute();

    // close db connection
    $query->closeCursor();

}

    header("Location: blog_feed.php");

?>