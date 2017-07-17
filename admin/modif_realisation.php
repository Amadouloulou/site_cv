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
// gestion des contenus, mise à jour d'une compétence
if(isset($_POST['titre_r'])){// par le nom du premier input
    $realisation = addslashes($_POST);
	$titre_r = addslashes($_POST['titre_r']);
	$sous_titre_r = addslashes($_POST['sous_titre_r']);
	$dates_r = addslashes($_POST['dates_r']);
	$description_r = addslashes($_POST['description_r']);
    $id_realisation = $_POST['id_realisation'];
    $pdoCV->query("UPDATE t_realisations SET titre_r='$titre_r',sous_titre_r='$sous_titre_r',dates_r='$dates_r',description_r='$description_r'  WHERE id_realisation='$id_realisation'");

    header('location: ../admin/realisations.php');//le header pour revenir à la liste des compétences de l'utilisation
    exit();
}

//je récupère la compétence
$id_realisation = $_GET['id_realisation']; // par l'id et $_GET
$sql = $pdoCV->query("SELECT * FROM t_realisations WHERE id_realisation = '$id_realisation'"); // la requête égale à l'id
$ligne_realisation = $sql->fetch();//
 ?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Compétences</title>
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
      $ligne = $sql->fetch(); //va chercher
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
                        <a class="page-scroll" href="experiences.php">Experiences</a>
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
                <h1>Mise à jour d'une compétence</h1>
                <div class="col-lg"></div>
                    <?php
                        $realisation = $pdoCV->prepare("SELECT * FROM t_realisations WHERE utilisateur_id = '$id_utilisateur
							' ");
                        $realisation->execute();// execute la
                        $nbr_realisations = $realisation->rowCount();

                    ?>
                    <p> Il y a <?php echo $nbr_realisations; ?> expérience(s) de la table pour <?php echo $ligne['pseudo']; ?> </p>
                    <div class="table-responsive">
                        <form class="" action="modif_realisation.php" method="post">
                            <label for="titre_r">Formulaire de mise à jour du titre</label>
                            <input type="text" name="titre_r" class="form-control" value="<?php echo $ligne_realisation['titre_r']; ?>">

							<label for="sous_titre_r">Formulaire de mise à jour du sous_titre</label>
                            <input type="text" name="sous_titre_r" class="form-control" value="<?php echo $ligne_realisation['sous_titre_r']; ?>">

							<label for="dates_r">Formulaire de mise à jour de l'année</label>
                            <input type="text" name="dates_r" class="form-control" value="<?php echo $ligne_realisation['dates_r']; ?>">

							<label for="description_r">Formulaire de mise à jour de la description</label>
                            <input type="text" name="description_r" class="form-control" value="<?php echo $ligne_realisation['description_r']; ?>">
                            <input hidden name="id_realisation" value="<?php echo $ligne_realisation['id_realisation']; ?>">
                            <input type="submit" value="Mettre à jour" class="btn btn-primary btn-lg" style="margin-top: 10px;">
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
