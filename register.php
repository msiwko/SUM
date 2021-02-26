<?php
    session_start();
    require 'conn.php';
    $conn = connection();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $logins = "SELECT login FROM users";
        $query = mysqli_query($conn, $logins);
        if ($_POST['login'] === $logins ['login']) {
            $message = "ten login jest już zajęty";
            echo "<script type='text/javascript'>alert('$message'); </script>";
        } else {
            $register = "INSERT INTO users (login, password, rank_ID) VALUES (\"{$_POST['login']}\", \"{$_POST['password']}\", 1)";
            $query = $register;
            header('location: /forum.php');
        }
    }
?>