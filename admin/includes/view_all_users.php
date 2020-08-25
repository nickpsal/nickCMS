<?php
    if (isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = {$delete_id}";
        $delete_query = mysqli_query($conn, $query);
        confirm($delete_query);
        header("Location:users.php");
    }
    if (isset($_GET['approved'])) {
        $user_changed_id = $_GET['approved'];
        $status = "Approved";
        $query_update_status = "UPDATE users SET user_status = '{$status}' WHERE user_id = '{$user_changed_id}'";
        $update_status = mysqli_query($conn, $query_update_status);
    }
    if (isset($_GET['unapproved'])) {
        $user_changed_id = $_GET['unapproved'];
        $status = "Unapproved";
        $query_update_status = "UPDATE users SET user_status = '{$status}' WHERE user_id = '{$user_changed_id}'";
        $update_status = mysqli_query($conn, $query_update_status);
    }
?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
            <th>Date Register</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $query = "SELECT * FROM users ORDER BY user_id DESC";
        $select_all_users = mysqli_query($conn, $query);
        if ($select_all_users) {
            while ($row = mysqli_fetch_assoc($select_all_users)) {
                $user_id = $row['user_id'];
                $username = $row['user_username'];
                $firstname = $row['user_firstname'];
                $lastname = $row['user_lastname'];
                $email = $row['user_email'];
                $date = date("d/m/Y", strtotime($row['user_register']));
                $image = $row['user_image'];
                $role = $row['user_role'];
                $status = $row['user_status'];
                echo "<tr>";
                echo "<td>{$user_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$firstname}</td>";  
                echo "<td>{$lastname}</td>";
                echo "<td>{$email}</td>";  
                $path = "../images/" . $username;  
                echo "<td><img class='img-responsive' src='$path/$image' alt='image'></td>";
                echo "<td>{$role}</td>";
                echo "<td>{$date}</td>";
                if ($role != 'admin') {
                    if ($status == "Unapproved") {
                        echo "<td>Unapproved</td>";
                        echo "<td><a href='users.php?approved={$user_id}'</a>Approved</td>";
                    }else if ($status == "Approved") {
                        echo "<td>Approved</td>";
                        echo "<td><a href='users.php?unapproved={$user_id}'</a>Unapproved</td>";
                    }
                    echo "<td><a href='users.php?delete={$user_id}'</a>Delete</td>";
                }
                echo "</tr>";                              
            }
        }
    ?>
    </tbody>                          
</table>