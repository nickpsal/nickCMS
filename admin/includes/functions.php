<?php
    function confirm($result) {
        global $conn;
        if (!$result) {
            die("Query Failed " . mysqli_error($conn));
        }
    }

    function insert_categories(){
        global $conn;
        if(isset($_POST['submit'])) {
            $cat_title = $_POST['cat_title'];
            if ($cat_title == "" || empty($cat_title)) {
                echo "This field cant be empty";
            }else {
            $query = "INSERT INTO categories(cat_title) VALUES ('{$cat_title}')";
                $create_category_query = mysqli_query($conn, $query);
                confirm($create_category_query);
            }
        }
        echo "<form action='' method='post'>";
            echo "<label for='cat_title' class='for'>Add Category</label>";
            echo "<div class='form-group'>";
                echo "<input type='text' class = 'form-control' name = 'cat_title'>";
            echo "</div>";
            echo "<div class='form-group'>";
                echo "<input class = 'btn btn-primary' type = 'submit' name = 'submit' value = 'Add Category'>";
            echo "</div>";
        echo "</form>";
    } 

    function show_update_delete_cat() {
        global $conn;
        if (isset($_GET['updateid']) && isset($_GET['updatetitle'])) {
            include "includes/update_category.php";
        }
        ?>
        </div>
        <!-- Category List and Update and Delete Start -->
        <div class = "col-xs-6"> 
            <label for="cat_title" class="for">Categories</label>
                <table class = "table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <th>Category Id</th>
                            <th>Category Name</th>
                        </tr>
                        <?php //find all categories query
                            $query = "SELECT * FROM categories ORDER BY cat_id";
                            $select_all_categories = mysqli_query($conn, $query);
                            if ($select_all_categories) {
                                while ($row = mysqli_fetch_assoc($select_all_categories)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    echo "<tr>";
                                    echo "<td>{$cat_id}</td>";
                                    echo "<td><a href= 'categories.php?updateid={$cat_id}&updatetitle={$cat_title}'>$cat_title</td>";  
                                    echo "<td><a href= 'categories.php?delete={$cat_id}'>Delete</td>";
                                    echo "</tr>";                              
                                }
                            }else {
                                echo "<H1>No categories Found</H1>";
                            }
                            if (isset($_GET['delete'])){
                                $delete_cat_id = $_GET['delete'];
                                $query = "DELETE FROM categories WHERE cat_id = {$delete_cat_id}";
                                $delete_query = mysqli_query($conn, $query);
                                header("Location:categories.php");
                            }        
                    echo "</tbody>";
                echo "</table>";
                echo "<center>Categories Sum	 " . mysqli_num_rows($select_all_categories) . "</center>";
    }
?>