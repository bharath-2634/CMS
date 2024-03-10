<?php 
    include "includes/header.php";
?>

    <!-- Navigation -->
<?php 
    include "includes/navigation.php";
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php 
                    
                    if(isset($_GET['postId'])) {
                        $postID = $_GET['postId'];
                    }
                    include "includes/connection.php";
                    
                    $query = "select * from posts where post_id = $postID";
                    
                    $Post_data = mysqli_query($con,$query);

                    while($row = mysqli_fetch_assoc($Post_data)) {
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_img = $row["post_image"];
                        $post_content = $row["post_content"];
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <div class="text-center">
                    <img class="rounded" src="images/<?php echo $post_img;?>" alt="" width="200px"; height="200px";>
                </div>
                
                <hr>
                <p><?php echo $post_content ?></p>
                <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>


                <?php        
                        
                    }

                ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POST">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" class="form-control" name="Author">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" name="email">
                        </div>

                        <div class="form-group">
                            <label for="content">Comment Box</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 

                    if(isset($_POST['create_comment'])) {
                        $commentPostId = $_GET['postId'];
                        $commentAuthor = $_POST['Author'];
                        $commentEmail = $_POST['email'];
                        $commentContent = $_POST['content'];

                        $commentQuery = "insert into comments (comment_postId,comment_author,comment_email,comment_content,comment_status,comment_date) 
                                        values ({$commentPostId},'{$commentAuthor}','{$commentEmail}','{$commentContent}','unapproved',current_date())";
                        $commentRes = mysqli_query($con,$commentQuery);

                        $commentCountQuery = "update posts set post_comment_count = post_comment_count+1 where post_id = $commentPostId";
                        $countRes = mysqli_query($con,$commentCountQuery);

                        if(!$countRes) {
                            echo "Failed Due to ".mysqli_error($con);
                        }

                        if(!$commentRes) {
                            echo "Sorry There is a technical Issue ".mysqli_error($con);
                        }

                    }
                
                ?>

                <!-- Comment -->
                <?php 
                    $CommentPostId = $_GET['postId'];
                    $displayComment = "select * from comments where comment_postId = $CommentPostId and comment_status = 'Approved' order by comment_date desc";
                    $displayCommentRes = mysqli_query($con,$displayComment);
                    

                    while($row = mysqli_fetch_assoc($displayCommentRes)) {
                        
                        $comAuthor = $row['comment_author'];
                        $comDate = $row['comment_date'];
                        $comContent = $row['comment_content'];
                ?>
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="images/comment_box.jpg" alt="" width="100px" height="100px">
                        </a>
                        <div class="media-body">
                            <br>
                            <h4 class="media-heading"><?php echo $comAuthor; ?>
                                <small><?php echo $comDate; ?></small>
                            </h4>
                            <p><?php echo $comContent; ?></p>
                            
                        </div>
                    </div>
                <?php        
                    }

                    
                
                ?>
                

                <!-- Comment -->

               
                
                <!-- Second Blog Post -->
                

                <!-- Third Blog Post -->
                

                <!-- Pager -->
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php  include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php 

    include "includes/footer.php";

?>