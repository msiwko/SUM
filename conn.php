<?php
function connection() {
    $conn = mysqli_connect("localhost", "root", "", "forum");
    if ($conn === false) {
        die("Nie udało połączyć się z bazą danych");
    }
return $conn;
}
?>