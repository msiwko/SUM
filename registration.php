<?php
    session_start();
    require 'conn.php';
    require 'head.php';
    $conn = connection();    
?>
<link rel="stylesheet" href="style.css">
<body>
    <div id="container">
        <div id="name">
                <h1> SUM </h1>
                <h2> rejestracja </h2>
        </div>
        <div class="form">
            <form method="POST">
                <input class="text" type="text" name="login" placeholder="nazwa użytkownika"> </br>
                <input class="text" type="password" name="password" placeholder="hasło"> </br>
                <input class="text" type="question" name="question" placeholder="imię matki (pytanie pomocnicze)"> </br>
                <button class="btn btn-primary" type="submit"> zarejestruj się </button>
            </form>
        </div>
        <div class="form">
            <a href="index.php"> <button class="btn btn-primary" type="submit"> powrót </button> </a>
        </div>
    </div>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $getLogins = "SELECT login FROM users WHERE login = \"{$_POST['login']}\"";
            $query = mysqli_query($conn, $getLogins);
            $login = mysqli_fetch_array($query);
            $encPass = sha1($_POST['password']);
            // var_dump($login);
            if ($_POST['login'] === $login['login']) {
                $message = "ten login jest już zajęty";
                echo "<script type='text/javascript'>alert('$message'); </script>";
            } elseif (strlen(($_POST['login'])) < 3 || strlen(($_POST['password'])) < 5) {
                $message = "login lub hasło są za krótkie";
                echo "<script type='text/javascript'>alert('$message'); </script>";
            } else {
                $register = "INSERT INTO users (login, password, question, users.rank_ID) VALUES (\"{$_POST['login']}\", \"{$encPass}\", \"{$_POST['question']}\", 1)";
                // var_dump($register);
                mysqli_query($conn, $register);
                header('location: /index.php');
            }
        }
    ?>
</body>