<?php 
    include "includes/header.php";
    include "functions.php";
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
                                Welcome to Admin <br>
                                <small>Author</small>
                            </h1>
                        </div>
                        

                        <?php 
                            
                            if(isset($_GET['source'])) {
                                $source = $_GET['source'];
                                
                            }else {
                                $source = "";
                            }

                            switch($source) {

                                case 'add_posts':
                                    include 'includes/add_posts.php';
                                    break;
                                case 'edit_posts':
                                    include 'includes/edit_post.php';
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

<?php 

    include "includes/footer.php";
?>
