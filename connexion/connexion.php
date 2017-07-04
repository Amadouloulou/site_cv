<?php

$hote='localhost'; // Le chemin vers le serveur
$bdd='sitecv_aniang'; // le nom de la base de données
$utilisateur='root'; // le nom d'utilisateur pour se connecter
$passe=''; // mot de passe de l'utilisateur

$pdoCV = new PDO('mysql:host='.$hote.';dbname='.$bdd, $utilisateur, $passe);
//$pdoCV est le npom de la variable de la connexionqui sert partout ou l'on doit se servir de cette connexion.
$pdoCV->exec("SET NAMES utf8");

 ?>
