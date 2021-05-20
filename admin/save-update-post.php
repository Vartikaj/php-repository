<?php
    include "config.php";
    if(empty($_FILES['new-image']['name'])){
        $file_name = $_POST['old-image'];

    }else{
        $error = array();
        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
        
        $file_ext = end(explode('.',$file_name));
        $extension = array("png","jpeg","jpg");

        if(in_array($file_ext, $extension) == false){
            $errors[] = " This extenstion file is not allowed, Please choose jpg and png image";
        }
        
        if($file_size > 2097152){
            $errors[] = "File Size numst be less equal to 2MB";
        }

        if(!empty($errors)){
            print_r($error);
            die();
        }else{
            move_uploaded_file($file_tmp,"upload/".$file_name);
        }
    }
    $sql = "UPDATE post SET title='{$_POST["post_title"]}', description ='{$_POST["postdesc"]}', category={$_POST["category"]}, post_img = '{$file_name}' WHERE post_id={$_POST["post_id"]}";
    $result =mysqli_query($con,$sql) or die('Query Failed');

    if($result)
    {
        header("location:post.php");
    }else{
        echo "Query failed";
    }
?>