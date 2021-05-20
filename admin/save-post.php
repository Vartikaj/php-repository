<?php
    include "config.php";
    if(isset($_FILES['fileToUpload']))
    {
        $errors = array();
        //Take all the attributes or property of uploaded files. 
        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file_type = $_FILES['fileToUpload']['type'];
        /**
         * pathinfo This is a new way to get a file extenson.
         */
        // $file_ext = pathinfo($_FILES["fileToUpload"]["name"])['extension'];
        $file_ext = end(explode(".",$file_name));
        $extenstions = array("jpeg","jpg","png");
        /**
         * in_array() : this function is used to search any value inside the array. 
         * */
        if(in_array($file_ext,$extenstions) == false)
        {
            $errors[] = " This extenstion file is not allowed, Please choose jpg and png image";
        }
        /**
         * 1KB => 1024Bit
         * 1MB => 1024MB => (1024Bit * 1024Bit)
         * 2MB => 2 * (1024Bit * 1024Bit) 
         */
        if($file_size > 2097152)
        {
            $errors[] = "File Size numst be less equal to 2MB";
        }

        if(!empty($errors))
        {
            print_r($errors);
            die();
        }else
        {
            move_uploaded_file($file_tmp,"upload/".$file_name);
        }

    }
    session_start();
    $title = mysqli_real_escape_string($con,$_POST['post_title']);
    $description = mysqli_real_escape_string($con,$_POST['postdesc']);
    $category = mysqli_real_escape_string($con,$_POST['category']);
    //server date
    $date = date("d M, Y");
    /* *it took the session id of those person who is currently login and try
       * to put a post, so that the loged in person become a author of that particular 
       * post.*/ 
    $author = $_SESSION['user_id'];
    $sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES('{$title}','{$description}',{$category},'{$date}',{$author},'{$file_name}');";

    $sql .= "UPDATE category SET post = post + 1 where category_id = {$category}";
    if(mysqli_multi_query($con, $sql))
    {
        header("location:post.php");
    } else{
        echo "<div class='alert alert-danger'>Query Failed</div>";
    }


?>