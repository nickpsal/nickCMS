<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
            <th>Date</th>
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
                $date = date("d/m/Y", strtotime($row['user_date']));
                $image = $row['user_image'];
                $role = $row['user_role'];
                echo "<tr>";
                echo "<td>{$user_id}</td>";
                echo "<td>{$firstname}</td>";  
                echo "<td>{$lastname}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$email}</td>";  
                $path = "../images/" . $username;  
                echo "<td><img class='img-responsive' src='$path/$image' alt='image'></td>";
                echo "<td>{$role}</td>";
                echo "<td>{$date}</td>";
                echo "</tr>";                              
            }
        }
    ?>
    </tbody>                          
</table>