<p>
        <?php
            if (isset($_SESSION) === false){@session_start();}

            if (isset($_SESSION['member_id']) === false){
            ?>
            <a href="/regist.php">Signup</a>
            <a href="/login.php">Login</a>
            <?php
            }else{
            ?>
            <a href="/logout.php">Logout</a>
            <?php
            }
            ?>
            <h1>Welcome to Facebook PHP!</h1>
            <p> Please Login! </p>

        </p>
