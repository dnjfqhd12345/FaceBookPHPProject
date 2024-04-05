<?php
header('Content-Type: application/json');

// Check Login
session_start();
if(isset($_SESSION['member_id']) === false) {
    echo json_encode(array('result' => false));
    exit();
}

// Parameter check
$last_post_id = isset($_POST['last_post_id']) ? $_POST['last_post_id'] : null;
if($last_post_id == null){
    echo json_encode(array('result' => false));
    exit();
}

// DB Require
require_once("inc/db.php");

$member_id = $_SESSION['member_id'];
$post_query = "select post_id, post_content from tbl_post where member_id = :member_id and post_id < :post_id order by insert_date desc limit 10 ";
$post_data = db_select($post_query, array("member_id" => $member_id, "post_id" => $last_post_id));

echo json_encode(
    array(
        'result' => true,
        'post_data' => $post_data
    )
);

?>