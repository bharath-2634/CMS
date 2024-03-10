<?php 

include "../includes/connection.php";
function insertCategories() {
    

    if(isset($_POST['insert'])) {
        $cat_data = $_POST["categories-title"];
                                    
        if(empty($cat_data) || $cat_data == "") {
            echo "Enter Valid Details";
        }else {

            $ins_query = "insert into category(cat_title) values ('{$cat_data}')";
            $res = mysqli_query($con,$ins_query);
            if(!$res) {
                echo "Sorry ".mysqli_error($con);
            }
        }
    }
}





?>
