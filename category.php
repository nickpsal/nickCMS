<?php 
    include "includes/db.php";
    global $conn;
    include "includes/header.php";
    if (isset($_GET['category'])){
        $category_id = $_GET['category'];
    }
?>
<?php include "includes/navigation.php";?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
            <?php
                $query = "SELECT * FROM posts WHERE post_cat_id = '{$category_id}' ORDER BY post_id DESC";
                $select_all_posts_query = mysqli_query($conn, $query);
                if ($select_all_posts_query) {
                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_id = $row['post_id'];
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
                        $short_content = substr($row['post_content'], 0, 200);
                        echo $short_content;
                        echo "<br>";
                        echo "<a class='btn btn-primary' href='post.php?p_id={$post_id}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>";
                    }
                }
            ?>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
            </div>
        </div>
        <!-- /.row -->
        <?php include "includes/footer.php";?>