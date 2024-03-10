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
                    // echo "No Datra";
                    if($_SERVER['REQUEST_METHOD'] == "POST") {
                        $Value = $_POST["SearchValue"];
                        // echo $Value;
                       
                        
                        $SearchQuery = "select * from posts where post_tags Like '%$Value%' ";
                        $SearchRes = mysqli_query($con,$SearchQuery);
                
                        $count = mysqli_num_rows($SearchRes);
                        // echo $count;
                        
                        if($count>0) {
                            
                    
                            $query = "select * from posts where post_tags Like '%$Value%'";
                            
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
                        <img class="img-responsive" src="images/<?php echo $post_img;?>" alt="" style="height:100%;width:100%;">
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
                        <hr>
        
        
                <?php        
                                
                    }
                }else {
                    echo "No Data";
                }

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