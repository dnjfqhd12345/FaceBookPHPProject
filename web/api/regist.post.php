<?php
require_once("./../db.php");

$login_id = isset($_POST['login_id']) ? $_POST['login_id'] : null;
$login_pw = isset($_POST['login_pw']) ? $_POST['login_pw'] : null;
$login_name = isset($_POST['login_name']) ? $_POST['login_name'] : null;

// check parameter
if($login_id == null || $login_pw == null || $login_name == null) {
    header("Location: /regist.php");
    exit();
}

// encrypt PASSWORD
$bcrypt_pw = password_hash($login_pw, PASSWORD_BCRYPT);

// Save DB
db_insert("insert into tbl_member (login_id, login_name, login_pw) values (:login_id, :login_name, :login_pw)",
    array('login_id' => $login_id,
    'login_name' => $login_name,
    'login_pw' => $bcrypt_pw
    )
);

// Go Login Page
header("Location: /login.php");

?>