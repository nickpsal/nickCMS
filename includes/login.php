<?php
    include "db.php";
    if (isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $query = "SELECT * FROM users WHERE user_username='{$username}'";
        $find_user = mysqli_query($conn, $query);
        if (!$find_user) {
            die("Query Failed " . mysqli_error($conn));
        }else {
            $count = mysqli_num_rows($find_user);
            if ($count !=0) {
                while ($row = mysqli_fetch_assoc($find_user)) {
                    $user_password = $row['user_password'];
                    $user_role = $row['user_role'];
                    $user_status = $row['user_status'];
                }
            }else {
                echo "<H4>Username dont exist in database</H4>";
            }
        }
    }
?>
