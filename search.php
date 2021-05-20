<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                <?php
                    if(isset($_GET['search'])){
                    $search_term = $_GET['search'];   
                ?>
                  <h2 class="page-heading">Search : <?php echo $search_term;?></h2>
                    <?php

                    $limit = 3;
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = 1;
                    }
                    $offset = ($page -1) * $limit;
                    $sql1 = "SELECT post.post_id, post.title, post.description, post.post_date,post.post_img, category.category_name, user.username,post.category,post.author FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.title LIKE '%{$search_term}%' ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                    
                    $data1 = mysqli_query($con,$sql1) or die('Query Failed1');
                    
                    if(mysqli_num_rows($data1) > 0){
                        while($row1 = mysqli_fetch_assoc($data1)){
                    ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row1['post_id'];?>"><img src="admin/upload/<?php echo $row1['post_img'];?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row1['post_id'];?>'><?php echo $row1['title'];?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row1['category'];?>'><?php echo $row1['category_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?aid=<?php echo $row1['author'];?>'><?php echo $row1['username'];?></a>
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
                        echo "<h2>No Record Found</h1>";
                    }

                    $sql2 = "SELECT * FROM post WHERE post.title LIKE '%{$search_term}%'";
                    $data2 = mysqli_query($con,$sql2) or die('Query Failed2');
                    if(mysqli_num_rows($data2) > 0){
                        $total_post = mysqli_num_rows($data2);
                        
                        $total_page = ceil($total_post / $limit);
                        echo "<ul class='pagination'>";
                        if($page > 1){
                            echo "<li><a href='author.php?search={$search_term}&page=".($page - 1)."'>Prev</a></li>";
                        }
                        for($i=1; $i <= $total_page; $i++){
                            if($i == $page){
                                $active = "active";
                            }
                            else{
                                $active = "";
                            }
                            echo "<li class='".$active."'><a href='author.php?search={$search_term}&page=".$i."'>".$i."</a></li>";
                        }
                        if($total_page > $page){
                            echo "<li><a href='author.php?search={$search_term}&page=".($page + 1)."'>Next</a></li>";
                        }
                        echo "</ul>";
                    }
                    }else{
                        echo "<h2>not Forund</h2>";
                    }
                    
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
