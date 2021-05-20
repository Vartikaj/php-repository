<?php
    include "header.php"; 
    include "config.php";

    $cat_id = $_GET['id'];
    $post_cat_id = $_GET['postid'];
    $sql = "DELETE FROM category WHERE category_id = {$cat_id};";
    $sql .= "UPDATE post SET category = 0 WHERE category = {$post_cat_id}";

    if(mysqli_multi_query($con,$sql))
    {
        header("location:category.php");
    }else{
        echo "<p>Not able to delete data!..</p>";
    }
    mysqli_close($con);

?>