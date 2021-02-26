<!DOCTYPE html>
<html lang="en">
<?php
    require 'imports.php';
    require 'auth.php';
?>

<body>
<div id="container">
    <div id="name">
        <h1> SUM </h1>
        <h2> Twoje forum wędkarskie </h2>
    </div>

    <div class="form">
        <form class="mb-3" action="auth.php" method="POST">
            <input class="text" type="text" name="login" placeholder="nazwa użytkownika"> </br>
            <input class="text" type="password" name="password" placeholder="hasło"> </br>
            <button class="btn btn-primary" type="submit"> zaloguj się </button>
        </form>
    </div>
    <div class="form">
        <form class="mb-3" action="registration.php" method="POST">
            <button class="btn btn-primary" type="submit"> rejestracja </button>
        </form>
    </div>
</div>
<?php

?>
</body>
</html>