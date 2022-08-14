<?php
$error = array();

require("Function.php");


// check if user is not loged in

// check if the input email and password are not empty
$input_email = filter_input(INPUT_POST, 'email');
$input_password = filter_input(INPUT_POST, 'password');


if (empty($input_email)) {
    array_push($error, "Please enter email or username");
} else if (empty($input_password)) {
    array_push($error, "Please Password");
} else {
    try {
        $hash_password = password_hash($input_password, PASSWORD_DEFAULT);

        $sql = "SELECT user_id,user_name,password FROM user_info WHERE user_name= :username OR email=:username";

        // connecting to the database
        require_once("connection.php");



        $stmt = $db->prepare($sql);

        $stmt->bindParam(':username', $input_email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $result_user_id = $row['user_id'];
            $result_user_name = $row['user_name'];
            $result_user_password = $row['password'];

            // verify the password
            if (password_verify($input_password, $result_user_password)) {
                // start session
                session_start();
                // set the session values;

                $_SESSION['user_id'] = $result_user_id;
                $_SESSION['username'] = $result_user_name;
                $_SESSION['loggedin'] = true;

                $_SESSION['success_message'] = "Successfully login";

                $stmt->closeCursor();
            } else {
                array_push($error, "worng password");
            }
        } else {
            array_push($error, "user can not be found");
        }
    } catch (Exception $em) {
        $errorMessage = $em->getMessage();
        array_push($error, "$errorMessage");
    }
}

if (!empty($error)) {
    session_start();
    $_SESSION["error_message"] = $error;
}
