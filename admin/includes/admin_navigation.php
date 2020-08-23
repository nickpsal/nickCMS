<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">phpCMS Admin</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li><a href='../index.php'>Site Preview</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                    <li>
                        <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                    </li>
                </ul>
            </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="index.php"><i class="fa fa-home"></i>Dashboard</a>
                    </li>
                <li>
                    <a href="categories.php"><i class="fa fa-newspaper-o"></i>Catogories</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-newspaper-o fa-arrows-v"></i>Posts<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="posts_dropdown" class="collapse">
                        <li>
                            <a href="posts.php?action=add_post">Add new Post</a>
                        </li>
                        <li>
                            <a href="posts.php">View All Posts</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="comments.php"><i class="fa fa-comments-o"></i>Comments</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-users"></i>Users<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="users_dropdown" class="collapse">
                        <li>
                            <a href="add_user.php">Add new User</a>
                        </li>
                        <li>
                            <a href="users.php">Users</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="index-rtl.html"><i class="fa fa-users"></i>Profile</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
</nav>