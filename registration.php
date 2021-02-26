<?php
    session_start();
    require 'conn.php';
    require 'imports.php';
    $conn = connection();
?>
<body>
    <div id="container">
        <div id="name">
                <h1> SUM </h1>
                <h2> rejestracja </h2>
        </div>
        <div class="form">
            <form class="mb-3" method="POST">
                <input class="text" type="text" name="login" placeholder="nazwa użytkownika"> </br>
                <input class="text" type="password" name="password" placeholder="hasło"> </br>
                <button class="btn btn-primary" type="submit"> zarejestruj się </button>
            </form>
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
            } else {
                $register = "INSERT INTO users (login, password, users.rank_ID) VALUES (\"{$_POST['login']}\", \"{$encPass}\", 1)";
                // var_dump($register);
                mysqli_query($conn, $register);
                header('location: /forum.php');                
            }
        }
    ?>
</body>