<!DOCTYPE html>
<html>
    <head>
        <title>Facebook_php Login</title>
    </head>
    <body>
        <?php require_once("header.php"); ?>
        <h1>Facebook_php Login</h1>
        <form method="POST" action="api/login.post.php">
        <p>
            ID :
            <input type="text" name="login_id" />
        <p>
        <p>
            PASSWORD :
            <input type="password" name="login_pw" />
        <p>
        <p><input type="submit" value="Login"></p>
        </form>
    </body>
</html>