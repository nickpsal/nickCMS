<?php
    if (isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        echo $delete_id;
        $query = "DELETE FROM posts WHERE post_id = {$delete_id}";
        $delete_query = mysqli_query($conn, $query);
        confirm($delete_query);
        header("Location:posts.php");
    }
?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>        
        </tr>
    </thead>
    <tbody>
    <?php
        $query = "SELECT * FROM posts ORDER BY post_id DESC";
        $select_all_posts = mysqli_query($conn, $query);
        if ($select_all_posts) {
            while ($row = mysqli_fetch_assoc($select_all_posts)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_cat_id = $row['post_cat_id'];
                $find_cat_name = "SELECT cat_title FROM categories WHERE cat_id = '$post_cat_id'";
                $category_name = mysqli_query($conn, $find_cat_name);
                if ($row2 = mysqli_fetch_assoc($category_name)) {
                    $post_category = $row2['cat_title'];
                }
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comments = $row['post_comment_count'];
                $post_date = date("d/m/Y", strtotime($row['post_date']));
                echo "<tr>";
                echo "<td>{$post_id}</td>";
                echo "<td><a href='posts.php?action=edit_post&post_id={$post_id}'</a>$post_title</td>";  
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_category}</td>";
                echo "<td>{$post_status}</td>";    
                $path = "../images/" . $post_author;
                echo "<td><img class='img-responsive' src='$path/$post_image' alt='image'></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comments}</td>";  
                echo "<td>{$post_date}</td>";      
                echo "<td><a href='posts.php?delete={$post_id}'</a>Delete</td>";
                echo "</tr>";                              
            }
        }
    ?>
    </tbody>                          
</table>