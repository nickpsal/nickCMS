<div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method = "post"> <!-- start search form -->
                    <div class="input-group">
                        <input name = "search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" name = "submit" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form> <!-- end search form -->
                    <!-- /.input-group -->
                </div>
                <!-- Blog Login Well -->
                <div class="well">
                    <h4>Login Form</h4>
                    <form action="includes/login.php" method = "post"> <!-- start search form -->
                    <div class="form-group">
                        <input name = "username" type="text" class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="input-group">
                        <input name = "password" type="password" class="form-control" placeholder="Enter Password">
                        <span class = "input-group-btn">
                            <button class = "btn btn-primary" name="login" type="submit">Submit</button>
                        </span>
                    </div>
                    </form> <!-- end search form -->
                    <!-- /.input-group -->
                </div>
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                        <?php
                            $query = "SELECT * FROM categories LIMIT 4";
                            $select_all_categories_sidebar_query = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($select_all_categories_sidebar_query)) {
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                                echo "<ul class='list-unstyled'>";
                                echo "<li><a href='category.php?category={$cat_id}'>$cat_title</a></li>";                                
                            }
                            echo "</ul>";
                        ?>
                        </div>
                    </div>
                </div>
                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>
            </div>