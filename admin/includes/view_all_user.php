<table class="table table-bordered table-hover" >
    <thead>
        <tr>
            <th>Id</th>
            <th>User Name</th>
            <th>First Name</th>
            <th>last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>date</th>
            <th>Approve</th>
            <th>Disapprove</th>
            <th>update</th>
            <th>delete</th>
            
        </tr>
    </thead>
    <tbody>

            <?php 


                $con = mysqli_connect('localhost','root','','cms');

                $query = "select * from users";
                $Postres = mysqli_query($con,$query);
                                
                while($row = mysqli_fetch_assoc($Postres)) {

                    $user_id  = $row["user_id"];
                    $user_name = $row["user_name"];
                    $user_password = $row["user_password"];
                    $user_firtsName = $row["user_firtsName"];
                    $user_lastName= $row["user_lastName"];
                    $user_email = $row["user_email"];
                    $user_image = $row["user_image"];
                    $user_role = $row["user_role"];
                    $user_randSalt = $row["user_randSalt"];
                    $user_date = $row["user_date"];
                    
                    echo "<tr>";
                    echo "<td>$user_id</td>";
                    echo "<td>$user_name</td>";
                    echo "<td>$user_firtsName</td>";
                    echo "<td>$user_lastName</td>";
                    echo "<td>$user_email</td>";
                    echo "<td>$user_role</td>";
                    echo "<td>$user_date</td>";
                    echo "<td><a href='Users.php?Admin={$user_id}'>Admin</a></td>";
                    echo "<td><a href='Users.php?Subscriber={$user_id}'>Subscriber</a></td>";
                    echo "<td><a href='Users.php?source=edit_user&u_id={$user_id}'>Update</a></td>";
                    echo "<td><a href='Users.php?deleteUsers={$user_id}'>Delete</a></td>";
                    echo "</tr>";


                }

                            
                            
                            
            ?>
                                
                                    
                                    
                                
    </tbody>
</table>


<?php 

    include "../includes/connection.php";

    if(isset($_GET['Admin'])) {

        $UserId = $_GET['Admin'];

        $delQuery = "update users set user_role = 'Admin' where user_id=$UserId";
        $delRes = mysqli_query($con,$delQuery);
        header("Location:Users.php");

        if(!$delRes) {
            echo "Query Failed ".mysqli_error($con);
        }

    }

    if(isset($_GET['Subscriber'])) {

        $UserId = $_GET['Subscriber'];

        $delQuery = "update users set user_role='Subscriber' where user_id=$UserId";
        $delRes = mysqli_query($con,$delQuery);
        header("Location:Users.php");

        if(!$delRes) {
            echo "Query Failed ".mysqli_error($con);
        }

    }

    if(isset($_GET['deleteUsers'])) {

        $CommentId = $_GET['deleteUsers'];

        $delQuery = "delete from users where user_id = {$CommentId}";
        $delRes = mysqli_query($con,$delQuery);
        header("Location:Users.php");

        if(!$delRes) {
            echo "Query Failed ".mysqli_error($con);
        }

    }

?>
