<?php
    if (isset($_POST['create_post'])){
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = $_POST['post_date'];
        $post_comment_count = 0;
        $path = "../images/" . $post_author;
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        move_uploaded_file($post_image_temp, "$path/$post_image");
        $query = "INSERT INTO posts (post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)";
        $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', '{$post_date}', '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}')";
        $create_post_query = mysqli_query($conn, $query);
        confirm($create_post_query);
        header("Location:posts.php");
    }
?>
<H1 class="page-header">Add Post</H1>
<form action="" method="post" enctype="multipart/form-data">
    <div class='form-group'>
        <label for="title" class="for">Post Title</label>
        <input type="text" class="form-control" name="post_title" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Category</label>
        <select name="post_category" id="category-select">
            <?php
                echo "<option value=''>--Select Category Post--</option>";
                $get_cat_query = "SELECT * FROM categories";
                $get_cat = mysqli_query($conn, $get_cat_query);
                while($row = mysqli_fetch_assoc($get_cat)) {
                    $post_category_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$post_category_id}'>$cat_title</option>";
                }
            ?>
        </select>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Author</label>
        <input type="text" class="form-control" name="post_author" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Status</label>
        <input type="text" class="form-control" name="post_status" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" required>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10" required>
        </textarea>
    </div>
    <div class='form-group'>
        <label for="title" class="for">Post Date</label>
        <input type="date" id="post_date" name="post_date" required>
    </div>
    <div class='form-group'>
        <input class = 'btn btn-primary' type = 'submit' name = 'create_post' value = 'Add Post'>
        <input class = 'btn btn-primary' type = 'submit' name = 'clear' value = 'Clear'>
    </div>
</form>
