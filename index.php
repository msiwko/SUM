<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<?php
session_start();
require 'head.php';
require 'conn.php';
$conn = connection();
error_reporting(0);
unset($_SESSION['logged']);
?>

<body>
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
    <div class="form">
        <form method="POST">
            <input class="text" type="text" name="login" placeholder="nazwa użytkownika"> </br>
            <input class="text" type="password" name="password" placeholder="hasło"> </br>
            <button class="button" type="submit" id="mainbtn"> zaloguj się </button>
        </form>
    </div>
    <div class="form" id="btns">
        <a href="registration.php"> <button class="button" type="submit"> rejestracja </button> </a>
        <a href=passrecov.php> <button class="button" type="submit"> przywróć hasło </button> </a>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $getLogin = "SELECT login, password FROM users WHERE login = \"{$_POST['login']}\"";
        $query = mysqli_query($conn, $getLogin);
        $userInfo = mysqli_fetch_array($query);
        if (sha1($_POST['password']) !== $userInfo['password'] || $_POST['login'] !== $userInfo['login']) {
            $message = "błędne hasło lub nazwa użytkownika";
            echo "<script type='text/javascript'>alert('$message');</script>";
            // $_SESSION['logged'] = true;
        } elseif ((sha1($_POST['password']) === $userInfo['password'] || $_POST['login'] === $userInfo['login'])) {
            header('location: forum.php');
            $_SESSION['logged'] = true;
            $_SESSION['user'] = $_POST['login'];
            // var_dump($_SESSION['logged']);
        }
    }
    ?>
</body>

</html>