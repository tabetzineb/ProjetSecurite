<?php

//connection a la base de donné du nom de zineb

$bdd = new pdo('mysql:host=localhost;dbname=zineb','root','');

//cette commende nous permet d'afficher les caractère spéciaux stoquer dans notre bdd
$bdd->exec('SET NAMES utf8');

?>