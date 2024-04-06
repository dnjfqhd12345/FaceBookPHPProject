<?php
// check login
@session_start();
if(isset($_SESSION['member_id']) === false) {
    header("Location: /list.php");
    exit();
}

// parameter check
$post_content = isset($_POST['post_id']) ? $_POST['post_id'] : null;
if($post_content == null || trim($post_content) == ''){
    header("Location: /list.php");
    exit();
}

// DB Require
require_once("db.php");

$member_id = $_SESSION['member_id'];
$post_id = $_POST['post_id'];
$update_content = $_POST['update_content'];


// insert tbl_post
$update_query = "update tbl_post set post_content = :content where post_id = :post_id";
$post_id = db_update_delete($update_query, array('content'=>$update_content, 'post_id' => $post_id));

if($post_id != false){
    echo "<script>alert('Modify successfully!');</script>";
}
echo "<script>window.location.href='/list.php';</script>";
exit();
?>