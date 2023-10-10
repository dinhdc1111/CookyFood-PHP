<?php
session_start();
include('../../dao/pdo.php');
include('../../dao/comment.php');
// global variable
$imagePath = "uploads/";
// Get id_product from product-detail.php with jquery
$id_product = $_REQUEST['id_product'];
if (isset($_REQUEST['list_comment'])) {
    $list_comment = $_REQUEST['list_comment'];
    $user_data = array();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="title">✨ Bình luận ✨</div>
    <div class="comment-session">
        <div class="post-comment">
            <?php
            if (!empty($list_comment)) {
                foreach ($list_comment as $comment) {
                    extract($comment);
                    // Displays user by comment
                    $user_data = comment_by_id_user($id_user);
                    $username = $user_data[0]['username'];
                    $image = $user_data[0]['image'];
                    $created_at = $user_data[0]['created_at'];
                    $showImage = !empty($image) ? $imagePath . $image : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';
                    echo '<div class="item-comment">
            <div class="user">
                <div class="user-image"><img src="' . $showImage . '" alt="Ảnh đại diện" /></div>
                <div class="user-meta">
                    <div class="name">' . $username . '</div>
                    <div class="day">' . $created_at . '</div>
                </div>
            </div>
            <div class="comment-post">
                ' . $content . '
            </div>
        </div>';
                }
            } else {
                echo '<div class="no-comment">Chưa có bình luận</div>';
            }
            ?>

        </div>
        <?php
        // get data user login
        if (isset($_SESSION['account'])) {
            $username_login = $_SESSION['account']['username'];
            $avatar_user_login =  !empty($_SESSION['account']['image']) ? $imagePath . $_SESSION['account']['image'] : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';
            echo '<div class="comment-box">
            <div class="user">
                <div class="image"><img src="' . $avatar_user_login . '" alt="avatar"></div>
                <div class="name">' . $username_login . '</div>
            </div>
            <form action="index.php?req=add-comment" method="post">
                <input type="hidden" name="id_product" value="' . $id_product . '" />
                <textarea name="content" cols="30" rows="10" placeholder="Viết bình luận..."></textarea>
                <input type="submit" name="submit" value="Bình luận" class="comment-submit">
            </form>
            </div>';
        }else{
            echo '<div class="no-login"><i class="fa-solid fa-circle-exclamation"></i> Vui lòng <a href="index.php?req=login">đăng nhập</a> để bình luận!</div>';
        }
        ?>
    </div>
</body>

</html>