<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUM- Twoje forum wędkarskie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <?php
        require 'auth.php';
    ?>
</head>

<body>
<div id="container">
    <div id="name">
        <h1> SUM </h1>
        <h2> Twoje forum wędkarskie </h2>
    </div>

    <div id="form">
        <form class="mb-3" action="auth.php" method="POST">
            <input class="text" type="text" name="login" placeholder="nazwa użytkownika"> </br>
            <input class="text" type="password" name="password" placeholder="hasło"> </br></br>
            <button class="btn btn-primary" type="submit"> zaloguj się </button>
        </form>
    </div>
</div>
<?php

?>
</body>
</html>