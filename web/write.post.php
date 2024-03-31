<?php
// check login
session_start();
if(isset($_SESSION['member_id']) === false) {
    header("Location: /list.php");
    exit();
}

// parameter check
$post_content = isset($_POST['post_content']) ? $_POST['post_content'] : null;
if($post_content == null || trim($post_content) == ''){
    header("Location: /list.php");
    exit();
}

// DB Require
require_once("inc/db.php");

$member_id = $_SESSION['member_id'];

// insert tbl_post
$post_id = db_insert("insert into tbl_post (post_content, member_id) values (:post_content, :member_id)",
    array('post_content'=>$post_content, 'member_id'=>$member_id)
);

header("Location: /list.php");
exit();
?>