<?php include "header.php"; 
    // THIS CODE IS FOR WHEN WE WANT TO PREVENT THAT PAGE IS NOT OPEN BY NORMAL USER.
    if($_SESSION['user_role'] == '0')
    {
        header('location:post.php');
    }
    
    $userid = $_GET['id'];
    $sql = "DELETE FROM user WHERE user_id = {$userid}";
    if(mysqli_query($con,$sql))
    {
        header("location:users.php");
    }else{
        echo "<p>Not able to delete data!..</p>";
    }
    mysqli_close($con);
?>