<?php

// array to store the errors
$errors = array();
//check to see whether data has been entered and whether it is the correct format, provide a heplful error message if not and set the flag variable to true 

if (empty($post_title)) {
  $error_msg_1 = "Please enter post title";
  array_push($errors, $error_msg_1);
}

if (empty($post_text)) {
  $error_msg_2 = "Please enter the post text";
  array_push($errors, $error_msg_2);
}

if (empty($category)) {
    $error_msg_3 = "Please select the category";
    array_push($errors, $error_msg_3);
  }
?>