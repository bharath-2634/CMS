<?php  

    if(isset($_POST['checkBoxArray'])) {

        foreach($_POST['checkBoxArray'] as $val) {

           $options = $_POST['bulk_options'];

           switch($options) {
                case 'publish':
                    $query = "update posts set post_status = 'published' where post_id = $val";
                    $res = mysqli_query($con,$query);
                    if(!$res) {
                        echo "Query Failed ".mysqli_error($con);
                    }
                    break;
                case 'draft':
                    $query = "update posts set post_status = 'draft' where post_id = $val";
                    $res = mysqli_query($con,$query);
                    if(!$res) {
                        echo "Query Failed ".mysqli_error($con);
                    }
                    break;
                case 'delete':
                    $query = "delete from posts where post_id = $val";
                    $res = mysqli_query($con,$query);
                    if(!$res) {
                        echo "Query Failed ".mysqli_error($con);
                    }
                    break;
                default:
                    break;         
           }
        }
    }


?>


<form action="" method="POST">
    <table class="table table-bordered table-hover">
        <div class="text-center">
            <div id="bulkOptionsContainer" class="col-xs-4 form-group" style="margin-left: 170px; margin-right: -60px">
                <select name="bulk_options" id="options" class="form-group" style="width: 200px; height:30px;">
                    <option value="none">Select Operations</option>
                    <option value="publish">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class="col-xs-4">
                <input type="submit" value="Apply" name="submit" class="btn btn-success">&nbsp;
                <a href="add_posts.php" class="btn btn-primary">Add New</a>
            </div>
        </div>
        
        <thead>
            <tr>
                <th><input type="checkbox" id="select_All"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Images</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>date</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

                <?php 


                    $con = mysqli_connect('localhost','root','','cms');

                    $query = "select * from posts";
                    $Postres = mysqli_query($con,$query);
                                    
                    while($row = mysqli_fetch_assoc($Postres)) {

                        $post_id = $row["post_id"];
                        $post_categoryid = $row["post_categoryid"];
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_image = $row["post_image"];
                        $post_tags = $row["post_tags"];
                        $post_comment_count = $row["post_comment_count"];
                        $post_status = $row["post_status"];
                        $post_user = $row["post_user"];
                        $post_views_count = $row["post_views_count"];

                        $categoryQuery = "select * from category where cat_id = $post_categoryid";
                        $categoryRes = mysqli_query($con,$categoryQuery);

                        while($row = mysqli_fetch_assoc($categoryRes)) {
                            $category = $row['cat_title'];
                        }

                        

                        echo "<tr>";
                ?>        
                        <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value="<?php echo $post_id; ?>"></td>
                <?php        
                        echo "<td>$post_id</td>";
                        echo "<td>$post_author</td>";
                        echo "<td>$post_title</td>";

                        echo "<td>$category</td>";
                        echo "<td>$post_status</td>";
                        echo "<td><img src='../images/$post_image' class='img-responsive' width='100px'></img></td>";
                        echo "<td>$post_tags</td>";
                        echo "<td>$post_comment_count</td>";
                        echo "<td>$post_date</td>";
                        echo "<td><a href='posts.php?source=edit_posts&p_id={$post_id}'>Update</a></td>";
                        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
                        echo "</tr>";


                    }

                                
                                
                                
                ?>
                                    
                                        
                                        
                                    
        </tbody>
    </table>
</form>



<?php 

    include "../includes/connection.php";

    if(isset($_GET['delete'])) {

        $postId = $_GET['delete'];

        $delQuery = "delete from posts where post_id = {$postId}";
        $delRes = mysqli_query($con,$delQuery);

        if($delRes) {
            echo "Query Failed ".mysqli_error($con);
        }

    }

?>
