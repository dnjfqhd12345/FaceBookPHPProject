<p style='text-aligh:right'>
<?php
    if(isset($_SESSION) === false) {session_start();}

    if(isset($_SESSION['member_id']) == false){
?>
<a href="/regist.php">Sign Up</a>
<a href="/login.php">Login</a>
<?php
} else {
    ?>
    <a href="/logout.php">Logout</a>
    <?php
}
?>
</p>