<?php 
    include "includes/header.php";
?>
    <div id="wrapper">

    

        <!-- Navigation -->
        <?php 
            include "includes/navigation.php";
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h1 class="page-header">
                                Welcome to admin <br>
                                <small><?php echo $_SESSION['user_name']; ?></small>
                            </h1>
                        </div>
                       
                    </div>
                </div>
                <!-- /.row -->
                       
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 

                                            include "../includes/connection.php";

                                            $postCountQuery = "select * from posts";
                                            $postCountRes = mysqli_query($con,$postCountQuery);
                                            $postCount = mysqli_num_rows($postCountRes);

                                            $draftPostCountQuery = "select * from posts where post_status != 'published'";
                                            $draftPostCountRes = mysqli_query($con,$draftPostCountQuery);
                                            $draftPostCount = mysqli_num_rows($draftPostCountRes);

                                            $publishedPostCountQuery = "select * from posts where post_status = 'published'";
                                            $publishedPostCountRes = mysqli_query($con,$publishedPostCountQuery);
                                            $publishedPostCount = mysqli_num_rows($publishedPostCountRes);

                                        ?>
                                    <div class='huge'><?php echo $postCount; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            $commentCountQuery = "select * from comments";
                                            $commentCountRes = mysqli_query($con,$commentCountQuery);
                                            $commentCount = mysqli_num_rows($commentCountRes);

                                            $UnapprovedCommentCountQuery = "select * from comments where comment_status !='Approved'";
                                            $UnapprovedCommentCountRes = mysqli_query($con,$UnapprovedCommentCountQuery);
                                            $UnapprovedCommentCount = mysqli_num_rows($UnapprovedCommentCountRes);
                                        ?>
                                        <div class='huge'><?php echo $commentCount; ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            $UsersCountQuery = "select * from users";
                                            $usersCountRes = mysqli_query($con,$UsersCountQuery);
                                            $usersCount = mysqli_num_rows($usersCountRes);

                                            $UnUsersCountQuery = "select * from users where user_role !='Admin'";
                                            $UnUsersCountRes = mysqli_query($con,$UnUsersCountQuery);
                                            $UnUsersCount = mysqli_num_rows($UnUsersCountRes);
                                        ?>
                                        <div class='huge'><?php echo $usersCount; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            $categoriesCountQuery = "select * from category";
                                            $categoriesCountRes = mysqli_query($con,$categoriesCountQuery);
                                            $categoriesCount = mysqli_num_rows($categoriesCountRes);
                                        ?>
                                        <div class='huge'><?php echo $categoriesCount; ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php 
                                $elements = ['All Posts','Draft Posts','Pubilshed Posts','Comments','Unapproved Comments','Users','Subscribers','Categories'];
                                $elementCount = [$postCount,$draftPostCount,$publishedPostCount,$commentCount,$UnapprovedCommentCount,$usersCount,$UnUsersCount,$categoriesCount];

                                for($i=0;$i<8;$i++) {
                                    echo "['{$elements[$i]}'".","."{$elementCount[$i]}],";
                                }
                            
                            ?>
                            
                            
                            ]);

                            var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php 

    include "includes/footer.php";
?>
