<?php 

    include "../includes/connection.php";

    if(isset($_POST['create_post'])) {

        $post_title = $_POST['title'];
        $post_catId = $_POST['cat_id'];
        if($post_catId=='none') {
            $post_catId = 0;
        }
        $post_author = $_POST['author'];
        $post_status = $_POST['status'];
        $post_image = $_FILES['image']['name'];
        $post_tempImage = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['tags'];
        $post_content = $_POST['content'];
        $post_date = date('d-m-y');
        $post_comment_count = 0;

        move_uploaded_file($post_tempImage,"../images/$post_image");

        $insertQuery = "insert into posts (post_categoryid,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) 
                        values ('$post_catId','$post_title','$post_author',current_date(),'$post_image','$post_content','$post_tags','$post_comment_count','$post_status')";
    
        $res = mysqli_query($con,$insertQuery);

        if(!$res) {
            echo "Query Failed ".mysqli_error($con);
        }

        header("Location:posts.php");



    }

?>





<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="cat_id">Post Category </label>&nbsp;&nbsp;&nbsp;&nbsp;
        <select name="cat_id" id="">
            <option value="none">Select Category</option>
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
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label><br>
        <!-- <input type="text" class="form-control" name="status"> -->
        <select name="status" id="">
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file"  name="image">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea name="content" id="body" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Publish Post" name="create_post">
    </div>

    
</form> 