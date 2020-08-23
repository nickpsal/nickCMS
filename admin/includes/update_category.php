<form action="" method="post">
    <?php 
        $cat_name = "";
        $cat_id = $_GET['updateid'];
        $cat_name = $_GET['updatetitle'];    
    ?>
        <label for="cat_title" class="for">Update Category</label>
        <div class="form-group">
            <?php
                if (isset($_POST['update'])) {
                    $update_cat_title = $_POST['update_cat_title'];
                    $update_query = "UPDATE categories SET cat_title ='{$update_cat_title}' WHERE cat_id = '{$cat_id}'";
                    $update_query = mysqli_query($conn, $update_query);
                    if (!$update_query) {
                        die("Query Failed" . mysqli_error($conn));
                    }else {
                        $cat_name = "";
                        header("Location:categories.php");
                    }
                }else if (isset($_POST['close'])) {
                    header("Location:categories.php");
                }
            ?>
            <input value="<?php echo $cat_name;?>" type="text" class = "form-control" name = "update_cat_title">
        </div>
        <div class="form-group">
            <input class = "btn btn-primary" type = "submit" name = "update" value = "Update Category">
            <input class = "btn btn-primary" type = "submit" name = "close" value = "Close">
         </div>
</form>