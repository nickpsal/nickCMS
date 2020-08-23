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
                            <small>Categories</small>
                        </h1>
                        <div class = "col-xs-6"> 
                            <!-- Start Add category form -->     
                            <?php insert_categories(); ?>
                            <!-- End Add category form -->   
                            <!-- Start Update Category form -->
                            <?php show_update_delete_cat(); ?>
                            <!-- Category List and Update and Delete Finish -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    <?php include "includes/admin_footer.php"; ?>