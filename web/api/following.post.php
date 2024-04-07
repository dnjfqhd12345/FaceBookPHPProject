<?php
// check login
session_start();
if(isset($_SESSION['member_id']) === false) {
    header("Location: /list.php");
    exit();
}

// parameter check
$following_user_id = isset($_POST['following_id']) ? $_POST['following_id'] : null;
if($following_user_id == null || trim($following_user_id) == ''){
    header("Location: /list.php");
    exit();
}

// DB Require
require_once("db.php");

$member_id = $_SESSION['member_id'];

// insert tbl_post
$post_id = db_insert("insert into tbl_following (user_id_pk, following_id_pk) values (:user_id, :following_id)",
    array('user_id'=>$member_id, 'following_id'=>$following_user_id)
);

header("Location: /list.php");
exit();
?>