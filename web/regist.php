<!DOCTYPE html>
<html>
    <head>
        <title>facebook_php Signup</title>
    </head>
    <body>
        <?php require_once("header.php"); ?>
        <h1>facebook_php Signup</h1>
        <form method="POST" action="regist.post.php">
        <p>
            ID:
            <input type="text" name="login_id" />
        <p>
        <p>
            PASSWORD :
            <input type="password" name="login_pw" />
        <p>
        <p>
            NAME :
            <input type="text" name="login_name" />
        <p>
        <p><input type="submit" value="signup"></p>
        </form>
    </body>
</html>