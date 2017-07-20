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
//insertion d'une compétence
if(isset($_POST['competence'])){//si on récupere un nouveau competence
    if($_POST['competence']!=''){// si competence est pas vide
            $competence = addslashes($_POST['competence']);
            $pdoCV->exec("INSERT INTO t_competences VALUES (NULL, '$competence', '$id_utilisateur')"); //mettre $id_utilisateur quand on l'aura en variable de session
            header("location: ../admin/competences.php");
            exit();
    }//ferme le if
}//ferme le if isset

// suppression d'un competence
if(isset($_GET['id_competence'])){
    $efface = $_GET['id_competence'];
    $sql = "DELETE FROM t_competences WHERE id_competence = '$efface'";
    $pdoCV->query($sql);//ou avec exec
    header("location: ../admin/competences.php");

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

    <title>competences</title>
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
                        <a class="page-scroll" href="experiences.php">Expériences</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="realisations.php">Réalisations</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="formations.php">Formations</a>
                    </li>
					<li>
                        <a class="page-scroll" href="index.php?quitter=oui">Déconnexion</a>
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
                <h1>competences</h1>
                <div class="col-lg"></h1>
                    <?php
                        $competence = $pdoCV->prepare("SELECT * FROM t_competences WHERE utilisateur_id = '$id_utilisateur' ");// prépare la requête
                        $competence->execute();// execute la
                        $nbr_competences = $competence->rowCount();//compte les lignes

                    ?>
                    <p> Il y a <?php echo $nbr_competences; ?> competence(s) de la table pour <?php echo $ligne_utilisateur['pseudo']; ?> </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <tbody>
                                <tr>
                                    <th>competence</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                <tr>
                                    <?php while($ligne_competence = $competence->fetch()){ ?>
                                    <td><?php echo $ligne_competence['competence']; ?></td>
                                    <td><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                    <td><a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence'] ?>"><span class="glyphicon glyphicon-trash"></span></a></td>

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
                                    <label class="col-md-4 control-label" for="competence">Compétence</label>
                                    <div class="col-md-4">
                                        <input id="competence" name="competence" type="text" placeholder="compétence" class="form-control input-md">

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
