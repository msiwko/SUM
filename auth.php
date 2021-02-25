<?php
session_start();
require 'conn.php';
$conn = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $getLogin = "SELECT login, password FROM users WHERE login = \"{$_POST['login']}\"";
    $query = mysqli_query($conn, $getLogin);
    $userInfo = mysqli_fetch_array($query);
    if ($_POST['password'] !== $userInfo ['password'] || $_POST['login'] !== $userInfo ['login']) {
        $message = "wrong password";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header('location: /index.php');
    } else {
        header('location: /forum.php');
    }
}
?>