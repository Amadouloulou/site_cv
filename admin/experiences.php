<?php require '../connexion/connexion.php' ?>
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
<?php
	//gestion des contenus
	//insertion d'une expérience
		if(isset($_POST['titre_e'])){//si on récupère une nelle expérience
			if($_POST['titre_e']!='' && $_POST['description_e']!='' && $_POST['dates_e']!=''){// si expérience et les autres champs ne sont pas vide
				$titre_e = addslashes($_POST['titre_e']);
				$sous_titre_e = addslashes($_POST['sous_titre_e']);
            	$dates_e = addslashes($_POST['dates_e']);
            	$description_e = addslashes($_POST['description_e']);

				$pdoCV->exec(" INSERT INTO t_experiences VALUES (NULL, '$titre_e', '$sous_titre_e',  '$dates_e', '$description_e', '$id_utilisateur') ");//mettre $id_utilisateur quand on l'aura en variable de session
				header("location: ../admin/experiences.php");
				exit();
			}//ferme le if
		}//ferme le if isset

	//suppression d'une expérience
		if(isset($_GET['id_experience'])){
			$efface = $_GET['id_experience'];
			$sql = " DELETE FROM t_experiences WHERE id_experience = '$efface' ";
			$pdoCV -> query($sql);// ou on peut avec exec
			header("location: ../admin/experiences.php");
		}
	?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Expérience</title>
    <link rel="stylesheet" href="../css/style_amadou.css">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php

      $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur='$id_utilisateur' ");
      $ligne_utilisateur = $sql->fetch(); //va chercher
 ?>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">


    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">Admin Amadou Niang</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="competences.php">Compétences</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="loisirs.php">Loisirs</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="experiences.php">Expérience</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="realisations.php">Réalisations</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="formations.php">Formations</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="row">
                <h1>Expériences</h1>
                <div class="col-lg"></h1>
                    <?php
                        $titre = $pdoCV->prepare("SELECT * FROM t_experiences WHERE utilisateur_id = '$id_utilisateur' ORDER BY id_experience DESC");// prépare la requête
                        $titre->execute();// execute la
                        $nbr_experiences = $titre->rowCount();//compte les lignes

                    ?>
                    <p> Il y a <?php echo $nbr_experiences; ?> expérience(s) de la table pour <?php echo $ligne['pseudo']; ?> </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <tbody>
                                <tr>
                                    <th>Expériences</th>
                                    <th>Lieu</th>
                                    <th>Année</th>
                                    <th>Description</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                <tr>
									<?php while ($ligne_experience = $sql->fetch()) { ?>
									<td><?php echo $ligne_experience['titre_e']; ?></td>
									<td><?php echo $ligne_experience['sous_titre_e']; ?></td>
									<td><?php echo $ligne_experience['description_e']; ?></td>
									<td><?php echo $ligne_experience['dates_e']; ?></td>
									<td><a href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a class="supprimer" href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>"><span class="glyphicon glyphicon-trash"></span></a></span></td>
								</tr>
									<?php } ?>
                            </tbody>
                        </table>

                        <form class="form-horizontal" action="" method="post">
                            <fieldset>
                                <!-- Form Name -->
                                <legend>Form Name</legend>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="titre_e">Titre</label>
                                    <div class="col-md-4">
                                        <input id="titre_e" name="titre_e" type="text" placeholder="placeholder" class="form-control input-md">
                                        <span class="help-block">help</span>
                                    </div>
                                </div>

                        <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="sous_titre_e">Sous-titre</label>
                                <div class="col-md-4">
                                    <input id="sous_titre_e" name="sous_titre_e" type="text" placeholder="placeholder" class="form-control input-md">
                                    <span class="help-block">help</span>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="date_e">Date</label>
                                <div class="col-md-4">
                                    <input id="date_e" name="date_e" type="text" placeholder="placeholder" class="form-control input-md">
                                    <span class="help-block">help</span>
                                </div>
                            </div>

                        <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="description_e">Text Area</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" id="description_e" name="description_e">default text</textarea>
                                </div>
                            </div>

                        <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for=""></label>
                                <div class="col-md-4">
                                    <button type="submit" id="" name="" class="btn btn-primary">Envoyer</button>
                                </div>
                            </div>

                            </fieldset>
                        </form>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>

</body>

</html>
