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
                    include "includes/connection.php";
                    
                    $query = "select * from posts";
                    
                    $Post_data = mysqli_query($con,$query);
                    $Post_count = 0;

                    while($row = mysqli_fetch_assoc($Post_data)) {
                        $post_Id = $row['post_id'];
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_img = $row["post_image"];
                        $post_content = substr($row["post_content"],0,100);
                        $post_status = $row['post_status'];

                        if($post_status=="published") {

                            $Post_count+=1;
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?postId=<?php echo $post_Id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <div class="text-center">
                    <a href="post.php?postId=<?php echo $post_Id; ?>"><img class="rounded" src="images/<?php echo $post_img;?>" alt="" width="200px"; height="200px";></a>
                </div>
                
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?postId=<?php echo $post_Id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


                <?php        
                        } 
                    }
                    if($Post_count==0) {
                ?>
                    <div class="text-center">
                        <img src="images/no_data.png" alt="No Data Found">
                    </div>
                    
                <?php        
                        
                    }

                ?>
                
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