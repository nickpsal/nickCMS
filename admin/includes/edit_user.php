<?php
    if (isset($_GET['action']) && isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        $query = "SELECT * FROM users WHERE user_id = {$user_id}";
        $find_user = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($find_user)) {
            $user_id = $row['user_id'];
            $username = $row['user_username'];
            $password = $row['user_password'];
            $firstname = $row['user_firstname'];
            $lastname = $row['user_lastname'];
            $email = $row['user_email'];
            $date = $row['user_register'];
            $image = $row['user_image'];
            $role = $row['user_role'];
            $status = $row['user_status'];
        }
    }

    if (isset($_POST['update'])){
        $new_user_password = $_POST['user_password'];
        $new_user_confirm_password = $_POST['user_confirm_password'];
        if ($new_user_password === $new_user_confirm_password) {
            $new_user_firstname = $_POST['user_firstname'];
            $new_user_lastname = $_POST['user_lastname'];
            $new_user_email = $_POST['user_email'];
            $new_user_photo = $_FILES['image']['name'];
            $new_user_photo_temp = $_FILES['image']['tmp_name'];
            $new_user_role = $_POST['user_role']; 
            $path = "../images/" . $username;
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            if (!empty($new_post_image)) {
                $path = "../images/" . $post_author;
                move_uploaded_file($new_user_photo_temp, "$path/$new_user_photo");
                $query = "UPDATE users SET user_password='{$new_user_password}', user_firstname='{$new_user_firstname}', user_lastname='{$new_user_lastname}', user_email='{$new_user_email}', user_image='{$new_user_photo}', user_role='{$new_user_role}' WHERE user_id = '{$user_id}'";
            }else {
            $query = "UPDATE users SET user_password='{$new_user_password}', user_firstname='{$new_user_firstname}', user_lastname='{$new_user_lastname}', user_email='{$new_user_email}', user_role='{$new_user_role}' WHERE user_id = '{$user_id}'";
            }
            echo $query;
            $create_user_query = mysqli_query($conn, $query);
            confirm($create_user_query);
            header("Location:users.php");
        }else {
            echo "<H4>Passwords do not match</H4>";
        }
    }
    if (isset($_POST['back'])){
        header("Location:users.php");
    }
?>
<H1 class="page-header">Edit User</H1>
<form action="" method="post" enctype="multipart/form-data">
    <div class='form-group'>
        <label for="title" class="for">first Name</label>
        <input type="text" class="form-control" value = "<?php echo $firstname; ?>" name="user_firstname" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Last Name</label>
        <input type="text" class="form-control" value = "<?php echo $lastname; ?>" name="user_lastname" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Username</label>
        <input type="text" class="form-control" readonly="readonly" value = "<?php echo $username; ?>" name="user_username" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Password</label>
        <input type="password" class="form-control" value = "<?php echo $password; ?>" name="user_password" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Confirm Password</label>
        <input type="password" class="form-control" value = "<?php echo $password; ?>" name="user_confirm_password" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Email Adress</label>
        <input type="email" class="form-control" value = "<?php echo $email; ?>" name="user_email" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">User Image</label>
        <img src="../images/<?php echo $username . "/" . $image; ?>" width="300">
        <input type="file" name="image">
    </div>
    <div class='form-group'>
        <label for="title" class="for">User Role</label>
        <select name="user_role" id="user_role">
            <?php
                $get_user_role_query = "SELECT * FROM users_roles";
                $get_role = mysqli_query($conn, $get_user_role_query);
                while($row2 = mysqli_fetch_assoc($get_role)) {
                    $role_title = $row2['user_role'];
                    if ($role_title === $role) {
                        echo "<option selected value='{$role_title}'>$role_title</option>";
                    }else {
                        echo "<option value='{$role_title}'>$role_title</option>";
                    }
                }
            ?>
        </select>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Registered Date</label>
        <input type="text" class="form-control" readonly="readonly" value = "<?php echo $date; ?>" name="user_username" required>
        <br>;
    </div>
    <div class='form-group'>
        <input class = 'btn btn-primary' type = 'submit' name = 'update' value = 'Update User'>
        <input class = 'btn btn-primary' type = 'submit' name = 'back' value = 'Back'>
    </div>
</form>
