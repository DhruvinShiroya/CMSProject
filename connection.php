<?php

try {
    //data base url and name 
    $dsn = 'mysql:host=172.31.22.43;dbname=Dhruvinkumar200503894';
    //username
    $username = 'Dhruvinkumar200503894'; 
    //password
    $password = '0JzgQgLfrP';
    $db = new PDO($dsn, $username, $password);
    //set the errormode to exception 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
   $error_message = $e->getMessage(); 
   echo "<p> Coudn't connect to the database, error found -  $error_message </p>"; 
}

// try {
//     //data base url and name 
//     $dsn = 'mysql:host=localhost;dbname=blog';
//     //username
//     $username = 'root'; 
//     //password
//     $password = 'dhruvin';
//     $db = new PDO($dsn, $username, $password);
//     //set the errormode to exception 
//     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// }
// catch(PDOException $e) {
//    $error_message = $e->getMessage(); 
//    echo "<p> Coudn't connect to the database, error found -  $error_message </p>"; 
// }
?>