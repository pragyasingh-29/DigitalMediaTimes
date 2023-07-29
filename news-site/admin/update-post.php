<?php include "header.php";
include "config.php";
if (isset($_POST['submit'])) {
    //mysqli_real_escape_string - agar koi isme special characters dalta h ya js daal deta h to vo run nahi hogi//since protected
    $postid = mysqli_real_escape_string($conn, $_POST["post_id"]);
    $title = mysqli_real_escape_string($conn, $_POST["post_title"]);
    $description = mysqli_real_escape_string($conn, $_POST["postdesc"]);
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    //md5 function - jo fuction hum dalenge use encrypt karega 
    //$password=mysqli_real_escape_string($conn,md5( $_POST["password"]));
    //$role=mysqli_real_escape_string($conn,$_POST["role"]);

    //check username we are creating does not exist in the system
    $sql = "UPDATE post SET title='{$title}',description='{$description}',category='{$category}' WHERE post_id={$postid}";
    $result = mysqli_query($conn, $sql) or die("Query Failed");

}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                include "config.php";
                $post_id = $_GET['id'];
                $sql = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author=user.user_id WHERE post_id={$post_id}";

                $result = mysqli_query($conn, $sql) or die("Query failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <!-- Form for show edit-->
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="post_id" class="form-control" value="<?php echo $row['post_id'] ?> "
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTile">Title</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername"
                                    value="<?php echo $row['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea name="postdesc" class="form-control" required rows="5">
                        <?php echo $row['description']; ?>
                        </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Category</label>
                                <select class="form-control" name="category" value="<?php echo $row['category_name'];?>">
                                    <?php
                                    include "config.php";
                                    $sql1 = "SELECT * FROM category";
                                    $result1 = mysqli_query($conn, $sql1) or die("query failed");
                                    if (mysqli_num_rows($result1) > 0) {
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                            echo "<option value='{$row1['category_id']}'>{$row1['category_name']}</option>";
                                        }
                                    }
                                    ?>
                        </select>
                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <input type="file" name="new-image">
                                <img src="admin/upload/<?php echo $row['post_img'];?>" height="200px" width="200px";>
                                <!--<input type="hidden" name="old-image" value="">-->
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </form>
                        <!-- Form End -->
                    <?php }
                } else {
                    echo "result not found";
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>