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
        if (isset($_POST['submit'])) {
            if (strlen($_POST['content']) > 2) {
                var_dump($_POST['content'], $_POST['postSubmit'], $userId);
                $publicate = "INSERT INTO posts (content, author_ID) VALUES (\"{$_POST['content']}\", {$userId})";
                $postQuery = mysqli_query($conn, $publicate);
                header('location: forum.php');
            } else {
                $message = "post jest za krótki";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
    ?>
</body>
</html>