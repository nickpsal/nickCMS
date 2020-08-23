<?php
    $db['db_host'] = "localhost";
    $db['db_user'] = "nickpsal";
    $db['db_pass'] = "ospzx3vu!@34";
    $db['db_name'] = "cms";

    foreach($db as $key => $value) {
        define(strtoupper($key), $value);   
    }
    
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("Database Connection failed" . mysqli_error($conn));
    }
?>