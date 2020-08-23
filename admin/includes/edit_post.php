<?php
    if (isset($_GET['action']) && isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
        $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
        $find_post = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($find_post)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_cat_id = $row['post_cat_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comments = $row['post_comment_count'];
            $post_date = $row['post_date'];
        }
    }

    if (isset($_POST['update_post'])){
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['category'];
        $post_status = $_POST['post_status'];
        $new_post_image = $_FILES['image']['name'];
        $new_post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = $_POST['post_date'];
        $post_comment_count = 0;
        if (!empty($new_post_image)) {
            $path = "../images/" . $post_author;
            move_uploaded_file($new_post_image_temp, "$path/$new_post_image");
            $query = "UPDATE posts SET post_cat_id='{$post_category_id}' ,post_title='{$post_title}',post_author='{$post_author}', post_date='{$post_date}', post_image='{$new_post_image}' ,post_content='{$post_content}', post_tags='{$post_tags}', post_status='{$post_status}' WHERE post_id = '{$post_id}'";
            $create_post_query = mysqli_query($conn, $query);
        }else {
            $query = "UPDATE posts SET post_cat_id='{$post_category_id}' ,post_title='{$post_title}',post_author='{$post_author}', post_date='{$post_date}', post_content='{$post_content}', post_tags='{$post_tags}', post_status='{$post_status}' WHERE post_id = '{$post_id}'";
            $create_post_query = mysqli_query($conn, $query);
        }
        if (confirm($create_post_query)) {
            header("Location:posts.php");
        }
    }else if (isset($_POST['close'])) {
        header("Location:posts.php");
    }
?>
<H1 class="page-header">Add Post</H1>
<form action="" method="post" enctype="multipart/form-data">
    <div class='form-group'>
        <input class = 'btn btn-primary' type = 'submit' name = 'update_post' value = 'Update Post'>
        <input class = 'btn btn-primary' type = 'submit' name = 'close' value = 'Close'>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Title</label>
        <input type="text" class="form-control" name="post_title" value = "<?php echo $post_title ?>" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Category</label>
        <select name="category" id="category-select2">
            <?php
                echo "<option value=''>--Select Category Post--</option>";
                $get_cat_query = "SELECT * FROM categories";
                $get_cat = mysqli_query($conn, $get_cat_query);
                while($row = mysqli_fetch_assoc($get_cat)) {
                    $category_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    if ($post_cat_id == $category_id) {
                        echo "<option selected value='{$category_id}'>$cat_title</option>";
                    }else {
                        echo "<option value='{$category_id}'>$cat_title</option>";
                    }
                }
            ?>
        </select>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Author</label>
        <input type="text" class="form-control" name="post_author" value = "<?php echo $post_author ?>" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Status</label>
        <input type="text" class="form-control" name="post_status" value = "<?php echo $post_status ?>" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Image</label>
        <img src="../images/<?php echo $post_author . "/" . $post_image; ?>" width="300">
        <input type="file" name="image">
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value = "<?php echo $post_tags ?>" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10" required>
        <?php echo $post_content?>
        </textarea>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Date</label>
        <input type="date" id="post_date" name="post_date" value = <?php echo $post_date; ?> required>
        <br>;
    </div>
    <div class='form-group'>
        <input class = 'btn btn-primary' type = 'submit' name = 'update_post' value = 'Update Post'>
        <input class = 'btn btn-primary' type = 'submit' name = 'close' value = 'Close'>
    </div>
</form>
