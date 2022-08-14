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

// validate image type
if ($image_type === "image/jpeg" || $image_type === "image/jpg" || $image_type === "image/svg" || $image_type === "image/gif" || $image_type === "image/png") {

  // check the file size
  if ($image_size > 0 && $image_size < 1048576) { // file size less than 1 MB
    // now check for the errors
    if ($image_error === 0) {

      // move the image file to the image folder

      $to = 'images/' . $image_name;
      $from = $image_tmp_name;
      move_uploaded_file($from, $to);
    } else {
      array_push($errors, "there was some error with file");
    }
  } else {
    array_push($errors, "file size is too large");
  }
} else {
  array_push($errors, "The format is not valid");
}

if (!empty($errors)) {

  $_SESSION["error_message"] =  $errors;
}
