<?php
    if (isset($_POST['add_user'])){
        $password = $_POST['user_password'];
        $confirm_password = $_POST['user_confirm_password'];
        if ($password === $confirm_password) {
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $username = $_POST['user_username'];
            $user_email = $_POST['user_email'];
            $user_photo = $_FILES['image']['name'];
            $user_photo_temp = $_FILES['image']['tmp_name'];
            $user_role = $_POST['user_role']; 
            $user_registered = date("Y/m/d");
            $user_status = "Approved";
            $path = "../images/" . $username;
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            if (empty($user_photo)) {
                $query = "INSERT INTO users (user_username, user_password, user_firstname, user_lastname, user_email, user_register, user_role, user_status)";
                $query .= "VALUES ('{$username}', '{$password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_registered}', '{$user_role}', '{$user_status}')";
            }else {
                move_uploaded_file($user_photo_temp, "$path/$user_photo");
                $query = "INSERT INTO users (user_username, user_password, user_firstname, user_lastname, user_email, user_register, user_image, user_role, user_status)";
                $query .= "VALUES ('{$username}', '{$password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_registered}', '{$user_photo}' ,'{$user_role}', '{$user_status}')";
            }
            echo $query;
            $create_post_query = mysqli_query($conn, $query);
            confirm($create_post_query);
            header("Location:users.php");
        }else {
            echo "<H4>Passwords do not match</H4>";
        }
    }
?>
<H1 class="page-header">Add new User</H1>
<form action="" method="post" enctype="multipart/form-data">
    <div class='form-group'>
        <label for="title" class="for">first Name</label>
        <input type="text" class="form-control" name="user_firstname" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Username</label>
        <input type="text" class="form-control" name="user_username" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Password</label>
        <input type="password" class="form-control" name="user_password" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Confirm Password</label>
        <input type="password" class="form-control" name="user_confirm_password" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Email Adress</label>
        <input type="email" class="form-control" name="user_email" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">User Image</label>
        <input type="file" name="image">
    </div>
    <div class='form-group'>
        <label for="title" class="for">User Role</label>
        <select name="user_role" id="user_role">
            <?php
                echo "<option value=''>-- Select User Role --</option>";
                $get_user_role_query = "SELECT * FROM users_roles";
                $get_role = mysqli_query($conn, $get_user_role_query);
                while($row = mysqli_fetch_assoc($get_role)) {
                    $role_id = $row['role_id'];
                    $role_title = $row['user_role'];
                    echo "<option value='{$role_title}'>$role_title</option>";
                }
            ?>
        </select>
    </div>
    <div class='form-group'>
        <input class = 'btn btn-primary' type = 'submit' name = 'add_user' value = 'Add User'>
        <input class = 'btn btn-primary' type = 'submit' name = 'clear' value = 'Clear'>
    </div>
</form>
