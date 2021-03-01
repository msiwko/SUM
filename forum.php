<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    if($_SESSION['logged'] !== true) {
        header('location: /index.php');
    }
    require 'head.php';
    require 'conn.php';
    $conn = connection();
?>
<link rel="stylesheet" href="forum.css">
<body>
    <nav>
        <h1> SUM </h1> 
        <h2> Twoje forum wędkarskie </h2>
    </nav>
    <div id="postForm">
        <form method="POST">
            <label id="postLabel"> Napisz swój post </label>
            <textarea maxlength="2048" id="postInput" name="content"> </textarea> <br>
            <button id="postSubmit" type="submit"> Opublikuj </button>
        </form>
    </div>
</body>
</html>