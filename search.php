<?php
    include "includes/header.php";
    include "includes/db.php";
    global $conn;
?>

<!-- Navigation -->
<?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    CUSTOM PHP BLOG
                    <small>ΑΝΑΖΗΤΗΣΗ</small>
                </h1>
                <!-- First Blog Post -->
                <?php
                    if (isset($_POST['submit'])) {
                        $search =  $_POST['search'];
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                        $search_query = mysqli_query($conn, $query);
                        if (!$search_query) {
                            die("Query Failed" . mysqli_error($conn));
                        }
                        $count = mysqli_num_rows($search_query);
                        if ($count == 0) {
                            echo "<H1>Δεν βρεθηκε</H1>";
                        }else {
                            echo "<H1>ΒΡΕΘΗΚΑΝ " . $count . " ΑΡΘΡΑ </H1>";
                            while ($row = mysqli_fetch_assoc($search_query)) {
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = date("d/m/Y", strtotime($row['post_date'])); 
                                $post_image = $row['post_image'];
                                $post_image = "images/" . $post_image;
                                $post_content = $row['post_content'];
                                echo "<h2><a href='#'>$post_title</a></h2>";
                                echo "<p class='lead'>by <a href='#'>$post_author</a></p>";
                                echo "<p><span class='glyphicon glyphicon-time'></span>$post_date</p>";
                                echo "<hr><img class='img-responsive' src='$post_image' alt=''><hr>";
                                echo "<p>$post_content</p>";
                                echo "<a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>";
                            }
                        }
                    }
                ?>
                <hr>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>

        </div>
        <!-- /.row -->
        <?php include "includes/footer.php";?>