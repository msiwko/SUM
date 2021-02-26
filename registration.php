<?php
    require 'conn.php';
    require 'imports.php';
?>
<body>
    <div id="container">
        <div id="name">
                <h1> SUM </h1>
                <h2> rejestracja </h2>
        </div>
        <div class="form">
            <form class="mb-3" action="register.php" method="POST">
                <input class="text" type="text" name="login" placeholder="nazwa użytkownika"> </br>
                <input class="text" type="password" name="password" placeholder="hasło"> </br>
                <button class="btn btn-primary" type="submit"> zarejestruj się </button>
            </form>
        </div>
    </div>
</body>