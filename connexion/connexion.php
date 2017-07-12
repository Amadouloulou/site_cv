<?php

$hote='localhost'; // Le chemin vers le serveur
$bdd='sitecv_aniang'; // le nom de la base de données
$utilisateur='root'; // le nom d'utilisateur pour se connecter
$passe=''; // mot de passe de l'utilisateur

$pdoCV = new PDO('mysql:host='.$hote.';dbname='.$bdd, $utilisateur, $passe);
//$pdoCV est le npom de la variable de la connexionqui sert partout ou l'on doit se servir de cette connexion.
$pdoCV->exec("SET NAMES utf8");

 ?>
 <?php

 session_start();// à mettre dans toutes les pages de l'admin ; SESSION et authentification
 	if(isset($_SESSION['connexion']) && $_SESSION['connexion']=='connecté'){
 		$id_utilisateur=$_SESSION['id_utilisateur'];
 		$prenom=$_SESSION['prenom'];
 		$nom=$_SESSION['nom'];

 		//echo $_SESSION['connexion'];

 	}else{//l'utilisateur n'est pas connecté
 		header('location:authentification.php');
 	}
 //pour se déconnecter
 if(isset($_GET['quitter'])){// on récupère le terme quitter dans l'url

 	$_SESSION['connexion']='';// on vide les variables de session
 	$_SESSION['id_utilisateur']='';
 	$_SESSION['prenom']='';
 	$_SESSION['nom']='';

 	unset($_SESSION['connexion']);
 	session_destroy();

 	header('location:../index.php');
 }
 	?>
