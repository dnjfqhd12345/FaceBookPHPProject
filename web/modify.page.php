<?php
// check login
@session_start();
if(isset($_SESSION['member_id']) === false){
    header("Location: /index.php");
    exit();
}


$member_id = $_SESSION['member_id'];
$post_id = $_POST['post_id'];

// DB
require_once("db.php");
$post_query = "SELECT p.post_id, p.post_content, p.member_id, p.insert_date, p.member_id 
FROM tbl_post p 
WHERE p.post_id = :post_id";
$post_data = reset(db_select($post_query, array('post_id' => $post_id)));


if($post_data['member_id'] != $member_id){
    echo "<script>alert('Illegal Access!');</script>";
    echo "<script>window.location.href='/list.php';</script>";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Facebook_php Main</title>
    </head>
    <body>
        <?php require_once("header.php"); ?>
        <h1>Original your post</h1>
        <!-- Show Original Post. -->
            <div style="border: 1px solid black; padding: 10px; margin-bottom: 10px;">
                <?php echo "Writer: ".$post_data['login_name']; ?><br>
                <?php echo "id: ".$post_data['member_id']; ?><br>
                <?php echo "Content: ".$post_data['post_content']; ?><br>
                <?php echo "Date: ".$post_data['insert_date']; ?><br>
            </div>
            <br>

        <form method="POST" action="modify.api.php">
            <p>
                <input type="text" id="update_content" name="update_content" style="width:100%" />
                <input type="hidden" name="post_id" value="<?php echo $post_data['post_id']; ?>">
            </p>
            <p>
                <input type="submit" id="post_modify" value="MODIFY" />
            </p>
        </form>
    </body>
</html>