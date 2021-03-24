<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="delete.css">
<?php
session_start();
require 'head.php';
require 'conn.php';
$conn = connection();
?>
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

    </div>
</nav>

<div id="container">
    <div id="form">
        <label for="delForm" id="label"> Potwierdź usuwanie konta </label>
        <form method="post" id="delForm">
            <input class="input" type="password" name="password" placeholder="hasło"> </br>
            <button class="button" type="submit"> usuń konto </button>
        </form>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = sha1($_POST['password']);
    $getPass = "SELECT password FROM users WHERE login = \"{$_SESSION['user']}\"";
    $query = mysqli_query($conn, $getPass);
    $pass = mysqli_fetch_array($query)[0];
    // die(var_dump($password, $pass));
    if ($password !== $pass) {
        $message = "błędne hasło lub nazwa użytkownika";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } elseif ($password === $pass) {
        $delComs = "DELETE FROM comments WHERE comment_author_id = {$_SESSION['userid']}";
        $comQuery = mysqli_query($conn, $delComs);
        $delPosts = "DELETE FROM posts WHERE author_id = {$_SESSION['userid']}";
        $postQuery = mysqli_query($conn, $delPosts);
        $delAcc = "DELETE FROM users WHERE login = \"{$_SESSION['user']}\"";
        $accQuery = mysqli_query($conn, $delAcc);
        header('location: index.php');
    }
}
?>