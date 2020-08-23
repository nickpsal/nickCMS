<?php
    if (isset($_GET['delete']) && isset($_GET['p_id'])){
        $delete_id = $_GET['delete'];
        $comment_post_id = $_GET['p_id'];
        $query = "DELETE FROM comments WHERE comment_id = {$delete_id}";
        $delete_query = mysqli_query($conn, $query);
        confirm($delete_query);
        $query2 = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = '{$comment_post_id}'";
        $update_comment_count = mysqli_query($conn, $query2);
        confirm($update_comment_count);
        header("Location:comments.php");
    }
    if (isset($_GET['approved'])) {
        $comment_changed_id = $_GET['approved'];
        $status = "Approved";
        $query_update_status = "UPDATE comments SET comment_status = '{$status}' WHERE comment_id = '{$comment_changed_id}'";
        $update_status = mysqli_query($conn, $query_update_status);
    }
    if (isset($_GET['unapproved'])) {
        $comment_changed_id = $_GET['unapproved'];
        $status = "Unapproved";
        $query_update_status = "UPDATE comments SET comment_status = '{$status}' WHERE comment_id = '{$comment_changed_id}'";
        $update_status = mysqli_query($conn, $query_update_status);
    }
?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Comment id</th>
            <th>Post id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Content</th>
            <th>Status</th>
            <th>In responce to</th>
            <th>Date</th>        
        </tr>
    </thead>
    <tbody>
    <?php
        $query = "SELECT * FROM comments ORDER BY comment_id DESC";
        $select_all_comments = mysqli_query($conn, $query);
        if ($select_all_comments) {
            while ($row = mysqli_fetch_assoc($select_all_comments)) {
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $query2 = "SELECT * FROM posts WHERE post_id = '{$comment_post_id}'";
                $get_post_title = mysqli_query($conn, $query2);
                if ($get_post_title) {
                    if ($row2 = mysqli_fetch_assoc($get_post_title)) {
                        $post_title = $row2['post_title'];
                    }
                }
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                $comment_date = date("d/m/Y", strtotime($row['comment_date']));
                echo "<tr>";
                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_post_id}</td>";  
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_content}</td>";    
                echo "<td>{$comment_status}</td>";
                echo "<td><a href='../post.php?p_id={$comment_post_id}'</a>$post_title</td>";
                echo "<td>{$comment_date}</td>";
                if ($comment_status == "Unapproved") {
                    echo "<td><a href='comments.php?approved={$comment_id}'</a>Approved</td>";
                    echo "<td>Unapproved</td>";
                }else if ($comment_status == "Approved") {
                    echo "<td>Approved</td>";
                    echo "<td><a href='comments.php?unapproved={$comment_id}'</a>Unapproved</td>";
                }
                echo "<td><a href='comments.php?delete={$comment_id}&p_id={$comment_post_id}'</a>Delete</td>";
                echo "</tr>";                              
            }
        }
    ?>
    </tbody>                          
</table>