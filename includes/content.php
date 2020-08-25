<div class="col-md-8">
                <h1 class="page-header">
                    phpCMS
                    <small>ΑΡΧΙΚΗ</small>
                </h1>
                <!-- First Blog Post -->
                <?php
                    $query = "SELECT * FROM posts ORDER BY post_id DESC";
                    $select_all_posts_query = mysqli_query($conn, $query);
                    if ($select_all_posts_query) {
                        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = date("d/m/Y", strtotime($row['post_date'])); 
                            $post_image = $row['post_image'];
                            $image = "images/" . $post_author . "/" . $post_image;
                            echo "<h2><a href='post.php?p_id={$post_id}'>$post_title</a></h2>";
                            echo "<p class='lead'>by <a href='#'>$post_author</a></p>";
                            echo "<p><span class='glyphicon glyphicon-time'></span>$post_date</p>";
                            echo "<hr><img class='img-responsive' src='$image' alt=''><hr>";
                            $short_content = substr($row['post_content'], 0, 200);
                            echo $short_content;
                            echo "<br>";
                            echo "<a class='btn btn-primary' href='post.php?p_id={$post_id}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>";
                        }
                    }
                ?>
                <hr>
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
            </div>