<?php require '../connexion/connexion.php' ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="../css/style_amadou.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">

  </head>
  <body>
      <?php

            $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur='2' ");
            $ligne = $sql->fetch(); //va chercher
       ?>
      <p>Coucou ! <?php  echo $ligne['prenom'].' '.$ligne['nom']; ?></p>
  </body>
</html>
