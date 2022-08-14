<?php

$input_first_name = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
$input_last_name = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
$input_user_name =   filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
$input_user_email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);;
$input_user_password = filter_input(INPUT_POST, "password");
$input_user_repassword = filter_input(INPUT_POST, "repassword");
$error = array();
$success = array();
echo "this is working";
// validate the user input 
if (empty($input_first_name) || empty($input_last_name)) {
    array_push($error, "Please Enter valid First Name and Last Name");
}
if (empty($input_user_name)) {
    array_push($error, "Please Enter valid User Name");
}
if ($input_user_email === false  || empty($input_user_email)) {
    array_push($error, "Please Enter valid Email address");
}
if (empty($input_user_password)) {
    array_push($error, "Please Enter valid Password");
}
if (empty($input_user_repassword) || $input_user_password !== $input_user_password) {
    array_push($error, "Please reenter the Password in retype password");
}


// if there is not error
if (empty($error)) {

    // hash the password before storing it
    $hash_password = password_hash($input_user_password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user_info(first_name,last_name,user_name,email,password) VALUES(:first_name,:last_name,:username,:email,:password)";

    // connecting to the database
    require_once("connection.php");

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':first_name', $input_first_name);
    $stmt->bindParam(':last_name', $input_last_name);
    $stmt->bindParam(':username', $input_user_name);
    $stmt->bindParam(':email', $input_user_email);
    $stmt->bindParam(':password', $hash_password);

    $stmt->execute();

    array_push($success, "Successfully created");
    array_push($success, "try loggin in now");

    session_start();
    $_SESSION["success_message"] = $success;

    $stmt->closeCursor();

    // header("Location: createAccount.php");
} else {
    session_start();
    $_SESSION["error_message"] = $error;
}
