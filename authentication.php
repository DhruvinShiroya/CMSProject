<?php
session_start();
require("Function.php");

// check if user is logged in or not
if (empty($_SESSION['user_id'])) {
    Redirect_to("restricted.php");
    exit();
}
