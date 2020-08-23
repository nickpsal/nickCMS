<?php 
    include "includes/db.php";
    global $conn;
    include "includes/header.php";
    if (isset($_GET['p_id'])){
        $post_id = $_GET['p_id'];
    }
    if (isset($_POST['submit'])) {
        $comment_post_id = $post_id;
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment = $_POST['comment'];
        $comment_status = "Unapproved";
        $comment_date = date("Y/m/d");
        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
        $query .= "VALUES ({$comment_post_id}, '{$comment_author}', '{$comment_email}', '{$comment}', '{$comment_status}', '{$comment_date}')";
        $create_comment_query = mysqli_query($conn, $query);
        $query2 = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = '{$post_id}'";
        $update_comment_count = mysqli_query($conn, $query2);
    }
?>
<?php include "includes/navigation.php";?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
                <?php
                    $query = "SELECT * FROM posts WHERE post_id = '{$post_id}'";
                    $select_all_posts_query = mysqli_query($conn, $query);
                    if ($select_all_posts_query) {
                        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = date("d/m/Y", strtotime($row['post_date'])); 
                            $post_image = $row['post_image'];
                            $post_image = "images/" . $post_author . "/" . $post_image;
                            $post_content = $row['post_content'];
                            echo "<h2>$post_title</h2>";
                            echo "<p class='lead'>by <a href='#'>$post_author</a></p>";
                            echo "<p><span class='glyphicon glyphicon-time'></span>$post_date</p>";
                            echo "<hr><img class='img-responsive' src='$post_image' alt=''><hr>";
                            echo "<p>$post_content</p>";
                        }
                    }
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action='' method='post'>
                        <div class="form-group">
                            <label for="title" class="for">Comment Author</label>
                            <input type="text" class="form-control" name = "comment_author" required/>    
                        </div>
                        <div class="form-group">
                            <label for="title" class="for">Comment Email</label>
                            <input type="email" class="form-control" name = "comment_email" required/>    
                        </div>
                        <div class="form-group">
                            <label for="title" class="for">Comment</label>
                            <textarea class="form-control" rows="3" name = "comment" required></textarea>
                        </div>
                        <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <?php
                    $query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}' AND comment_status = 'approved' ORDER BY comment_id DESC";
                    $show_comments = mysqli_query($conn, $query);
                    if ($show_comments) {
                        if (mysqli_num_rows($show_comments) != 0) {
                            while($row = mysqli_fetch_assoc($show_comments)){
                                $comment_date = date("d/m/Y", strtotime($row['comment_date']));
                                $comment_content = $row['comment_content'];
                                $comment_author = $row['comment_author'];
                                echo "<div class='media'>";
                                    echo "<a class='pull-left' href='#'>";
                                        echo "<img class='media-object' src='http://placehold.it/64x64' alt=''>";
                                    echo "</a>";
                                    echo "<div class='media-body'>";
                                        echo "<h4 class='media-heading'>$comment_author ";
                                            echo "<small>$comment_date</small>";
                                        echo "</h4>";
                                        echo $comment_content;
                                    echo "</div>";
                                echo "</div>";
                            } 
                        }else {
                            echo "No comments in Post";
                        }
                    }else {
                        die("Query failed" . mysqli_error($conn));
                    }
                ?>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
            </div>
        </div>
        <!-- /.row -->
        <?php include "includes/footer.php";?>