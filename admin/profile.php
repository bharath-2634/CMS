<?php 
    include "includes/header.php";
    include "functions.php";
?>

<?php 
    
    if(isset($_SESSION['userId'])) {
         
       $UserID = $_SESSION['userId'];
       
       $UserQuery = "select * from users where user_id = $UserID";
       $UserRes = mysqli_query($con,$UserQuery);

       while($row = mysqli_fetch_assoc($UserRes)) {

            $user_id  = $row["user_id"];
            $user_name = $row["user_name"];
            $user_password = $row["user_password"];
            $user_firtsName = $row["user_firtsName"];
            $user_lastName= $row["user_lastName"];
            $user_email = $row["user_email"];
            // $user_image = $row["user_image"];
            $user_role = $row["user_role"];
            $user_randSalt = $row["user_randSalt"];
            $user_date = $row["user_date"];
       }



    }

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
                    <div class="text-center">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Welcome to Users <br>
                                <small><?php echo $user_name; ?></small>
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <form action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="user_name">User Name</label>
                            <input type="text" class="form-control" name="user_name" value=<?php echo $user_name; ?>>
                        </div>

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" value=<?php echo $user_firtsName; ?>>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value=<?php echo $user_lastName; ?>>
                        </div>

                        <div class="form-group">
                            <label for="user_role">Role </label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <select name="user_role" id="">
                                <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                                <?php 

                                    if($user_role=="Admin") {
                                        echo "<option value='Subscriber'>Subscriber</option>";
                                    }else if($user_role=="Subscriber") {
                                        echo "<option value='Admin'>Admin</option>";
                                    }

                                ?>
                                
                            </select>
                        </div> 

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file"  name="image">
                        </div>

                        <div class="form-group">
                            <label for="user_email">Email Address</label>
                            <input type="email" class="form-control" name="user_email" value=<?php echo $user_email; ?>>
                        </div>

                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" class="form-control" name="user_password" value=<?php echo $user_password; ?>>
                        </div>


                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update Profile " name="updateProfile">
                        </div>

    
                </form> 

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php 

            if(isset($_POST['updateProfile'])) {

                $user_name = $_POST['user_name'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $user_email = $_POST['user_email'];
                $user_role = $_POST['user_role'];
                $user_password = $_POST['user_password'];
                // $user_image = $_FILES['image']['name'];
                // $user_tempImage = $_FILES['image']['tmp_name'];
                $user_date = date('d-m-y');

                $updateQuery = "update users set user_name = '{$user_name}' ,user_password = {$user_password} ,user_firtsName = '{$first_name}' ,user_lastName = '{$last_name}' ,user_email = '{$user_email}' ,user_role = '{$user_role}' ,user_date = current_date() where user_id = {$user_id}";
                $updateRes = mysqli_query($con,$updateQuery);

                header("Location: profile.php");
            }
        
        ?>

<?php 

    include "includes/footer.php";
?>
