          
        
            <div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="SearchValue">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Login Block -->

                <div class="well">
                    <div class="text-center">
                        <h4>Login </h4>
                    </div>
                    <hr>
                    <form action="includes/login.php" method="post">

                        <div class="form-group">
                            <div class="text-center">
                                <span class="input-group-text" id="basic-addon1"><img src="images/user_acc.png" alt="" width="25px" height="25px">&nbsp;&nbsp;UserName</span>&nbsp;
                                <input type="text" class="form-control" placeholder="Username"  aria-describedby="basic-addon1" name="loginUserName">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="text-center">
                                <span class="input-group-text" id="basic-addon1"><img src="images/password_acc.png" alt="" width="25px" height="25px">&nbsp;&nbsp;UserName</span>
                                <input type="password" class="form-control" placeholder="Password"  aria-describedby="basic-addon1" name="loginUserPassword">
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="login">Login</button>
                            </div>
                        </div>
                        
                        
                    </form>
                    <!-- /.input-group -->
                </div>



                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php 

                                    include "includes/connection.php";

                                    $cat_query = "select * from category";
                                    $cat_res = mysqli_query($con,$cat_query);

                                    while($row = mysqli_fetch_assoc($cat_res)) {
                                        $id = $row['cat_id'];
                                        $title = $row['cat_title'];
                                        echo "<li><a href='category.php?category=$id'>$title</a></li>";
                                    }

                                
                                ?>
                                
                                <!-- <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li> -->
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <!-- <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div> -->
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "includes/widget.php" ;?>
            </div>