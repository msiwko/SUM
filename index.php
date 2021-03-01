<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<?php
    session_start();
    require 'head.php';
    require 'conn.php';
    $conn = connection();
    error_reporting(0); //for double session start after forum.php header here
    unset($_SESSION['logged']); //tymczasowe 8)
?>

<body>
    <div id="container">
        <div id="name">
            <h1> SUM </h1>
            <h2> Twoje forum wędkarskie </h2>
        </div>

        <div class="form">
            <form method="POST">
                <input class="text" type="text" name="login" placeholder="nazwa użytkownika"> </br>
                <input class="text" type="password" name="password" placeholder="hasło"> </br>
                <button class="btn btn-primary" type="submit"> zaloguj się </button>
            </form>
        </div>
        <div class="form">
            <a href="registration.php"> <button class="btn btn-primary" type="submit"> rejestracja </button> </a>
        </div>
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