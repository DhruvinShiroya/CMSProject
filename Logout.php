<?php
session_start();
require("Function.php");
if (isset($_SESSION['user_id'])) {

    $_SESSION['user_id'] = null;
    $_SESSION['user_name'] = null;
    $_SESSION['success_message'] = null;
    $_SESSION['error_message'] = null;
    session_destroy();
    Redirect_to("blog_feed.php");
} else {
    echo "Not logged in";
    Redirect_to("Login.php");
}
