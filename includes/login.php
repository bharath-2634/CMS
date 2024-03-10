<?php 
    include "connection.php";
    session_start();

    if(isset($_POST['login'])) {
        
        $login_UserName = $_POST['loginUserName'];
        $login_UserPassword = $_POST['loginUserPassword'];

        $login_UserName = mysqli_real_escape_string($con,$login_UserName);
        $login_UserPassword = mysqli_real_escape_string($con,$login_UserPassword);


        $loginQuery = "select * from users where user_name = '$login_UserName' AND user_password = '$login_UserPassword'";
        $loginRes = mysqli_query($con,$loginQuery);
        $login_Id = "";

        while($row = mysqli_fetch_assoc($loginRes)) {
            $login_Id = $row['user_id'];
            // echo $login_Id;
        }

        if($login_Id=="") {
            echo $login_Id;
            header("Location:../index.php");
            
        }else {
            $loginUserQuery = "select * from users where user_id = $login_Id";
            $loginUserRes = mysqli_query($con,$loginUserQuery);

            while($row = mysqli_fetch_assoc($loginUserRes)) {
                $userId = $row['user_id'];
                $userName = $row['user_name'];
                $userPassword = $row['user_password'];
                $userFirstName = $row['user_firtsName'];
                $userLastName = $row['user_lastName'];
                $userEmail = $row['user_email'];
                $userDate = $row['user_date'];
                $userRole = $row['user_role'];

            }

            $_SESSION['userId'] = $userId;
            $_SESSION['user_name'] = $userName;
            // $_SESSION['user_password'] = $login_Id;
            $_SESSION['user_firtsName'] = $userFirstName;
            $_SESSION['user_lastName'] = $userLastName;
            // $_SESSION['user_email'] = $login_Id;
            $_SESSION['user_role'] = $userRole;
            header("Location: ../admin/");
        }

    }
?>

