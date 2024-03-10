<?php 

    include "../includes/connection.php";

    if(isset($_POST['create_user'])) {

        $user_name = $_POST['user_name'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        $user_password = $_POST['user_password'];
        // $user_image = $_FILES['image']['name'];
        // $user_tempImage = $_FILES['image']['tmp_name'];
        $user_date = date('d-m-y');

        // move_uploaded_file($user_tempImage,"../images/$user_image");

        $insertUserQuery = "insert into users (user_name,user_password,user_firtsName,user_lastName,user_email,user_role,user_date) 
                            values ('{$user_name}',$user_password,'{$first_name}','{$last_name}','{$user_email}','{$user_role}',current_date())";

       
        $InsertUserRes = mysqli_query($con,$insertUserQuery);
        header("Location:Users.php");

        if(!$InsertUserRes) {
            echo "Query Failed ".mysqli_error($con);
        }



    }

?>





<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_name">User Name</label>
        <input type="text" class="form-control" name="user_name">
    </div>

    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" name="first_name">
    </div>

    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" name="last_name">
    </div>

    <div class="form-group">
        <label for="user_role">Role </label>&nbsp;&nbsp;&nbsp;&nbsp;
        <select name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div> 

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file"  name="image">
    </div>

    <div class="form-group">
        <label for="user_email">Email Address</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>


    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Add User" name="create_user">
    </div>

    
</form> 