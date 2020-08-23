<?php 
    include "includes/db.php";
    global $conn;
    include "includes/header.php";
?>

<!-- Navigation -->
<?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <?php include "includes/content.php";?>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>

        </div>
        <!-- /.row -->
        <?php include "includes/footer.php";?>