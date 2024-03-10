<table class="table table-bordered table-hover" >
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Approve</th>
            <th>Disapprove</th>
            <th>date</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

            <?php 


                $con = mysqli_connect('localhost','root','','cms');

                $query = "select * from comments";
                $Postres = mysqli_query($con,$query);
                                
                while($row = mysqli_fetch_assoc($Postres)) {

                    $comment_id = $row["comment_id"];
                    $comment_postId = $row["comment_postId"];
                    $comment_author = $row["comment_author"];
                    $comment_email = $row["comment_email"];
                    $comment_content= substr($row["comment_content"],0,20);
                    $comment_status = $row["comment_status"];
                    $comment_date = $row["comment_date"];
                    

                    $InResponseQuery = "select * from posts where post_id = $comment_postId";
                    $InResponseRes = mysqli_query($con,$InResponseQuery);
                    $commentPostId = "";
                    $commentPostName = "";
                    while($row = mysqli_fetch_assoc($InResponseRes)) {
                        $commentPostId = $row['post_id'];
                        $commentPostName = $row['post_title'];
                    }

                    echo "<tr>";
                    echo "<td>$comment_id</td>";
                    echo "<td>$comment_author</td>";
                    echo "<td>$comment_content</td>";
                    echo "<td>$comment_email</td>";
                    echo "<td>$comment_status</td>";
                    echo "<td><a href='../post.php?postId={$commentPostId}'>$commentPostName</a></td>";
                    echo "<td><a href='comments.php?Approve={$comment_id}'>Approve</a></td>";
                    echo "<td><a href='comments.php?Unapprove={$comment_id}'>Disapprove</a></td>";
                    echo "<td>$comment_date</td>";
                    echo "<td><a href='posts.php?source=edit_posts&p_id={$comment_id}'>Update</a></td>";
                    echo "<td><a href='comments.php?deleteComment={$comment_id}'>Delete</a></td>";
                    echo "</tr>";


                }

                            
                            
                            
            ?>
                                
                                    
                                    
                                
    </tbody>
</table>


<?php 

    include "../includes/connection.php";

    if(isset($_GET['Approve'])) {

        $CommentId = $_GET['Approve'];

        $delQuery = "update comments set comment_status='Approved' where comment_id=$CommentId";
        $delRes = mysqli_query($con,$delQuery);
        header("Location:comments.php");

        if(!$delRes) {
            echo "Query Failed ".mysqli_error($con);
        }

    }

    if(isset($_GET['Unapprove'])) {

        $CommentId = $_GET['Unapprove'];

        $delQuery = "update comments set comment_status='Unapproved' where comment_id=$CommentId";
        $delRes = mysqli_query($con,$delQuery);
        header("Location:comments.php");

        if(!$delRes) {
            echo "Query Failed ".mysqli_error($con);
        }

    }

    if(isset($_GET['deleteComment'])) {

        $CommentId = $_GET['deleteComment'];

        $delQuery = "delete from comments where comment_id = {$CommentId}";
        $delRes = mysqli_query($con,$delQuery);
        header("Location:comments.php");

        if(!$delRes) {
            echo "Query Failed ".mysqli_error($con);
        }

    }

?>
