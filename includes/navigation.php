<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.php">CMS Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php 
                    include "includes/connection.php";
                    $query = "select * from category";
                    $res = mysqli_query($con,$query);

                    while ($row = mysqli_fetch_assoc($res)) {
                        $catID = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='category.php?category=$catID'>{$cat_title}</a></li>";
                    }
                
                ?>

                    <li>
                        <a href="admin/index.php">Admin</a>
                    </li>
                    <?php 
                        session_start();
                        if(isset($_SESSION['user_name'])) {
                            
                            if(isset($_GET['postId'])) {
                               $postId = $_GET['postId'];
                                echo "
                                    <li>
                                        <a href='./admin/posts.php?source=edit_posts&p_id=$postId'>Edit Post</a>
                                    </li>";
                            }
                        }

                    
                    
                    ?>
                    
                    <!-- <li>
                        <a href="#">Contact</a>
                    </li> -->

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>