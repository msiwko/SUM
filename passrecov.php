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
            <h2> Utwórz nowe hasło </h2>
        </div>

        <div class="form">
            <form method="POST">
                <input class="text" type="text" name="login" placeholder="nazwa użytkownika"> </br>
                <input class="text" type="text" name="question" placeholder="odpowiedź na pyt. pomocnicze"> </br>
                <input class="text" type="password" name="password" placeholder="nowe hasło"> </br>
                <button class="btn btn-primary" type="submit" name="submit"> przywróć hasło </button>
            </form>
        </div>   
        <div class="form"> 
            <a href="index.php"> <button class="btn btn-primary" type="back"> powrót </button> </a>
            <a href="registration.php"> <button class="btn btn-primary" type="register"> rejestracja </button> </a>
        </div>
</body>

<?php
    if(isset($_POST['submit'])) {
        $getAnswer = "SELECT question FROM users WHERE login = \"{$_POST['login']}\"";
        $query = mysqli_query($conn, $getAnswer);
        $answer = mysqli_fetch_array($query);
        if($_POST['question'] = $answer) {
            $encPass = sha1($_POST['password']);
            $updatePassword = "UPDATE users SET password = \"{$encPass}\" WHERE login = \"{$_POST['login']}\"";
            $query = mysqli_query($conn, $updatePassword);
            $message = "zmieniono hasło";
            echo "<script type='text/javascript'>alert('$message'); </script>";
        } else {
            $message = "odpowiedź na pytanie pomocnicze jest błędna";
            echo "<script type='text/javascript'>alert('$message'); </script>";
        }
    }
?>