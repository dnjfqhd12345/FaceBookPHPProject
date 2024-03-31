<?php
header('Content-Type: application/json');

// Check Login
session_start();
if(isset($_SESSION['member_id']) === false) {
    echo json_encode(array('result' => false));
    exit();
}

// check parameter
$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null;
if($post_id == null){
    echo json_encode(array('result' => false));
    exit();
}

// DB Require
require_once("../db.php");

$member_id = $_SESSION['member_id'];

// delete article, check writer's ID
$result = db_update_delete("delete from tbl_post where post_id = :post_id and member_id = :member_id",
    array('post_id' => $post_id, 'member_id' => $member_id)
);

echo json_encode(array('result' => $result));