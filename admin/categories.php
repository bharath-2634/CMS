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
                        <h1 class="page-header">
                            Welcome to Admin 
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">


                            <?php insertCategories();?>

                            <form action="" method="POST">
                                <label for="categories-title">Add Category</label>
                                <div class="form-group">
                                    <input type="text" class = "form-control" name="categories-title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="insert" value="Add Category">
                                </div>
                            </form>
                            <!-- Editing Form Group -->
                            <form action="" method="POST">

                                    <!-- Updating Category -->
                                <label for="categories-title">Edit  Category</label>
                                    <div class="form-group">
                                    <?php 
                                        $update_id = "";
                                        if(isset($_GET['update'])) {
                                            $update_id = $_GET['update'];
                                            // echo $update_id;
                                            
                                            $query = "select cat_title from category where cat_id = $update_id";

                                            $update_res_start = mysqli_query($con,$query);

                                            while($row = mysqli_fetch_assoc($update_res_start)) {
                                                $cat_name = $row["cat_title"];
                                    ?>
                                    <input type="text" class = "form-control" name="categories-title" value="<?php if(isset($cat_name)) {echo $cat_name;}?>">
                                    <?php            
                                            }
                                        }
                                    ?>
                                
                                    
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Edit Category">
                                </div>

                                <?php 
                                    if(isset($_POST['submit'])) {
                                        $updatedCat = $_POST["categories-title"];
                                        if(empty($updatedCat)) {
                                            echo "Invalid Category";
                                        }
                                        
                                        $updateQuery = "update category set cat_title = '{$updatedCat}' where cat_id = $update_id";
                                        $updated_res = mysqli_query($con,$updateQuery);
                                        header("Location: categories.php");
                                
                                        if(!$updated_res) {
                                            echo "Sorry Some Technical Issue in Updating Category";
                                        }
                                    }
                                ?>
                            </form>
                        </div>

                        <div class="col-xs-6">

                            
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php    
                                            include "../includes/connection.php";

                                            $cat_query = "select * from category";
                                            $cat_res = mysqli_query($con,$cat_query);

                                            while($row = mysqli_fetch_assoc($cat_res)) {
                                                $id = $row["cat_id"];
                                                $data = $row["cat_title"];
                                                echo "<tr>";
                                                echo"<td>{$id}</td>";
                                                echo"<td>{$data}</td>";
                                                echo "<td><a href='categories.php?delete={$id}'>Delete</a></td>";
                                                echo "<td><a href='categories.php?update={$id}'>Update</a></td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                        <!-- Deleting Category -->
                                        <?php 
                                        
                                            if(isset($_GET['delete'])) {
                                                $del_id = $_GET['delete'];

                                                $del_query = "delete  from category where cat_id = $del_id";

                                                $del_res = mysqli_query($con,$del_query);

                                                if($del_res) {
                                                    echo "successfully deleted ";
                                                    header("Location: categories.php");
                                                }
                                            }
                                        ?>
                                        
                                        
                                    </tr>
                                </tbody>
                            </table>

                            
                        </div>

                       
                        
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
