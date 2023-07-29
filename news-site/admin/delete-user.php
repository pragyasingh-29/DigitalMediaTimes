<?php
include "config.php";
session_start();
if($_SESSION['user_role']=='0'){
    header("location:http://localhost/news-site/admin/post.php");
}
$userid=$_GET['id'];
$sql = "DELETE FROM user WHERE user_id={$userid}";

if(mysqli_query($conn,$sql)){
    header("Location:http://localhost/news-site/admin/users.php");
}else{
    echo "<p>Can't Delete user record</p>";
}
mysqli_close($conn);
?>