<?php
include "config.php";
$post_id=$_GET['id'];
$cat_id=$_GET['catid'];

$sql1 = "SELECT * FROM post WHERE post_id={$post_id};";
$result = mysqli_query($conn,$sql1) or die("Query Failed");
$row = mysqli_fetch_assoc($result);

//kisi bhi file ko kisi bhi folder se delete karna chahte h tab iska use akrte h
unlink('upload/'.$row['post_img']);

$sql = "DELETE FROM post WHERE post_id = {$post_id};";
$sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$cat_id}";


if(mysqli_multi_query($conn,$sql)){
    header("Location:http://localhost/news-site/admin/post.php");
}else{
    echo "<p>Can't Delete user post</p>";
}
mysqli_close($conn);

?>