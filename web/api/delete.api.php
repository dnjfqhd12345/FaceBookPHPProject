<?php

// Check Login
session_start();
if(isset($_SESSION['member_id']) === false) {
    header("Location: /list.php");
    exit();
}

// check parameter
$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null;
if($post_id == null){
    header("Location: /list.php");
    exit();
}

// DB Require
require_once("db.php");

$member_id = $_SESSION['member_id'];

// delete article, check writer's ID
$result = db_update_delete("delete from tbl_post where post_id = :post_id and member_id = :member_id",
    array('post_id' => $post_id, 'member_id' => $member_id)
);

// exception handler whether member_id of session and member_id of post are correct or not
if($result === false){
    echo "<script>alert('Illegal Access!');";
    echo "window.location.href='/list.php';</script>";
    exit();
}

echo "<script>alert('Delete successfully!');";
echo "window.location.href='/list.php';</script>";
exit();
?>