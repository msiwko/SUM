<!DOCTYPE html>
<html lang="en">
<?php
session_start();
unset($_SESSION['REQUEST_METHOD']);
if ($_SESSION['logged'] !== true) {
    header('location: /index.php');
}
require 'head.php';
require 'conn.php';
$conn = connection();
$getID = "SELECT ID from users WHERE login=\"{$_SESSION['user']}\"";
$query = mysqli_query($conn, $getID);
$_SESSION['userid'] = mysqli_fetch_array($query)['ID'];
$getRank = "SELECT rank_ID from users WHERE login=\"{$_SESSION['user']}\"";
$query = mysqli_query($conn, $getRank);
$userRank = mysqli_fetch_array($query)['rank_ID'];
?>
<link rel="stylesheet" href="forum.css">
<nav>
    <img id="sumL" src="photos/sum.png">
    <img id="sumR" src="photos/sum.png">
    <div class="left">
    </div>
    <div class="middle">
        <a href="forum.php" id="up">
            <h1> SUM </h1>
            <h2> Twoje forum wędkarskie </h2>
        </a>
    </div>
    <div class="right" id="rup">
        <img src="photos/settings.png" id="settings">
        <div id="options">
            <a href="index.php" id="logout"> Wyloguj się </a>
            <a href="delaccount.php" id="delacc"> Usuń konto </a>
        </div>
    </div>
</nav>

<body>
    <div id="container">
        <div class="left">

        </div>
        <div class="middle">
            <div id="postForm">
                <label id="postLabel" for="content"> Napisz swój post! </label>
                <textarea maxlength="2048" name="content" form="post" id="content"> </textarea>
                <form id="post" method="POST">
                    <button class="button" id="postSubmit" type="submit" name="submit"> Opublikuj </button>
                </form>
            </div>
        </div>
        <div class="right">

        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        if (strlen($_POST['content']) > 2) {
            $publicate = "INSERT INTO posts (content, author_ID) VALUES (\"{$_POST['content']}\", {$_SESSION['userid']})";
            $postQuery = mysqli_query($conn, $publicate);
            if ($userRank !== 99 || $userRank !== 98) {
                $getPosts = "SELECT COUNT(*) AS postcount FROM posts WHERE author_ID = {$_SESSION['userid']}";
                $postQuery = mysqli_query($conn, $getPosts);
                $posts = mysqli_fetch_array($postQuery);
                $postsNum = intval($posts['postcount']);
                $getComments = "SELECT COUNT(*) AS commentcount FROM comments WHERE comment_author_ID = {$_SESSION['userid']}";
                $comQuery = mysqli_query($conn, $getComments);
                $comments = mysqli_fetch_array($comQuery);
                $commentsNum = intval($comments['commentcount']);
                $rank = $postsNum + $commentsNum;
                if ($rank <= 10) {
                    $rankUpdate = "UPDATE users SET rank_ID = 1 WHERE ID = {$_SESSION['userid']}";
                    $rankQuery = mysqli_query($conn, $rankUpdate);
                } elseif ($rank <= 20) {
                    $rankUpdate = "UPDATE users SET rank_ID = 2 WHERE ID = {$_SESSION['userid']}";
                    $rankQuery = mysqli_query($conn, $rankUpdate);
                } elseif ($rank <= 50) {
                    $rankUpdate = "UPDATE users SET rank_ID = 3 WHERE ID = {$_SESSION['userid']}";
                    $rankQuery = mysqli_query($conn, $rankUpdate);
                } elseif ($rank <= 100) {
                    $rankUpdate = "UPDATE users SET rank_ID = 4 WHERE ID = {$_SESSION['userid']}";
                    $rankQuery = mysqli_query($conn, $rankUpdate);
                } elseif ($rank <= 250) {
                    $rankUpdate = "UPDATE users SET rank_ID = 5 WHERE ID = {$_SESSION['userid']}";
                    $rankQuery = mysqli_query($conn, $rankUpdate);
                } elseif ($rank <= 500) {
                    $rankUpdate = "UPDATE users SET rank_ID = 6 WHERE ID = {$_SESSION['userid']}";
                    $rankQuery = mysqli_query($conn, $rankUpdate);
                }
            }
        }
        header('location: forum.php');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comSubmit'])) {
        if (strlen($_POST['comContent']) > 1) {
            $publicateCom = "INSERT INTO comments (comment_author_ID, post_ID, comment_content) VALUES ({$_SESSION['userid']}, {$_POST['id']}, \"{$_POST['comContent']}\")";
            $query = mysqli_query($conn, $publicateCom);
            // unset($_POST['comSubmit']);
            // unset($_POST['comContent']);
            if ($userRank !== 99 || $userRank !== 98) {
                $getPosts = "SELECT COUNT(*) AS postcount FROM posts WHERE author_ID = {$_SESSION['userid']}";
                $postQuery = mysqli_query($conn, $getPosts);
                $posts = mysqli_fetch_array($postQuery);
                $postsNum = intval($posts['postcount']);
                $getComments = "SELECT COUNT(*) AS commentcount FROM comments WHERE comment_author_ID = {$_SESSION['userid']}";
                $comQuery = mysqli_query($conn, $getComments);
                $comments = mysqli_fetch_array($comQuery);
                $commentsNum = intval($comments['commentcount']);
                $rank = $postsNum + $commentsNum;
                if ($rank <= 10) {
                    $rankUpdate = "UPDATE users SET rank_ID = 1 WHERE ID = {$_SESSION['userid']}";
                    $rankQuery = mysqli_query($conn, $rankUpdate);
                } elseif ($rank <= 20) {
                    $rankUpdate = "UPDATE users SET rank_ID = 2 WHERE ID = {$_SESSION['userid']}";
                    $rankQuery = mysqli_query($conn, $rankUpdate);
                } elseif ($rank <= 50) {
                    $rankUpdate = "UPDATE users SET rank_ID = 3 WHERE ID = {$_SESSION['userid']}";
                    $rankQuery = mysqli_query($conn, $rankUpdate);
                } elseif ($rank <= 100) {
                    $rankUpdate = "UPDATE users SET rank_ID = 4 WHERE ID = {$_SESSION['userid']}";
                    $rankQuery = mysqli_query($conn, $rankUpdate);
                } elseif ($rank <= 250) {
                    $rankUpdate = "UPDATE users SET rank_ID = 5 WHERE ID = {$_SESSION['userid']}";
                    $rankQuery = mysqli_query($conn, $rankUpdate);
                } elseif ($rank <= 500) {
                    $rankUpdate = "UPDATE users SET rank_ID = 6 WHERE ID = {$_SESSION['userid']}";
                    $rankQuery = mysqli_query($conn, $rankUpdate);
                }
            }
        }
        header('location: forum.php');
    }

    $getAllPosts = "SELECT content, post_ID, post_date, users.`login`, ranks.`rank_name` AS rank FROM posts JOIN users ON users.`ID`=posts.`author_ID` JOIN ranks ON ranks.`rank_id`=users.`rank_id` ORDER BY post_ID DESC";
    $allPostsQuery = mysqli_query($conn, $getAllPosts);
    $allPosts = mysqli_fetch_all($allPostsQuery, MYSQLI_ASSOC);
    echo
    "<div id=\"posts\">";
    foreach ($allPosts as $post) {
        $ID = $post['post_ID'];
        echo
        "<div class=\"post\">
            <div class=\"postHeader\">
                <div id=\"leftHeader\"> {$post['login']}({$post['rank']}) </div>
                <div id=\"rightHeader\"> {$post['post_date']} </div>
            </div>
        {$post['content']}";
        $getComms = "SELECT comment_content, users.`login`, ranks.`rank_name` AS rank FROM comments JOIN users ON users.`ID`=comments.`comment_author_ID` JOIN ranks ON ranks.`rank_id`=users.`rank_id` WHERE post_ID = {$ID} ORDER BY post_ID, comment_ID DESC";
        $CommsQuery = mysqli_query($conn, $getComms);
        $Comms = mysqli_fetch_all($CommsQuery, MYSQLI_ASSOC);
        foreach ($Comms as $Comment) {
            echo
            "<div class=\"comment\"> {$Comment['login']}({$Comment['rank']}): {$Comment['comment_content']} </div>";
        }
        echo
        "<br><br>
            <div id=\"comForm\">
            <label class=\"label\" for=\"comContent\"> Dodaj komentarz! </label>
            <textarea maxlength=\"2048\" name=\"comContent\" form=\"commentForm{$post['post_ID']}\" id=\"comContent\"> </textarea>
            <form id=\"commentForm{$post['post_ID']}\" method=\"POST\">
                <button class=\"button\" id=\"comSubmit\" type=\"submit\" name=\"comSubmit\"> Opublikuj </button>
                <input type=\"hidden\" name=\"id\" value={$post['post_ID']}>
            </form>
            </div>";

        echo
        "</div>";
    }
    echo "</div>";
    ?>
</body>

</html>