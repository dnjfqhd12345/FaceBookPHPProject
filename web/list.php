<?php
// check login
@session_start();
if(isset($_SESSION['member_id']) === false){
    header("Location: /index.php");
    exit();
}

// DB
require_once("db.php");

$member_id = $_SESSION['member_id'];
// 현재 내 글과 친구 글까지 다 긁어오기.
$post_query = "SELECT DISTINCT p.post_id, p.post_content, p.member_id, p.insert_date, m.login_name 
FROM tbl_post p 
LEFT JOIN tbl_member m ON p.member_id = m.member_id 
LEFT JOIN tbl_following f ON p.member_id = f.following_id_pk
WHERE f.user_id_pk = :userID OR p.member_id = :muserID 
ORDER BY p.insert_date DESC 
LIMIT 10;
";
$post_data = db_select($post_query, array('userID' => $member_id,
                                        'muserID' => $member_id));


$recommend_friend = "select * from tbl_member where tbl_member.member_id != :MYuserID 
AND tbl_member.member_id NOT IN (SELECT following_id_pk FROM tbl_following WHERE user_id_pk = :userID) 
order by rand() limit 3";
$get_recommend_data = db_select($recommend_friend, array('MYuserID' => $member_id, 'userID' => $member_id));

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Facebook_php Main</title>
    </head>
    <body>
        <?php require_once("header.php"); ?>
        <h1>Facebook_php Main Page</h1>
        <hr>
        <h1>Be a friend!</h1>
        <!-- 여기에 데이터베이스 긁어와서 3명정도 보여주기 -->

        <?php foreach($get_recommend_data as $friend): ?>
            <form action="api/following.post.php" method="post" style="display: inline;">
                <input type="hidden" name="following_id" value="<?php echo $friend['member_id']; ?>">
                <button type="submit">
                    <?php echo $friend['login_name']; ?>
                </button>
            </form>
            <br>
        <?php endforeach; ?>

        <hr>
        <h3>Share your life to your friends!</h3>
        <form method="POST" action="api/write.post.php">
            <p>
                <input type="text" id="post_content" name="post_content" style="width:800px;height:100px;font-size:30px;" />
            </p>
            <p>
                <input type="submit" id="post_write" value="POST" />
            </p>
        </form>

        <hr>

        <h3>Posts of your friends</h3>
        <!-- 그 다음 여기에 나의 친구들의 글 피드를 보여주자. -->
        <?php foreach($post_data as $post): ?>
            <div style="border: 1px solid black; padding: 10px; margin-bottom: 10px;">
                <?php echo "Writer: ".$post['login_name']; ?><br>
                <?php echo "Content: ".$post['post_content']; ?><br>
                <?php echo "Date: ".$post['insert_date']; ?><br>
                        <!-- 수정 및 삭제 버튼 -->
                <?php if ($post['member_id'] == $member_id): ?>
                    <form action="modify.page.php" method="post" style="display: inline;">
                        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                        <button type="submit">Modify</button>
                    </form>
                    <form action="api/delete.api.php" method="post" style="display: inline;">
                        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                <?php endif; ?>

            </div>
            <br>
        <?php endforeach; ?>
    </body>
</html>