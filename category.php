<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <!-- <h2 class="page-heading"><?php echo $row1['category_name'];?></h2> -->
                  <?php
                  $cat_id = $_GET['cid'];
                    $sql2 = "SELECT * FROM category WHERE category.category_id = {$cat_id}";
                    $result2 = mysqli_query($con,$sql2) or die('Query Faield');
                        if(mysqli_num_rows($result2) > 0){
                            while($row2 = mysqli_fetch_assoc($result2)){
                  ?>
                  <h2 class="page-heading"><?php echo $row2['category_name']?></h2>
                  <?php
                        }
                    }
                    $limit = 3;
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;
                    $sql1 = "SELECT post.post_id, post.title, post.description, post.post_date,post.post_img, category.category_name, user.username,post.category,post.author FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.category = {$cat_id} ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                    // echo $sql1;
                    // die();
        
                    $result1 = mysqli_query($con,$sql1) or die('There is an issue');
                    // $sum = mysqli_num_rows($result1);
                    // echo $sum;
                    // die();
                    if(mysqli_num_rows($result1) > 0)
                    {
                        while($row1 = mysqli_fetch_assoc($result1)){
                ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row1['post_id'];?>"><img src="admin/upload/<?php echo $row1['post_img']?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row1['post_id'];?>'><?php echo $row1['title'];?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row1['category']?>'><?php echo $row1['category_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?aid=<?php echo $row1['author']?>'><?php echo $row1['username'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row1['post_date'];?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row1['description'],0,150)."...";?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row1['post_id'];?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }else{
                        echo "<h2>No record found</h2>";
                    }
                    $sql = "SELECT * FROM post WHERE post.category = {$cat_id}";
                    $result = mysqli_query($con,$sql) or die('Query Faield');
                        if(mysqli_num_rows($result) > 0)
                        {
                            $total_post = mysqli_num_rows($result);
                            $total_page = ceil($total_post / $limit);
                            echo "<ul class='pagination'>";
                            if($page > 1){
                                echo "<li><a href='category.php?cid={$cat_id}&page=".($page -1)."'>Prev</a></li>";
                            }
                            for($i = 1; $i <= $total_page; $i++){
                                if($i == $page){
                                    $active = "active";
                                }else{
                                    $active = "";
                                }
                                echo "<li class='".$active."'><a href='category.php?cid={$cat_id}&page=".$i."'>".$i."</a></li>";
                            }
                            if($total_page > $page){
                                echo "<li><a href='category.php?cid={$cat_id}&page=".($page + 1)."'>Next</a></li>";
                            }
                        }
                        echo "</ul>";
                    ?>
                    <!-- <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul> -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
