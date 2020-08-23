<?php 
    include "includes/admin_header.php"; 
    include "includes/functions.php";
?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $title; ?>
                            <small>Post's</small>
                        </h1>
                        <?php
                            if (isset($_GET['action'])) {
                                $action = $_GET['action'];
                            }else {
                                $action = "";
                            }
                            switch ($action) {
                                case 'add_post':
                                    include "includes/add_post.php";
                                    break;
                                case 'view_all_posts':
                                    include "includes/view_all_posts.php";
                                    break;
                                case 'edit_post':
                                    include "includes/edit_post.php";
                                    break;
                                default:
                                    include "includes/view_all_posts.php";
                                    break;
                            }
                        ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    <?php include "includes/admin_footer.php"; ?>