<?php include "header.php"; 
    // THIS CODE IS FOR WHEN WE WANT TO PREVENT THAT PAGE IS NOT OPEN BY NORMAL USER.
    if($_SESSION['user_role'] == '0')
    {
        header('location:post.php');
    }
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
            <?php
                include "config.php";
                $limit = 3;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = 1;
                }
                $offset = ($page-1) * $limit;
                $query = "SELECT category.category_id, category.category_name, category.post FROM category ORDER BY category_id LIMIT {$offset},{$limit}";
                $result = mysqli_query($con,$query) or die('Query Failed');
                if(mysqli_num_rows($result) > 0)
                {     
            ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result))
                        {
                    ?>
                        <tr>
                            <td class='id'><?php echo $row['category_id'];?></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $row['post'];?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id'];?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id'];?>&postid=<?php echo $row['post.category'];?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                }else{
                    echo "<h2>No record found</h2>";
                }
                $sql1 = "SELECT * FROM category";
                $data = mysqli_query($con,$sql1) or die("Query Failed");
                if(mysqli_num_rows($data) > 0)
                {
                    $total_category = mysqli_num_rows($data);
                    $total_page = ceil($total_category/$limit);
                    echo "<ul class='pagination admin-pagination'>";
                    if($page > 1)
                    {
                        echo "<li><a href='category.php?page=".($page-1)."'>Prev</a></li>";
                    }
                    for($i = 1; $i <= $total_page; $i++)
                    {
                        if($i == $page){
                            $active = "active";
                        }else{
                            $active = "";
                        }

                        echo "<li class='".$active."'><a href='category.php?page=".$i."'>".$i."</a></li>";
                    }
                    if($total_page > $page){
                        echo "<li><a href='category.php?page=".($page+1)."'>Next</a></li>";
                    }
                    echo "</ul>";
                }
                
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
