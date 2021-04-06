<?php
session_start();
require 'conn.php';
require 'head.php';
$conn = connection();
?>
<link rel="stylesheet" href="style.css">

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
            <input class="text" type="text" name="question" placeholder="odpowiedź na pyt. pomocnicze"> </br>
            <input class="text" type="password" name="password" placeholder="nowe hasło"> </br>
            <button class="button" type="submit" name="submit" id="mainbtn"> przywróć hasło </button>
        </form>
    </div>
    <div class="form">
        <a href="index.php"> <button class="button" type="back"> powrót </button> </a>
        <a href="registration.php"> <button class="button" type="register"> rejestracja </button> </a>
    </div>
</body>

<?php
if (isset($_POST['submit'])) {
    $getAnswer = "SELECT question FROM users WHERE login = \"{$_POST['login']}\"";
    $query = mysqli_query($conn, $getAnswer);
    $answer = mysqli_fetch_array($query);
    if (strlen(($_POST['password'])) < 4) {
        $message = "login lub hasło są za krótkie";
        echo "<script type='text/javascript'>alert('$message'); </script>";
    } elseif ($_POST['question'] = $answer) {
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