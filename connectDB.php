<?php

function connectDB() {
    $dsn = 'mysql:host=mysql321.phy.lolipop.lan;
        dbname=LAA1595187-ryotoku;charset=utf8';
    $username = 'LAA1595187';
    $password = 'ryotoku';

    $pdo = new PDO($dsn, $username, $password);
    return $pdo;
}

?>