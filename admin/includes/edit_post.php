<?php 

        $con = mysqli_connect('localhost','root','','cms');
        if(isset($_GET["p_id"])) {
            $edit_id = $_GET["p_id"];
        }
        $Editquery = "select * from posts where post_id = $edit_id";
        $Editres = mysqli_query($con,$Editquery);
                        
        while($row = mysqli_fetch_assoc($Editres)) {

            $post_id = $row["post_id"];
            $post_categoryid = $row["post_categoryid"];
            $post_title = $row["post_title"];
            $post_author = $row["post_author"];
            $post_date = $row["post_date"];
            $post_image = $row["post_image"];
            $post_tags = $row["post_tags"];
            $post_content = $row["post_content"];
            $post_comment_count = $row["post_comment_count"];
            $post_status = $row["post_status"];
            $post_user = $row["post_user"];
            $post_views_count = $row["post_views_count"];

        }






?>


<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title; ?>">
    </div>

    <div class="form-group">
        <label for="cat_id">Post Category </label>&nbsp;&nbsp;&nbsp;&nbsp;
        
        <select name="cat_id" id="">
            <?php 

                include "../includes/connection.php";

                $catQuery = "select * from category";
                $catRes = mysqli_query($con,$catQuery);

                while($row = mysqli_fetch_assoc($catRes)) {
                    $catTitle = $row['cat_title'];
                    $catId = $row['cat_id'];

                    echo "<option value='$catId'>$catTitle</option>";
                }
            
            
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $post_author; ?>">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label><br>
        <!-- <input type="text" class="form-control" name="status" value="<?php echo $post_status; ?>"> -->
        <select name="status" id="">
            <option value="<?php echo $post_status; ?>"><?php echo "$post_status"; ?></option>
            <?php 
                if($post_status=='published') {
                    echo "<option value='draft'>Draft</option>";
                }else {
                    echo "<option value='published'>Publish</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label><br>
        <img src="../images/<?php echo $post_image; ?>" alt="" width="100px"; >
        <input type="file"  name="image">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" value="<?php echo $post_tags; ?>">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea name="content" id="" cols="30" rows="10" class="form-control"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update Post" name="edit_post">
    </div>

    
</form> 


<?php 

    include "../includes/connection.php";

    if(isset($_POST['edit_post'])) {

        $post_title = $_POST['title'];
        $post_catId = $_POST['cat_id'];
        $post_author = $_POST['author'];
        $post_status = $_POST['status'];
        $update_image = $_FILES['image']['name'];
        $update_tempImage = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['tags'];
        $post_content = $_POST['content'];

        

        if(empty($update_image)) {
            $update_image = $post_image;
        }
        move_uploaded_file($update_tempImage,"../images/$update_image");
        $updateQuery = "update posts set post_categoryid = {$post_catId} ,post_title = '{$post_title}' ,post_author = '{$post_author}' ,post_date = current_date() ,post_image = '{$update_image}' ,post_content = '{$post_content}' ,post_tags = '{$post_tags}' ,post_status = '{$post_status}' where post_id = {$edit_id}";

        $updateRes = mysqli_query($con,$updateQuery); 
        
        if($updateRes) {
            echo "<p class='bg-success'>Updated Successfully<a href='../post.php?postId=$edit_id'>View</a></p>";
        }
        
        
    }


?>

