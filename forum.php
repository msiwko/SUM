<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    unset($_POST['postSubmit']);
    if($_SESSION['logged'] !== true) {
        header('location: /index.php');
    }
    require 'head.php';
    require 'conn.php';
    $conn = connection();
    $getID = "SELECT ID from users WHERE login=\"{$_SESSION['user']}\"";
    $query = mysqli_query($conn, $getID);
    $userId = mysqli_fetch_array($query)['ID'];
    $getRank = "SELECT rank_ID from users WHERE login=\"{$_SESSION['user']}\"";
    $query = mysqli_query($conn, $getRank);
    $userRank = mysqli_fetch_array($query)['rank_ID'];
?>
<link rel="stylesheet" href="forum.css">
<nav>
    <img id="sumL" src="photos/sum.png">
    <img id="sumR" src="photos/sum.png">
    <div class="left">
        <button class="button" name="profile" id="profile" href="profile.php"> profil </button>
    </div>
    <div class="middle">
        <h1> SUM </h1> 
        <h2> Twoje forum wędkarskie </h2>
    </div>
    <div class="right">
        <a href="index.php"> <button class="button" name="logout" id="logout"> wyloguj </button></a>
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (strlen($_POST['content']) > 2 ) {
                // var_dump($_POST['content'], $_POST['submit'], $userId);
                $publicate = "INSERT INTO posts (content, author_ID) VALUES (\"{$_POST['content']}\", {$userId})";
                $postQuery = mysqli_query($conn, $publicate);
                if ($userRank !== 99 || $userRank !== 98) {
                    $getPosts = "SELECT COUNT(*) AS postcount FROM posts WHERE author_ID = {$userId}";
                    $postQuery = mysqli_query($conn, $getPosts);
                    $posts = mysqli_fetch_array($postQuery);
                    $postsNum = intval($posts['postcount']);
                    $getComments = "SELECT COUNT(*) AS commentcount FROM comments WHERE comment_author_ID = {$userId}";
                    $comQuery = mysqli_query($conn, $getComments);
                    $comments = mysqli_fetch_array($comQuery);
                    $commentsNum = intval($comments['commentcount']);
                    $rank = $postsNum + $commentsNum;
                    // $userIdInt = intval($getID['ID']);   
                    if ($rank <= 10) {
                        $rankUpdate = "UPDATE users SET rank_ID = 1 WHERE ID = {$userId}";
                        $rankQuery = mysqli_query($conn, $rankUpdate);
                    } elseif ($rank <= 20) {
                        $rankUpdate = "UPDATE users SET rank_ID = 2 WHERE ID = {$userId}";
                        $rankQuery = mysqli_query($conn, $rankUpdate);
                    } elseif ($rank <= 50) {
                        $rankUpdate = "UPDATE users SET rank_ID = 3 WHERE ID = {$userId}";
                        $rankQuery = mysqli_query($conn, $rankUpdate);
                    } elseif ($rank <= 100) {
                        $rankUpdate = "UPDATE users SET rank_ID = 4 WHERE ID = {$userId}";
                        $rankQuery = mysqli_query($conn, $rankUpdate);
                    } elseif ($rank <=250) {
                        $rankUpdate = "UPDATE users SET rank_ID = 5 WHERE ID = {$userId}";
                        $rankQuery = mysqli_query($conn, $rankUpdate);
                    } elseif ($rank <=500) { 
                        $rankUpdate = "UPDATE users SET rank_ID = 6 WHERE ID = {$userId}";
                        $rankQuery = mysqli_query($conn, $rankUpdate);
                    }
                }
                header('location: forum.php');
            } else {
                $message = "post jest za krótki";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
    ?>
</body>
</html>